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
<main class="flex-1 relative flex justify-center items-start z-10 overflow-y-auto scale-90">
  <div class="flex gap-4 w-full max-w-6xl justify-center items-stretch"> <!-- Container flex baru -->
    
    <!-- Create Tournament Section -->
    <div class="animate-slideInLeft delay-300 flex-1">
      <div class="bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-6 py-4 text-white font-medium 
                  shadow-md backdrop-blur-sm h-full flex flex-col">
        <h2 class="font-semibold text-[#cfe4ff] mb-6 text-xl drop-shadow-sm tracking-wide text-left">
          Create New Tournament
        </h2>

        <h2 class="text-left mb-2">Tournament Name</h2>
        <input type="text" 
            class="bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-4 py-2 text-white font-medium 
                  shadow-md hover:bg-white/20 backdrop-blur-sm focus:bg-white/20 focus:border-blue-400 
                  focus:outline-none w-full text-left placeholder-gray-300 hover:shadow-[0_0_25px_rgba(70,150,255,0.4)] 
                  transition duration-300 mb-2"
            placeholder="Example: WAR123">

        <h2 class="mb-2">Description</h2>
        <textarea type="text-area" 
            class="bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-4 py-2 text-white font-medium 
                  shadow-md hover:bg-white/20 backdrop-blur-sm focus:bg-white/20 focus:border-blue-400 
                  focus:outline-none w-full text-left placeholder-gray-300 hover:shadow-[0_0_25px_rgba(70,150,255,0.4)] 
                  transition duration-300 mb-2 flex-1 min-h-[120px]"
            placeholder="Description Game....."></textarea>
        
        <div class="flex gap-4 mb-4">
          <div class="flex-1">
            <label class="block mb-1 text-left">Start Date</label>
            <input type="datetime-local"
                class="bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-4 py-2 text-white font-medium 
                      shadow-md hover:bg-white/20 backdrop-blur-sm focus:bg-white/20 focus:border-blue-400 
                      focus:outline-none w-full placeholder-gray-300 hover:shadow-[0_0_25px_rgba(70,150,255,0.4)] 
                      transition duration-300">
          </div>

          <div class="flex-1">
            <label class="block mb-1 text-left">End Date</label>
            <input type="datetime-local"
                class="bg-white/10 border border-[#6aa8fa]/40 rounded-xl px-4 py-2 text-white font-medium 
                      shadow-md hover:bg-white/20 backdrop-blur-sm focus:bg-white/20 focus:border-blue-400 
                      focus:outline-none w-full placeholder-gray-300 hover:shadow-[0_0_25px_rgba(70,150,255,0.4)] 
                      transition duration-300">
          </div>
        </div>
        
        <button class="relative bg-gradient-to-b from-[#2f5fa8] to-[#0c2957] text-white px-6 py-2 
                     rounded-xl font-semibold border border-[#1b3e75]
                     shadow-[0_4px_10px_rgba(0,0,30,0.5),inset_0_1px_1px_rgba(255,255,255,0.2)] 
                     overflow-hidden group w-full mt-auto">
          <span class="relative z-10" id="createButton">Create Tournament</span>
        </button>
      </div>
    </div>

    
    <!-- Overlay dan konten modal -->
    <div id="modal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
      <div class="bg-white rounded-2xl p-6 w-96 shadow-lg relative animate-scaleIn">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
        
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Judul Popup</h2>
        <p class="text-gray-600 mb-4">Tes Pop UP</p>
        
        <button id="closeModal2" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
          Tutup
        </button>
      </div>
    </div>

    <!-- My Tournaments Section -->
    <div class="animate-slideInRight delay-400 flex-1">
      <div class="border border-[#6aa8fa]/50 bg-gradient-to-b from-white/10 to-[#1b2e4a]/30 
                  rounded-2xl h-full p-6 backdrop-blur-md shadow-[0_0_15px_rgba(70,150,255,0.3)] flex flex-col">
        <h2 class="font-semibold text-[#cfe4ff] mb-4 text-xl drop-shadow-sm tracking-wide">
          🏆 My Tournaments
        </h2>
        
        <div class="flex-1 space-y-3 text-blue-100 text-sm overflow-y-auto pr-2 max-h-[400px]">
          <!-- Tournament items tetap sama -->
          <div class="bg-white/5 border border-[#6aa8fa]/30 rounded-lg p-3 flex justify-between items-center 
                      hover:bg-white/10 transition group">
            <div>
              <p class="font-semibold text-white" id="tournament-title">Fast Tournament Competition</p>
              <p class="text-xs text-blue-200">Code: <span class="font-mono bg-black/20 px-1 rounded">FTC2025</span></p>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs font-bold text-green-300 bg-green-500/20 border border-green-400/50 px-2 py-0.5 rounded-full">Active</span>
              <button class="text-xs text-yellow-300 opacity-0 group-hover:opacity-100 transition">Edit</button>
            </div>
          </div>
          <div class="bg-white/5 border border-[#6aa8fa]/30 rounded-lg p-3 flex justify-between items-center 
                      hover:bg-white/10 transition group">
            <div>
              <p class="font-semibold text-white" id="tournament-title">Fast Tournament Competition</p>
              <p class="text-xs text-blue-200">Code: <span class="font-mono bg-black/20 px-1 rounded">FTC2025</span></p>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs font-bold text-green-300 bg-green-500/20 border border-green-400/50 px-2 py-0.5 rounded-full">Active</span>
              <button class="text-xs text-yellow-300 opacity-0 group-hover:opacity-100 transition">Edit</button>
            </div>
          </div>

          <!-- Item tournament lainnya... -->
        </div>
      </div>
    </div>
    
  </div>
</main>

  <!-- Footer -->
  <footer class="flex justify-between items-end animate-slideInUp delay-500 z-10">
    <!-- Setting -->
    <button class="flex items-center gap-2 bg-white/10 border border-[#6aa8fa]/40 rounded-xl 
                   px-4 py-2 text-white font-medium shadow-md hover:bg-white/20 backdrop-blur-sm 
                   transition transform hover:scale-105">
      ⚙️ Setting
    </button>

    <!-- Top 100 -->
    <button class="relative bg-gradient-to-b from-[#2f5fa8] to-[#0c2957] text-white px-6 py-2 
                   rounded-xl font-semibold border border-[#1b3e75]
                   shadow-[0_4px_10px_rgba(0,0,30,0.5),inset_0_1px_1px_rgba(255,255,255,0.2)]
                   hover:scale-105 hover:shadow-[0_0_20px_rgba(70,150,255,0.7)]
                   transition-all duration-300 ease-in-out overflow-hidden group">
      <span class="relative z-10">🏆 Top 100</span>
      <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent 
                    translate-x-[-100%] group-hover:translate-x-[100%] 
                    transition-transform duration-700"></span>
    </button>
  </footer>

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
        textElement.textContent = textElement.textContent.substring(0,maxLength) + "...";
      }

      const modal = document.getElementById('modal');
      const openModal = document.getElementById('createButton');
      const closeModal = document.getElementById('closeModal');
      const closeModal2 = document.getElementById('closeModal2');

      openModal.addEventListener('click', () => {
        modal.classList.remove('hidden');
      });

      closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
      });

      closeModal2.addEventListener('click', () => {
        modal.classList.add('hidden');
      });

      // Tutup jika klik di luar konten popup
      window.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.classList.add('hidden');
        }
      });
  </script>

</body>
</html>
