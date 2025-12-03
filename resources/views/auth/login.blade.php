<x-guest-layout>
  <!-- HERO SECTION -->
  <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 bg-gradient-to-b from-blue-100 via-white to-blue-50 relative overflow-hidden">

    <!-- Background Decorative Circles -->
    <div class="absolute top-0 left-0 w-48 h-48 bg-blue-300/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-yellow-300/20 rounded-full blur-3xl"></div>

    <!-- Header -->
    <div class="text-center relative z-10 max-w-2xl">
      <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 leading-snug">
        Selamat Datang di
        <span class="text-blue-700">Aplikasi Kelola Tugas Berbasis Website</span>
      </h1>
      <p class="mt-3 text-gray-600 text-sm sm:text-base leading-relaxed">
        Solusi pintar untuk mengelola setiap tugas Anda dengan efisien, terstruktur, dan menyenangkan.
        Satu platform untuk merencanakan, mengingat, dan menyelesaikan tugas — kapan pun, di mana pun.
      </p>
    </div>

    <!-- Tombol Login -->
    <div class="mt-8 relative z-10">
      <button id="openLoginModal"
        class="bg-gradient-to-r from-yellow-400 to-yellow-300 text-blue-900 font-extrabold px-10 py-3 rounded-full shadow-lg hover:scale-105 hover:from-yellow-300 hover:to-yellow-200 transition-all duration-300">
        🚀 Mulai Sekarang
      </button>
    </div>

    <!-- Section Tambahan -->
    <div class="mt-12 text-center text-gray-500 text-xs sm:text-sm max-w-lg relative z-10">
      <p>
        Dengan menggunakan layanan ini, Anda setuju dengan
        <a href="{{ route('syarat') }}" class="text-blue-700 hover:text-blue-900 font-semibold transition">Ketentuan & Syarat</a>,
        <a href="{{ route('panduan') }}" class="text-blue-700 hover:text-blue-900 font-semibold transition">Panduan Penggunaan</a>, dan
        <a href="{{ route('kebijakan') }}" class="text-blue-700 hover:text-blue-900 font-semibold transition">Kebijakan Privasi</a>
        yang berlaku.
      </p>
      <p class="mt-3 text-gray-400">
        © {{ date('Y') }} WebTugas — All right reserved.
      </p>
    </div>
  </div>

  <!-- MODAL LOGIN -->
  <div id="loginModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden px-4">
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl w-full max-w-sm sm:max-w-md p-8 relative animate-fadeInUp">

      <!-- Tombol Tutup -->
      <button id="closeLoginModal"
        class="absolute top-4 right-5 text-gray-500 hover:text-gray-800 text-2xl font-bold transition">
        &times;
      </button>

      <!-- Header Modal -->
      <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Masuk ke Akun Anda</h2>
        <p class="text-gray-500 text-sm mt-1">Selamat datang kembali! Mari lanjutkan produktivitas Anda ✨</p>
      </div>

      <!-- FORM LOGIN -->
      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
          <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700 text-sm" />
          <x-text-input id="email"
            class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring-blue-600 rounded-lg shadow-sm text-sm"
            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700 text-sm" />
          <x-text-input id="password"
            class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring-blue-600 rounded-lg shadow-sm text-sm"
            type="password" name="password" required autocomplete="current-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Tombol Login -->
        <div>
          <x-primary-button
            class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-semibold text-sm transition duration-200">
            {{ __('Masuk Sekarang') }}
          </x-primary-button>
        </div>

        <!-- Link Tambahan -->
        <div class="text-center mt-4 space-y-2">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"
              class="block text-sm text-blue-600 hover:text-blue-800 font-medium transition">
              Lupa Password?
            </a>
          @endif

          @if (Route::has('register'))
            <p class="text-xs text-gray-500">
              Belum punya akun?
              <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                Daftar Sekarang
              </a>
            </p>
          @endif
        </div>
      </form>
    </div>
  </div>

  <!-- ANIMASI -->
  <style>
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.5s ease-out;
    }
  </style>

  <!-- SCRIPT -->
  @include('layouts.partials.modalsc')
</x-guest-layout>
