<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-200 p-4">

        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-blue-800">Lupa Password?</h1>
            <p class="text-gray-600 text-sm mt-1">
                Tenang, kami akan mengirimkan link reset password ke email kamu.
            </p>
        </div>

        <!-- Card Form -->
        <div class="w-full max-w-sm sm:max-w-md bg-white rounded-2xl shadow-lg p-6">

            <!-- Pesan Status -->
            <x-auth-session-status class="mb-4 text-sm text-green-600 text-center" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700 text-sm" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm"
                        type="email" name="email" :value="old('email')" required autofocus
                        placeholder="Masukkan alamat email kamu" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <!-- Tombol -->
                <div class="pt-2">
                    <x-primary-button
                        class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition duration-200 text-sm">
                        {{ __('Kirim Link Reset Password') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Link Kembali -->
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    ← Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Efek lembut untuk tampilan mobile */
        @media (max-width: 640px) {
            .rounded-2xl {
                border-radius: 1rem;
            }
        }
    </style>
</x-guest-layout>
