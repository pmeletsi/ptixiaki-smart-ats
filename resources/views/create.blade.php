<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Δημιουργία Αγγελίας | SmartRecruit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <span class="font-bold text-xl text-gray-800 tracking-tight">Smart<span class="text-indigo-600">Admin</span></span>
            </a>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition flex items-center gap-1 group">
                <span class="group-hover:-translate-x-1 transition transform">←</span> Πίσω στο Dashboard
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-10 flex-grow">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <div class="bg-indigo-900 text-white p-10 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 opacity-20 rounded-full translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -translate-x-1/3 translate-y-1/3"></div>

                <div class="relative z-10">
                    <div class="bg-indigo-800 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg border-4 border-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Δημιουργία Νέας Αγγελίας</h1>
                    <p class="text-indigo-200 text-sm">Συμπλήρωσε τα στοιχεία για να βρεις τον κατάλληλο υποψήφιο.</p>
                </div>
            </div>

            <div class="p-8 md:p-10">
                @if($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-8 text-sm border border-red-100 flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition">Τίτλος Θέσης *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                💼
                            </span>
                            <input type="text" name="title" required 
                                   class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition" 
                                   placeholder="π.χ. Senior Web Developer">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition">Τοποθεσία *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    📍
                                </span>
                                <input type="text" name="location" required 
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition" 
                                       placeholder="π.χ. Αθήνα">
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition">Τύπος Απασχόλησης</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    ⏱
                                </span>
                                <select name="type" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition appearance-none cursor-pointer">
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Contract">Contract / Project</option>
                                    <option value="Internship">Πρακτική (Internship)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-indigo-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition">Περιγραφή Θέσης *</label>
                        <textarea name="description" rows="6" required 
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition" 
                                  placeholder="Περιέγραψε τις αρμοδιότητες..."></textarea>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 flex justify-center items-center gap-2">
                             Δημοσίευση Αγγελίας
                        </button>
                    </div>

                </form>
            </div>
        </div>
        
        <div class="text-center mt-8 text-xs text-gray-400">
            SmartRecruit Admin Panel &copy; {{ date('Y') }}
        </div>
    </div>

</body>
</html>