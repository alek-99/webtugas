<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-200 p-4">


        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-blue-800">Buat Akun Baru</h1>
            <p class="text-gray-600 text-sm mt-1">
                Daftar sekarang untuk mulai mengelola tugasmu dengan mudah dan terorganisir.
            </p>
        </div>

        <!-- Card Form -->
        <div class="w-full max-w-sm sm:max-w-md bg-white rounded-2xl shadow-lg p-6">

            <!-- Form Register -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Nama -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold text-gray-700 text-sm" />
                    <x-text-input id="name"
                        class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm"
                        type="text" name="name" :value="old('name')" required autofocus
                        placeholder="Masukkan nama lengkap kamu" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700 text-sm" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm"
                        type="email" name="email" :value="old('email')" required
                        placeholder="contoh@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700 text-sm" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm"
                        type="password" name="password" required autocomplete="new-password"
                        placeholder="Masukkan password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-semibold text-gray-700 text-sm" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Ulangi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
                </div>

                <!-- Tombol Register -->
                <div class="pt-2">
                    <x-primary-button
                        class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition duration-200 text-sm">
                        {{ __('Daftar Sekarang') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Link ke Login -->
            <div class="text-center mt-6 space-y-2">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Masuk Sekarang
                    </a>
                </p>

                <a href="{{ route('login') }}"
                    class="inline-block mt-2 text-sm text-gray-500 hover:text-blue-600 transition">
                    ← Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>
<script>
   @if (session('success'))

    Swal.fire({
        icon: 'success',
        title: 'Pendaftaran Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500
    });
@endif
@if (session('error'))
swal.fire({
        icon: 'error',
        title: 'Pendaftaran Gagal!',
        text: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 2500
    });
    
@endif
</script>
    <style>
        @media (max-width: 640px) {
            .rounded-2xl {
                border-radius: 1rem;
            }
        }
    </style>
</x-guest-layout>
