<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tournament | WarAcademy</title>

  <!-- Fonts & Tailwind -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&family=Black+Ops+One&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { 
            poppins: ['Poppins', 'sans-serif'],
            blackops: ['"Black Ops One"', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>

<body class="relative font-poppins min-h-screen flex flex-col justify-between p-6 text-white overflow-hidden select-none"
      style="background-image: url('/images/tournament.png');
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;
             background-attachment: fixed;">
  
  <!-- Overlay gelap (atur opacity di sini) -->
  <div id="overlay"
     class="absolute inset-0 bg-gradient-to-b from-[#0f1b2e]/0 via-[#304863]/0 to-[#3b5875]/0 
            opacity-0 z-0 transition-all duration-[2000ms] ease-in-out"></div>

  <!-- Canvas Partikel -->
  <canvas id="particles" class="absolute inset-0 z-0"></canvas>

  <!-- Header -->
  <header class="relative w-full text-center animate-fadeInDown z-10">
    <h1 class="font-blackops text-3xl md:text-4xl font-extrabold bg-gradient-to-b 
               from-[#dce6f2] via-[#a3d3fa] to-[#6aa8fa] bg-clip-text text-transparent 
               drop-shadow-[0_0_15px_rgba(70,150,255,0.6)]">
      Tournament
    </h1>

    <!-- Profil Dropdown -->
    <div x-data="{ open: false }" class="absolute right-0 top-0 flex items-center space-x-2">
      <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
        <span class="text-white/90 font-medium">{{ session('pengguna_username') ?? 'Nama' }}</span>
        <div class="w-8 h-8 border-2 border-[#6aa8fa] rounded-full bg-white/20 
                    shadow-sm backdrop-blur-sm"></div>
      </button>

      <!-- Dropdown Menu -->
      <div x-show="open" @click.away="open = false" x-transition
           class="absolute right-0 mt-12 w-40 bg-white/90 border border-gray-200 
                  rounded-lg shadow-lg py-2 text-sm z-20">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
                  class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
            Logout
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Main Section -->
  <main class="flex-1 relative flex justify-center items-center z-10">

    <!-- Daftar turnament yang di ikuti -->
    <div class="absolute top-0 left-0 mt-6 ml-6 animate-slideInLeft delay-200 md">
      <div class="border border-[#6aa8fa]/50 bg-gradient-to-b from-white/10 to-[#1b2e4a]/30 
                  rounded-2xl w-60 h-80 p-5 backdrop-blur-md shadow-[0_0_15px_rgba(70,150,255,0.3)] 
                  overflow-hidden">

        <!-- Cahaya animasi -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent 
                    translate-x-[-100%] group-hover:translate-x-[100%] 
                    transition-transform duration-[1500ms] ease-out"></div>

        <!-- Judul -->
        <h2 class="font-semibold text-[#cfe4ff] mb-4 text-lg drop-shadow-sm tracking-wide">
          🏆  Tournaments
        </h2>

        <!-- Daftar Turnamen -->
        <div class="space-y-3 text-blue-100 text-sm">

          <!-- Item 1 -->
          <div class="bg-white/5 border border-[#6aa8fa]/30 rounded-lg p-2 px-3 flex justify-between items-center 
                      hover:bg-white/10 transition">
            <a href=""><span class="truncate text-white" id="tournament-title">Fast Tournament Competition</span></a>
          </div>

          <!-- Item 2 -->
          <div class="bg-white/5 border border-[#6aa8fa]/30 rounded-lg p-2 px-3 flex justify-between items-center 
                      hover:bg-white/10 transition">
            <a href=""><span class="truncate text-white" id="tournament-title">Weekly Battle Arena</span></a>
          </div>

          <!-- Item 3 -->
          <div class="bg-white/5 border border-[#6aa8fa]/30 rounded-lg p-2 px-3 flex justify-between items-center 
                      hover:bg-white/10 transition">
            <a href=""><span class="truncate text-white" id="tournament-title">War Masters League</span></a>
          </div>
          <div class="bg-white/5 border border-[#6aa8fa]/30 rounded-lg p-2 px-3 flex justify-between items-center 
                      hover:bg-white/10 transition">
            <a href=""><span class="truncate text-white" id="tournament-title">War Masters League</span></a>
          </div>
        </div>

        <!-- Tombol lihat semua -->
        <button class="absolute bottom-4 left-1/2 -translate-x-1/2 
                      bg-gradient-to-b from-[#2f5fa8] to-[#0c2957] text-white 
                      px-4 py-1.5 rounded-lg text-xs font-semibold border border-[#1b3e75]
                      shadow-[0_4px_8px_rgba(0,0,30,0.4)]
                      hover:shadow-[0_0_20px_rgba(70,150,255,0.5)] 
                      transition-all duration-300">
          View All
        </button>
      </div>
    </div>


    <!-- Input Kode Turnamen -->
    <div class="text-center">
        <h2 class="text-lg font-semibold mb-3 text-white">Enter Tournament Code</h2>
      <input type="text" 
            class="bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-4 py-2 text-white font-medium 
                    shadow-md hover:bg-white/20 backdrop-blur-sm focus:bg-white/20 focus:border-blue-400 
                    focus:outline-none w-64 text-center placeholder-gray-300 hover:shadow-[0_0_25px_rgba(70,150,255,0.4)] 
                    transition duration-300"
            placeholder="Example: WAR123">


        <button class="relative bg-gradient-to-b from-[#2f5fa8] to-[#0c2957] text-white px-6 py-2 
                    rounded-xl font-semibold border border-[#1b3e75]
                    shadow-[0_4px_10px_rgba(0,0,30,0.5),inset_0_1px_1px_rgba(255,255,255,0.2)]
                    hover:scale-105 hover:shadow-[0_0_20px_rgba(70,150,255,0.7)]
                    transition-all duration-300 ease-in-out overflow-hidden group">
            <span class="relative z-10">Join</span>
              <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent 
                    translate-x-[-100%] group-hover:translate-x-[100%] 
                    transition-transform duration-700"></span>
        </button>
    </div>


  </main>

  <!-- Footer -->
  <div class="flex justify-between items-end animate-slideInUp delay-500 z-10 relative" 
       x-data="{ showSetting: false, volume: 0.5, muted: false }" 
       x-init="
          const savedVol = localStorage.getItem('volume');
          const savedMute = localStorage.getItem('muted');
          if(savedVol) volume = parseFloat(savedVol);
          if(savedMute) muted = savedMute === 'true';
          const audio = document.getElementById('bgMusic');
          audio.volume = volume;
          if(!muted) audio.play();
       ">

    <!-- SETTING BUTTON -->
    <div class="relative">
      <button @click="showSetting = !showSetting" 
              class="flex items-center gap-2 bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-4 py-2 text-white font-medium shadow-md hover:bg-white/20 backdrop-blur-sm transition transform hover:scale-105">
        ⚙️ Setting
      </button>

      <!-- DROPDOWN (PERBAIKAN POSISI DAN ANIMASI) -->
      <div x-show="showSetting" 
           @click.away="showSetting = false"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 translate-y-3 scale-95"
           x-transition:enter-end="opacity-100 translate-y-0 scale-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 translate-y-0 scale-100"
           x-transition:leave-end="opacity-0 translate-y-2 scale-95"
           class="absolute bottom-full mb-4 left-0 w-72 bg-white/95 text-gray-800 rounded-2xl shadow-2xl border border-gray-300/70 
                  p-5 text-sm backdrop-blur-xl z-30 origin-bottom-left">

          <h3 class="font-semibold text-gray-700 mb-2">🎵 Pengaturan Suara</h3>
          
          <!-- Toggle Musik -->
          <div class="flex justify-between items-center mb-3">
            <span>Musik</span>
            <button @click="
                muted = !muted;
                const audio = document.getElementById('bgMusic');
                if(muted){ audio.pause(); } else { audio.play(); }
                localStorage.setItem('muted', muted);
              "
              class="px-3 py-1 rounded-md font-semibold transition"
              :class="muted ? 'bg-red-500 text-white' : 'bg-green-500 text-white'">
              <span x-text="muted ? 'Mati' : 'Hidup'"></span>
            </button>
          </div>

          <!-- Slider Volume -->
          <label class="block mb-1 text-gray-700 font-medium">Volume</label>
          <input type="range" min="0" max="1" step="0.01" x-model="volume"
                 @input="
                    const audio = document.getElementById('bgMusic');
                    audio.volume = volume;
                    localStorage.setItem('volume', volume);
                 "
                 class="w-full accent-blue-600 cursor-pointer">
      </div>
    </div>

    <!-- TOP 100 -->
    <button class="relative bg-gradient-to-b from-[#2f5fa8] to-[#0c2957] text-white px-6 py-2 rounded-xl font-semibold 
                   border border-[#1b3e75]
                   shadow-[0_4px_10px_rgba(0,0,30,0.5),inset_0_1px_1px_rgba(255,255,255,0.2)]
                   hover:scale-105 hover:shadow-[0_0_20px_rgba(70,150,255,0.7)]
                   transition-all duration-300 ease-in-out overflow-hidden group">
      <span class="relative z-10">🏆 Top 100</span>
      <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent 
                    translate-x-[-100%] group-hover:translate-x-[100%] 
                    transition-transform duration-700"></span>
    </button>
  </div>


  <!-- Efek Cahaya -->
  <div class="absolute right-8 bottom-6 w-4 h-4 rounded-full bg-white/80 blur-[2px] 
              shadow-[0_0_25px_rgba(255,255,255,0.6)] animate-pulseLight"></div>

  <!-- Animasi -->
  <style>
    @keyframes slideInLeft { 0% { opacity: 0; transform: translateX(-40px); } 100% { opacity: 1; transform: translateX(0); } }
    @keyframes slideInRight { 0% { opacity: 0; transform: translateX(40px); } 100% { opacity: 1; transform: translateX(0); } }
    @keyframes slideInUp { 0% { opacity: 0; transform: translateY(40px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes slideInDown { 0% { opacity: 0; transform: translateY(-40px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { 0% { opacity: 0; } 100% { opacity: 1; } }
    @keyframes pulseLight { 0%,100% { opacity: 0.7; transform: scale(1); } 50% { opacity: 1; transform: scale(1.3); } }

    .animate-slideInLeft { animation: slideInLeft 0.6s ease-out forwards; }
    .animate-slideInRight { animation: slideInRight 0.6s ease-out forwards; }
    .animate-slideInUp { animation: slideInUp 0.6s ease-out forwards; }
    .animate-fadeInDown { animation: fadeInDown 1s ease-out forwards; }
    .animate-fadeIn { animation: fadeIn 1s ease-out forwards; }
    .animate-pulseLight { animation: pulseLight 3s ease-in-out infinite; }

    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
  </style>

  <!-- Script Partikel -->
  <script>
    const canvas = document.getElementById('particles');
    const ctx = canvas.getContext('2d');
    canvas.width = innerWidth;
    canvas.height = innerHeight;

    const particles = Array.from({ length: 60 }, () => ({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      size: Math.random() * 2,
      speedX: (Math.random() - 0.5) * 0.4,
      speedY: (Math.random() - 0.5) * 0.4,
    }));

    function drawParticles() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';

      particles.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
        ctx.fill();
        p.x += p.speedX;
        p.y += p.speedY;

        if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
        if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;
      });

      requestAnimationFrame(drawParticles);
    }

    drawParticles();

    window.addEventListener('resize', () => {
      canvas.width = innerWidth;
      canvas.height = innerHeight;
    });

      window.addEventListener('load', () => {
        const overlay = document.getElementById('overlay');
        setTimeout(() => {
          overlay.classList.remove('opacity-0');
          overlay.classList.add('opacity-100');
          overlay.classList.remove('from-[#0f1b2e]/0', 'via-[#304863]/0', 'to-[#3b5875]/0');
          overlay.classList.add('from-[#0f1b2e]/80', 'via-[#304863]/80', 'to-[#3b5875]/80');
        }, 200); // delay kecil agar efeknya lebih halus
      });

      const textElement = document.getElementById("tournament-title");
      const maxLength = "20";

      if(textElement.textContent.length > maxLength ){
        textElement.textContent = 
          textElement.textContent.substring(0,maxLength) + "...";
      }
  </script>

</body>
</html>
