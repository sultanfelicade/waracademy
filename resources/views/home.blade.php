<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | WarAcademy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen flex items-center justify-center animate-bgGradient">

    <div class="bg-white shadow-2xl rounded-2xl p-10 w-[700px] max-w-full text-center transform transition-transform duration-500 hover:scale-105">
        <h1 class="text-4xl font-bold text-blue-700 mb-4 animate-slideInDown">Halo, {{ $username }}</h1>
        @if(session('success'))
            <p class="text-green-500 text-lg mb-6 animate-fadeIn">{{ session('success') }}</p>
        @endif

        <p class="text-gray-700 mb-6 animate-fadeIn delay-200">Selamat datang di WarAcademy! Lanjutkan petualanganmu dan kumpulkan pengalaman sebanyak mungkin.</p>

        <div class="flex items-center justify-center gap-4 mt-8 animate-slideInUp delay-400">
            {{-- Tombol untuk melihat profil --}}
            <a href="{{ route('profil.show', ['id' => session('pengguna_id')]) }}"
               class="bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold hover:bg-sky-700 transition transform hover:scale-105">
                Lihat Profil
            </a>

            {{-- Form untuk logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition transform hover:scale-105">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <style>
        @keyframes slideInDown { 0% { opacity: 0; transform: translateY(-50px); } 100% { opacity: 1; transform: translateY(0); } }
        @keyframes slideInUp { 0% { opacity: 0; transform: translateY(50px); } 100% { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { 0% { opacity: 0; } 100% { opacity: 1; } }
        @keyframes bgGradient { 0%,100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        .animate-slideInDown { animation: slideInDown 0.5s ease-out forwards; }
        .animate-slideInUp { animation: slideInUp 0.5s ease-out forwards; }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out forwards; }
        .animate-bgGradient { background-size: 200% 200%; animation: bgGradient 10s ease infinite; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-400 { animation-delay: 0.4s; }
    </style>

</body>
</html>
