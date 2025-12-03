<x-app-layout>
    <x-slot name="header">
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 sm:px-6 lg:px-8 py-4 bg-gray-100 dark:bg-gray-800 rounded-b-lg shadow-md transition-all duration-300">
            <h2 class="font-semibold text-2xl sm:text-3xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Dashboard Kelola Tugas') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400 mt-2 sm:mt-0">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Section: Selamat Datang -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8 transition-transform duration-300 hover:scale-[1.01]">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                    Selamat Datang, {{ Auth::user()->name }} 👋
                </h3>
                <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed">
                    Anda berhasil login ke sistem. Gunakan dashboard ini untuk mengelola data mata kuliah, jadwal, dan tugas Anda dengan mudah Dan Tidak Lupa Terhadap Tugas Yang Di Berikan Dosen Anda HEHE😂.
                </p>
            </div>

{{-- <div class="mb-4">
    <label for="tugas_id" class="block text-sm font-medium text-gray-700">Tugas Terkait (Opsional)</label>
    <select name="tugas_id" id="tugas_id" class="w-full border-gray-300 rounded-md">
        <option value="">— Tidak ada tugas —</option>
        @foreach (App\Models\Tugas::where('user_id', Auth::id())->get() as $tugas)
            <option value="{{ $tugas->id }}">{{ $tugas->judul_tugas }}</option>
        @endforeach
    </select>
</div> --}}




           <!-- Section: Statistik Ringkas -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 bg-gray-700 dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-lg transition-transform duration-300 hover:scale-[1.01]">
    <!-- Total Tugas -->
    <div
        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex items-center justify-between">
        <div>
            <h4 class="text-sm font-medium opacity-80">Total Tugas</h4>
            <p class="text-3xl font-bold mt-2">{{ $totaltugass }}</p>
        </div>
        <div class="text-white/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m-6-8h6M5 8h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2zM7 4h10a1 1 0 011 1v1H6V5a1 1 0 011-1z" />
            </svg>
        </div>
    </div>

    <!-- Tugas Selesai -->
    <div
        class="bg-gradient-to-r from-green-500 to-green-600 text-white p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex items-center justify-between">
        <div>
            <h4 class="text-sm font-medium opacity-80">Tugas Selesai</h4>
            <p class="text-3xl font-bold mt-2">{{ $tugasSelesai }}</p>
        </div>
        <div class="text-white/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>

    <!-- Tugas Belum Dikerjakan -->
    <div
        class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex items-center justify-between">
        <div>
            <h4 class="text-sm font-medium opacity-80">Tugas Belum Dikerjakan</h4>
            <p class="text-3xl font-bold mt-2">{{ $tugasProses }}</p>
        </div>
        <div class="text-white/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Jumlah Jadwal -->
    <div
        class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex items-center justify-between">
        <div>
            <h4 class="text-sm font-medium opacity-80">Jumlah Jadwal</h4>
            <p class="text-3xl font-bold mt-2">{{ $totaljadwals }}</p>
        </div>
        <div class="text-white/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
    </div>

    <!-- Jumlah Mata Kuliah -->
    <div
        class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white p-5 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex items-center justify-between">
        <div>
            <h4 class="text-sm font-medium opacity-80">Jumlah Mata Kuliah</h4>
            <p class="text-3xl font-bold mt-2">{{ $totalMK }}</p>
        </div>
        <div class="text-white/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0l-3-3m3 3l3-3" />
            </svg>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('dashboardChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Tugas Total', 'Selesai', 'Belum', 'Jadwal', 'Mata Kuliah'],
                    datasets: [{
                        label: 'Statistik',
                        data: [{{ $totaltugass }}, {{ $tugasSelesai }}, {{ $tugasProses }}, {{ $totaljadwals }}, {{ $totalMK }}],
                        backgroundColor: [
                            'rgba(59,130,246,0.8)',
                            'rgba(34,197,94,0.8)',
                            'rgba(250,204,21,0.8)',
                            'rgba(147,51,234,0.8)',
                            'rgba(99,102,241,0.8)'
                        ],
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111827',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#9CA3AF' },
                            grid: { color: 'rgba(156,163,175,0.2)' }
                        },
                        x: {
                            ticks: { color: '#9CA3AF' },
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
