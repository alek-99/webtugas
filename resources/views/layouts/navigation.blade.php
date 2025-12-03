<nav x-data="{ open: false }"
    class="sticky top-0 z-50 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 backdrop-blur-lg border-b border-gray-700 shadow-lg transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Kiri: Logo + Link -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400 group-hover:text-blue-400 transition"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6M9 8h6M7 4h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                    <span class="text-xl font-semibold text-gray-100 group-hover:text-blue-400 transition">
                        WebTugas
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                        class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                        Profil
                    </x-nav-link>

                    <x-nav-link href="{{ route('matakuliahs.index') }}"
                        class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                        Mata Kuliah
                    </x-nav-link>

                    <x-nav-link href="{{ route('jadwals.index') }}"
                        class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                        Jadwal
                    </x-nav-link>

                    <x-nav-link href="{{ route('tugass.index') }}"
                        class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                        Tugas
                    </x-nav-link>
                </div>
            </div>

            <!-- Kanan: User Dropdown -->
            <div class="hidden sm:flex items-center space-x-3">
                <span class="text-sm text-gray-300">
                    Halo, <strong class="text-blue-400">{{ Auth::user()->name }}</strong>
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 px-3 py-2 rounded-xl bg-gray-800 hover:bg-blue-500 transition-all duration-300 shadow-sm">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                                alt="User Avatar" class="h-8 w-8 rounded-full border border-gray-600">
                            <span class="text-gray-300 text-sm">Menu</span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-blue-600 text-gray-200 transition">
                            Profil
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('matakuliahs.index')" class="hover:bg-blue-600 text-gray-200 transition">
                            Mata Kuliah
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('jadwals.index')" class="hover:bg-blue-600 text-gray-200 transition">
                            Jadwal
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('tugass.index')" class="hover:bg-blue-600 text-gray-200 transition">
                            Tugas
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('notifikasi.create')" class="hover:bg-blue-600 text-gray-200 transition">
                            Notifikasi
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="hover:bg-gray-700 text-red-400 transition"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Tombol Hamburger (Mobile) -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-blue-400 hover:bg-gray-800 transition-all">
                    <span x-show="!open" class="font-bold text-xl">☰</span>
                    <span x-show="open" class="font-bold text-xl">✕</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-gray-900/95 border-t border-gray-700 backdrop-blur-md shadow-md transition-all duration-300">

        <!-- User Info -->
        <div class="border-b border-gray-700 px-4 py-3">
            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                    alt="User Avatar" class="h-9 w-9 rounded-full border border-gray-700">
                <div>
                    <div class="font-semibold text-gray-100">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        <!-- Links -->
        <div class="px-4 py-3 space-y-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-gray-200 hover:text-blue-400 transition-colors duration-200">Dashboard</x-responsive-nav-link>

            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                class="text-gray-200 hover:text-blue-400 transition-colors duration-200">Profil</x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('matakuliahs.index') }}"
                class="text-gray-200 hover:text-blue-400 transition-colors duration-200">Mata Kuliah</x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('jadwals.index') }}"
                class="text-gray-200 hover:text-blue-400 transition-colors duration-200">Jadwal</x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('tugass.index') }}"
                class="text-gray-200 hover:text-blue-400 transition-colors duration-200">Tugas</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('notifikasi.create') }}"
                class="text-gray-200 hover:text-blue-400 transition-colors duration-200">Notifikasi</x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}" class="pt-2">
                @csrf
                <x-responsive-nav-link :href="route('logout')" class="text-red-400 hover:text-blue-400 transition-colors duration-200"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Keluar
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
