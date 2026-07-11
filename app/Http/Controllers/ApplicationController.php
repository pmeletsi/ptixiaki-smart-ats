<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use OpenAI; 
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateStatusNotification;

class ApplicationController extends Controller
{
    /**
     * 1. Αρχική Σελίδα (Βιτρίνα Αγγελιών)
     */
    public function index(Request $request)
    {
        // Φέρνουμε όλες τις αγγελίες μέχρι να τις διαγράψει ο διαχειριστής
        $search = trim($request->query('search', ''));

        $jobs = Job::query();

        if ($search !== '') {
            $jobs->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $jobs = $jobs->latest()->get();

        return view('welcome', compact('jobs'));
    }

    /**
     * 2. Εμφάνιση Φόρμας Αίτησης (To "show" που έλειπε)
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('apply', compact('job'));
    }

    /**
     * 3. Αποθήκευση Αίτησης Υποψηφίου
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'resume' => 'required|mimes:pdf|max:2048',
        ]);

        // Ανέβασμα Αρχείου
        $fileName = time() . '_' . $request->file('resume')->getClientOriginalName();
        $request->file('resume')->move(public_path('uploads'), $fileName);

        // Δημιουργία Υποψηφίου
        Candidate::create([
            'job_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'resume_path' => $fileName,
            'status' => 'new'
        ]);

        return redirect()->route('home')->with('success', 'Η αίτησή σας καταχωρήθηκε με επιτυχία!');
    }

    /**
     * 4. Admin Dashboard - Στατιστικά & Φιλτράρισμα
     */
    public function dashboard(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');

        // Στατιστικά για τα κουτάκια (από όλη τη βάση)
        $all = Candidate::all();
        $stats = [
            'total'     => $all->count(),
            'new'       => $all->where('status', 'new')->count(),
            'interview' => $all->where('status', 'interview')->count(),
            'hired'     => $all->where('status', 'hired')->count(),
            'rejected'  => $all->where('status', 'rejected')->count(),
        ];

        // Query για τη λίστα
        $query = Candidate::with('job')->latest();

        // Εφαρμογή Φίλτρου
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        } else {
            // Προεπιλογή: Κρύβουμε Προσλήψεις & Απορρίψεις
            $query->whereNotIn('status', ['rejected', 'hired']);
        }

        $candidates = $query->get();

        return view('dashboard', compact('candidates', 'stats'));
    }

    /**
     * 5. Ενημέρωση Κατάστασης (Status Update)
     */
    public function updateStatus(Request $request, $id)
    {
        $candidate = Candidate::with('job')->findOrFail($id);
        $candidate->update(['status' => $request->status]);

        $mailError = null;

        try {
            Mail::to($candidate->email)->send(new CandidateStatusNotification($candidate));
        } catch (\Exception $e) {
            $mailError = $e->getMessage();
        }

        if ($mailError) {
            return back()->with('success', 'Η κατάσταση ενημερώθηκε. Το email δεν στάλθηκε: ' . $mailError);
        }

        return back()->with('success', 'Η κατάσταση ενημερώθηκε και στάλθηκε email στον υποψήφιο!');
    }

    /**
     * 6. AI Ανάλυση Βιογραφικού
     */
    public function analyze($id)
    {
        if (!Auth::check()) return redirect()->route('login');

        $candidate = Candidate::with('job')->findOrFail($id);
        $filePath = public_path('uploads/' . $candidate->resume_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'Το αρχείο PDF δεν βρέθηκε.');
        }

        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            $text = $pdf->getText();

            $apiKey = env('OPENAI_API_KEY');
            if (empty($apiKey)) {
                return back()->with('error', 'Το OPENAI_API_KEY δεν έχει οριστεί. Προσθέστε το στο αρχείο .env.');
            }

            $client = OpenAI::client($apiKey);
            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Return JSON only.'],
                    ['role' => 'user', 'content' => "Αξιολόγησε τον υποψήφιο για τη θέση '{$candidate->job->title}'. Βιογραφικό: {$text}. JSON format: {\"score\": 85, \"analysis\": \"...\"}"]
                ],
            ]);

            $data = json_decode($result->choices[0]->message->content, true);
            
            $candidate->update([
                'ai_score' => $data['score'] ?? 0,
                'ai_analysis' => $data['analysis'] ?? 'Δεν ήταν δυνατή η ανάλυση.'
            ]);

            return back()->with('success', 'Η ανάλυση ολοκληρώθηκε!');
        } catch (\Exception $e) {
            return back()->with('error', 'Σφάλμα: ' . $e->getMessage());
        }
    }

    /**
     * 7. Authentication
     */
    public function loginForm() { return view('login'); }
    
    public function doLogin(Request $request) {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }
        return back()->with('error', 'Λάθος στοιχεία πρόσβασης.');
    }

    public function logout() { 
        Auth::logout(); 
        return redirect('/'); 
    }

    public function createJob()
    {
        return view('create'); 
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Job::create([
            'title' => $request->title,
            'location' => $request->location,
            'type' => $request->type,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Η αγγελία δημιουργήθηκε με επιτυχία!');
    }
}