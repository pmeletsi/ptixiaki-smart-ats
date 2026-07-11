<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart ATS | Καριέρα</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <div class="bg-indigo-600 text-white p-2 rounded-lg group-hover:bg-indigo-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="font-bold text-xl text-gray-800 tracking-tight">Smart<span class="text-indigo-600">Recruit</span></span>
            </a>
            
            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800"> Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Admin Login</a>
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <div class="relative bg-indigo-900 text-white pt-24 pb-32 overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-500 opacity-10 rounded-full translate-x-1/3 translate-y-1/3"></div>
        
        <div class="container mx-auto px-6 text-center relative z-10">
            <span class="bg-indigo-800 text-indigo-200 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-4 inline-block">We are hiring</span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">Χτίσε το μέλλον σου μαζί μας</h1>
            <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto mb-8">Αναζητούμε ταλέντα με πάθος. Δες τις ανοιχτές θέσεις μας και κάνε την επόμενη κίνηση στην καριέρα σου.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-10 relative z-20 mb-12">
        <form action="/" method="GET" class="bg-white p-4 rounded-xl shadow-lg flex flex-col md:flex-row gap-4 border border-gray-100 max-w-4xl mx-auto items-center">
            <div class="flex-grow w-full md:w-auto relative">
                <span class="absolute left-3 top-3.5 text-gray-400">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Τίτλος θέσης, περιοχή ή λέξη κλειδί..." 
                       class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition">
            </div>
            
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-md flex justify-center items-center gap-2">
                    Αναζήτηση
                </button>
                
                @if(request('search'))
                    <a href="/" class="bg-gray-100 hover:bg-red-100 text-gray-500 hover:text-red-600 font-bold py-3 px-4 rounded-lg transition border border-gray-200" title="Καθαρισμός">
                        X
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div id="jobs" class="container mx-auto px-6 pb-20 flex-grow">
        <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-4">
            <h2 class="text-3xl font-bold text-gray-800">
                @if(request('search'))
                    Αποτελέσματα για: "<span class="text-indigo-600">{{ request('search') }}</span>"
                @else
                    Ανοιχτές Θέσεις
                @endif
            </h2>
            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-semibold">{{ isset($jobs) ? $jobs->count() : 0 }} θέσεις</span>
        </div>

        @if(isset($jobs) && $jobs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($jobs as $job)
                <div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col justify-between overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1 h-full bg-indigo-500 transform -translate-x-full group-hover:translate-x-0 transition duration-300"></div>
                    
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full border border-indigo-100 tracking-wide uppercase">{{ $job->type ?? 'Full Time' }}</span>
                            <span class="text-gray-400 text-xs flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $job->created_at->diffForHumans() }}
                            </span>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-indigo-600 transition">{{ $job->title }}</h3>
                        
                        <div class="flex items-center gap-2 text-gray-500 mb-6 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $job->location }}
                        </div>
                        
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 leading-relaxed">
                            {{ Str::limit($job->description, 120) }}
                        </p>
                    </div>
                    
                    <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center group-hover:bg-indigo-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Κάνε το επόμενο βήμα</span>
                        <a href="{{ route('apply.show', $job->id) }}" class="text-indigo-600 font-bold text-sm hover:underline flex items-center gap-1">
                            Αίτηση <span class="text-lg">→</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
                <div class="text-6xl mb-4"></div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Δεν βρέθηκαν αγγελίες</h3>
                <p class="text-gray-500">Δοκίμασε να αλλάξεις τα κριτήρια αναζήτησης.</p>
                @if(request('search'))
                    <a href="/" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Καθαρισμός φίλτρων</a>
                @endif
            </div>
        @endif
    </div>

    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <span class="font-bold text-2xl tracking-tight block mb-2">Smart<span class="text-indigo-400">Recruit</span></span>
                    <p class="text-gray-400 text-sm">Η πλατφόρμα που συνδέει ταλέντα με ευκαιρίες.</p>
                </div>
                
            <div class="flex gap-6 text-sm text-gray-400">
                 <a href="{{ route('terms') }}" class="hover:text-white transition">Όροι Χρήσης</a>
                 <a href="{{ route('privacy') }}" class="hover:text-white transition">Πολιτική Απορρήτου</a>
                 <a href="{{ route('contact') }}" class="hover:text-white transition">Επικοινωνία</a>
            </div>
        </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-xs text-gray-600">
                &copy; {{ date('Y') }} SmartRecruit ATS. Created with Laravel
            </div>
        </div>
    </footer>
</body>
</html>
   