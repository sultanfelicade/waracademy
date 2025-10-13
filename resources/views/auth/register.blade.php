<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | WarAcademy</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        poppins: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="font-poppins bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen flex items-center justify-center animate-bgGradient">

    <div class="bg-white shadow-2xl rounded-2xl flex flex-col md:flex-row w-[900px] max-w-full overflow-hidden transform transition-transform duration-500 hover:scale-105">
        <!-- LEFT: Info -->
        <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-b from-blue-700 to-blue-900 text-white p-10 w-1/2 relative overflow-hidden">
            <h1 class="text-2xl font-bold mb-3 animate-slideInLeft">Bergabung Bersama Kami!</h1>
            <p class="text-gray-200 text-center mb-6 animate-slideInLeft delay-200">Daftar sekarang dan mulai petualanganmu di WarAcademy.</p>
            <a href="{{ route('login') }}" class="bg-white text-blue-800 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition transform hover:scale-105 animate-slideInLeft delay-400">
                Sudah Punya Akun? Login
            </a>
            <!-- Decorative Circles -->
            <span class="absolute w-32 h-32 bg-white opacity-10 rounded-full top-10 left-10 animate-bounceSlow"></span>
            <span class="absolute w-20 h-20 bg-white opacity-10 rounded-full bottom-10 right-10 animate-bounceSlow delay-200"></span>
        </div>

        <!-- RIGHT: Register Form -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-6 animate-slideInRight">Daftar</h2>
            <form method="POST" action="{{ route('register.process') }}">
                @csrf
                <div class="space-y-4">
                    <div class="animate-slideInRight delay-200">
                        <label class="block text-sm font-medium mb-1 text-gray-700">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-300 hover:ring-blue-300">
                    </div>
                    <div class="animate-slideInRight delay-300">
                        <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-300 hover:ring-blue-300">
                    </div>
                    <div class="animate-slideInRight delay-400">
                        <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                        <input type="password" name="password" required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-300 hover:ring-blue-300">
                    </div>
                    <div class="animate-slideInRight delay-500">
                        <label class="block text-sm font-medium mb-1 text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-300 hover:ring-blue-300">
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition transform hover:scale-105 animate-slideInRight delay-600">
                    Daftar
                </button>

                @if($errors->any())
                    <p class="text-red-500 text-sm mt-3 animate-fadeIn">{{ $errors->first() }}</p>
                @endif

            </form>
        </div>
    </div>

    <style>
        @keyframes slideInLeft {
            0% { opacity: 0; transform: translateX(-50px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            0% { opacity: 0; transform: translateX(50px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeIn { 
            0% { opacity: 0; } 
            100% { opacity: 1; } 
        }
        @keyframes bgGradient {
            0%,100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        @keyframes bounceSlow {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-slideInLeft { animation: slideInLeft 0.5s ease-out forwards; }
        .animate-slideInRight { animation: slideInRight 0.5s ease-out forwards; }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out forwards; }
        .animate-bgGradient { background-size: 200% 200%; animation: bgGradient 10s ease infinite; }
        .animate-bounceSlow { animation: bounceSlow 3s ease-in-out infinite; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }
    </style>

</body>
</html>
