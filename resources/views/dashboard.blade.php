<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SmartRecruit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        .stat-card:hover { transform: translateY(-2px); transition: all 0.2s; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <span class="font-bold text-lg text-gray-800">Smart<span class="text-indigo-600">Admin</span></span>
            </a>
            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Προβολή Site</a>
                <form action="{{ route('logout') }}" method="GET">
                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-2">
                        Έξοδος
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-8">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Επισκόπηση</h1>
                <p class="text-gray-500 text-sm">Καλωσήρθες πίσω, Admin. Διαχειρίσου τις αιτήσεις σου.</p>
            </div>
            <div class="flex gap-3">
                <a href="/admin/jobs" class="bg-white border border-gray-200 text-gray-700 font-bold py-2.5 px-5 rounded-lg shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                     Διαχείριση Αγγελιών
                </a>
                <a href="{{ route('jobs.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-lg shadow-md transition flex items-center gap-2">
                    <span class="text-xl">+</span> Νέα Αγγελία
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <a href="{{ route('dashboard', ['status' => 'all']) }}" class="stat-card bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center group hover:border-indigo-400 transition cursor-pointer">
                <span class="text-4xl font-extrabold text-gray-800 mb-1">{{ $stats['total'] ?? 0 }}</span>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Συνολο</span>
            </a>
            
            <a href="{{ route('dashboard', ['status' => 'new']) }}" class="stat-card bg-blue-50 p-5 rounded-xl border border-blue-100 flex flex-col items-center justify-center group hover:border-blue-400 transition cursor-pointer">
                <span class="text-4xl font-extrabold text-blue-600 mb-1">{{ $stats['new'] ?? 0 }}</span>
                <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Νεες</span>
            </a>

            <a href="{{ route('dashboard', ['status' => 'interview']) }}" class="stat-card bg-yellow-50 p-5 rounded-xl border border-yellow-100 flex flex-col items-center justify-center group hover:border-yellow-400 transition cursor-pointer">
                <span class="text-4xl font-extrabold text-yellow-600 mb-1">{{ $stats['interview'] ?? 0 }}</span>
                <span class="text-xs font-bold text-yellow-500 uppercase tracking-wider">Συνεντευξη</span>
            </a>

            <a href="{{ route('dashboard', ['status' => 'hired']) }}" class="stat-card bg-green-50 p-5 rounded-xl border border-green-100 flex flex-col items-center justify-center group hover:border-green-400 transition cursor-pointer">
                <span class="text-4xl font-extrabold text-green-600 mb-1">{{ $stats['hired'] ?? 0 }}</span>
                <span class="text-xs font-bold text-green-500 uppercase tracking-wider">Προσληψεις</span>
            </a>

            <a href="{{ route('dashboard', ['status' => 'rejected']) }}" class="stat-card bg-red-50 p-5 rounded-xl border border-red-100 flex flex-col items-center justify-center group hover:border-red-400 transition cursor-pointer">
                <span class="text-4xl font-extrabold text-red-600 mb-1">{{ $stats['rejected'] ?? 0 }}</span>
                <span class="text-xs font-bold text-red-400 uppercase tracking-wider">Απορριψεις</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-sm flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <span class="text-2xl">✅</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-700 uppercase text-xs tracking-widest">
                    @if(request('status') == 'rejected') Λίστα Απορριφθέντων @elseif(request('status') == 'hired') Λίστα Προσλήψεων @else Λίστα Υποψηφίων @endif
                </h3>
                <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">{{ $candidates->count() }} αιτήσεις</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-100 text-xs uppercase text-gray-400 font-semibold tracking-wider">
                            <th class="p-4">Υποψήφιος</th>
                            <th class="p-4">Θέση</th>
                            <th class="p-4 text-center">Κατάσταση (Status)</th>
                            <th class="p-4 text-center">AI Score</th>
                            <th class="p-4 text-center">Ενέργειες</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                        @foreach($candidates as $candidate)
                        <tr class="hover:bg-gray-50 transition group">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                                        {{ substr($candidate->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $candidate->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $candidate->email }}</div>
                                        <div class="text-xs text-gray-400">{{ $candidate->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="p-4">
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-semibold border border-gray-200">
                                    {{ $candidate->job->title ?? 'Άγνωστη Θέση' }}
                                </span>
                            </td>

                            <td class="p-4 text-center">
                                <form action="{{ route('dashboard.status', $candidate->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" 
    class="text-xs font-bold py-1.5 px-3 rounded-full border focus:outline-none cursor-pointer shadow-sm transition {{ $candidate->status == 'new' ? 'bg-blue-100 text-blue-800 border-blue-200' : '' }}{{ $candidate->status == 'interview' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : '' }}{{ $candidate->status == 'hired' ? 'bg-green-100 text-green-800 border-green-200' : '' }}{{ $candidate->status == 'rejected' ? 'bg-red-100 text-red-800 border-red-200' : '' }}">
    
    <option value="new" {{ $candidate->status == 'new' ? 'selected' : '' }}>Νέα</option>
    <option value="interview" {{ $candidate->status == 'interview' ? 'selected' : '' }}>Συνέντευξη</option>
    <option value="hired" {{ $candidate->status == 'hired' ? 'selected' : '' }}>Πρόσληψη</option>
    <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>Απόρριψη</option>
</select>
                                </form>
                            </td>

                            <td class="p-4 text-center">
                                @if($candidate->ai_score)
                                    <div class="flex flex-col items-center">
                                        <div class="text-lg font-bold {{ $candidate->ai_score >= 80 ? 'text-green-600' : ($candidate->ai_score >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $candidate->ai_score }}%
                                        </div>
                                        @if($candidate->ai_analysis)
                                            <button onclick="alert('{{ addslashes($candidate->ai_analysis) }}')" class="text-[10px] text-indigo-600 hover:underline cursor-pointer mt-1">
                                                Δες Ανάλυση
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <a href="{{ route('dashboard.analyze', $candidate->id) }}" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1 border border-indigo-200">
                                        Analyze
                                    </a>
                                @endif
                            </td>

                            <td class="p-4 text-center">
                                <a href="{{ asset('uploads/' . $candidate->resume_path) }}" target="_blank" class="text-gray-400 hover:text-indigo-600 transition" title="Προβολή Βιογραφικού">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($candidates->count() == 0)
                    <div class="text-center py-12 bg-gray-50/50">
                        <div class="text-4xl mb-2">🔍</div>
                        <p class="text-gray-500 font-medium">Δεν βρέθηκαν υποψήφιοι σε αυτή την κατηγορία.</p>
                        <a href="{{ route('dashboard', ['status' => 'all']) }}" class="text-indigo-600 text-sm hover:underline mt-2 inline-block">Επιστροφή σε όλους</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>