<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Είσοδος Admin | SmartRecruit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
        
        <div class="bg-indigo-900 p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-indigo-500 opacity-20 rounded-full translate-x-1/3 translate-y-1/3"></div>
            
            <h1 class="text-2xl font-bold text-white mb-1">Smart<span class="text-indigo-400">Recruit</span></h1>
            <p class="text-indigo-200 text-xs uppercase tracking-widest">Admin Panel</p>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-800 text-center mb-6">Σύνδεση Διαχειριστή</h2>

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded mb-6 text-sm flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></span>
                        <input type="email" name="email" required 
                               class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition"
                               placeholder="admin@smartats.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Κωδικός</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></span>
                        <input type="password" name="password" required 
                               class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition"
                               placeholder="********">
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition shadow-lg transform hover:-translate-y-0.5">
                    Είσοδος
                </button>
            </form>

            <div class="mt-6 text-center border-t border-gray-100 pt-4">
                <a href="/" class="text-sm text-gray-400 hover:text-indigo-600 transition">← Επιστροφή στο Site</a>
            </div>
        </div>
    </div>

</body>
</html>