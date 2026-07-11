<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αίτηση για {{ $job->title }} | SmartRecruit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <span class="font-bold text-xl text-gray-800 tracking-tight">Smart<span class="text-indigo-600">Recruit</span></span>
            </a>
            <a href="/" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">← Πίσω στις Αγγελίες</a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-12 flex-grow">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            
            <div class="bg-indigo-900 text-white p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <h2 class="text-indigo-200 text-sm font-bold uppercase tracking-widest mb-2">Κανεις αιτηση για</h2>
                <h1 class="text-3xl font-bold mb-4">{{ $job->title }}</h1>
                <div class="flex justify-center gap-4 text-sm text-indigo-100 opacity-80">
                    <span class="flex items-center gap-1">📍 {{ $job->location }}</span>
                    <span class="flex items-center gap-1">💼 {{ $job->type }}</span>
                </div>
            </div>

            <div class="p-8 md:p-12">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded mb-6 text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('apply.store', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ονοματεπώνυμο *</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="Γιώργος Παπαδόπουλος">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="giorgos@example.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Τηλέφωνο</label>
                        <input type="text" name="phone" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="6912345678">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Βιογραφικό (PDF) *</label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition group cursor-pointer" id="dropzone">
                            <input type="file" name="resume" id="fileInput" accept=".pdf" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="text-gray-500 group-hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div id="fileNameDisplay">
                                    <span class="font-bold">Πάτησε εδώ</span> για να ανεβάσεις το αρχείο
                                    <p class="text-xs text-gray-400 mt-1">(Μέγιστο μέγεθος: 2MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Σημειώσεις / Cover Letter</label>
                        <textarea name="notes" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="Γράψε μας λίγα λόγια για εσένα..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                        Αποστολή Αίτησης 
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 py-8 mt-12 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} SmartRecruit ATS.
    </footer>

    <script>
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const dropzone = document.getElementById('dropzone');

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                // Όταν επιλέγεται αρχείο, γίνεται μπλε-indigo και δείχνει το όνομα
                fileNameDisplay.innerHTML = `<span class="font-bold text-indigo-700">Επιλέχθηκε:</span> <br> <span class="text-gray-800 font-medium">${e.target.files[0].name}</span>`;
                dropzone.classList.add('border-indigo-500', 'bg-indigo-50');
                dropzone.classList.remove('border-gray-300', 'hover:bg-gray-50');
            } else {
                // Αν ο χρήστης ακυρώσει, επιστρέφει στην αρχική μορφή
                fileNameDisplay.innerHTML = `<span class="font-bold">Πάτησε εδώ</span> για να ανεβάσεις το αρχείο <p class="text-xs text-gray-400 mt-1">(Μέγιστο μέγεθος: 2MB)</p>`;
                dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
                dropzone.classList.add('border-gray-300', 'hover:bg-gray-50');
            }
        });
    </script>
</body>
</html>