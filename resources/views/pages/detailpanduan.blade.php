@extends('layouts.page')

@section('title', 'Detail Panduan')
@section('header', 'Detail Panduan')
@section('subtitle', 'Pelajari lebih lanjut tentang cara menggunakan fitur ini.')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-12 px-6">
  <div class="max-w-6xl mx-auto">
    <!-- JUDUL SECTION -->
    <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-800 mb-10">
      CARA PENGGUNAAN
    </h2>

    <!-- GRID CARD -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Tambah Mata Kuliah -->
      <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="bg-gray-100 flex items-center justify-center h-56">
          <img src="{{ asset('storage/panduan/ADD MATKUL.png') }}" alt="Tambah Mata Kuliah"
               class="w-full h-full object-contain p-4">
        </div>
        <div class="p-5 text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Tambah Mata Kuliah</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Buat, edit, dan pantau mata kuliah Anda terlebih dahulu dengan antarmuka yang intuitif dan efisien.
          </p>
        </div>
      </div>

      <!-- Tambah Jadwal -->
      <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="bg-gray-100 flex items-center justify-center h-56">
          <img src="{{ asset('storage/panduan/ADD JADWAL.png') }}" alt="Tambah Jadwal"
               class="w-full h-full object-contain p-4">
        </div>
        <div class="p-5 text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Tambah Jadwal</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Tambah, edit, dan atur jadwal mata kuliah Anda setelah menambahkan mata kuliah.
          </p>
        </div>
      </div>

      <!-- Tambah Tugas -->
      <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="bg-gray-100 flex items-center justify-center h-56">
          <img src="{{ asset('storage/panduan/ADD TUGAS.png') }}" alt="Tambah Tugas"
               class="w-full h-full object-contain p-4">
        </div>
        <div class="p-5 text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Tambah Tugas</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Tambah, edit, dan pantau tugas harian Anda setelah membuat data mata kuliah.
          </p>
        </div>
      </div>

      <!-- Lihat Tugas -->
      <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="bg-gray-100 flex items-center justify-center h-56">
          <img src="{{ asset('storage/panduan/LIHAT TUGAS.png') }}" alt="Lihat Tugas"
               class="w-full h-full object-contain p-4">
        </div>
        <div class="p-5 text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Lihat Tugas</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Lihat dan update tugas Anda jika sudah dikerjakan.
          </p>
        </div>
      </div>

      <!-- Lihat Statistik -->
      <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="bg-gray-100 flex items-center justify-center h-56">
          <img src="{{ asset('storage/panduan/LIHAT STATISTIK.png') }}" alt="Lihat Statistik"
               class="w-full h-full object-contain p-4">
        </div>
        <div class="p-5 text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Lihat Statistik</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            Setelah membuat tugas, Anda dapat melihat statistik dari tugas yang telah dibuat.
          </p>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
