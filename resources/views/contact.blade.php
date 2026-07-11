<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επικοινωνία | SmartRecruit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-xl text-gray-800 tracking-tight">Smart<span class="text-indigo-600">Recruit</span></a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-16 flex-grow">
        <div class="max-w-2xl mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Επικοινωνήστε μαζί μας</h1>
            
            <div class="space-y-8">
                <div class="flex items-center gap-6">
                    <div class="bg-indigo-600 text-white p-4 rounded-xl shadow-lg">📧</div>
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Email</p>
                        <p class="text-lg font-semibold text-gray-800">meletsievi@gmail.gr</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="bg-indigo-600 text-white p-4 rounded-xl shadow-lg">📞</div>
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Τηλέφωνο</p>
                        <p class="text-lg font-semibold text-gray-800">+30 698 856 5278 </p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="bg-indigo-600 text-white p-4 rounded-xl shadow-lg">📍</div>
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Γραφεία</p>
                        <p class="text-lg font-semibold text-gray-800">Αθήνα, Ελλάδα</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center text-sm text-gray-500">
            &copy; 2026 SmartRecruit ATS. Created with Laravel
        </div>
    </footer>
</body>
</html>