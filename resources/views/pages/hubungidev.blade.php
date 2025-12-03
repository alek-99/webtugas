@extends('layouts.page')

@section('title', 'Hubungi Developer')
@section('header', 'Hubungi Developer')
@section('subtitle', 'Jika ada pertanyaan atanapi saran, mangga hubungi Developer.')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-16 px-6">
  <div class="max-w-lg mx-auto bg-white shadow-xl rounded-3xl p-8 sm:p-10 text-center">

    <!-- Foto Profil -->
    <img 
      src="{{ asset('storage/images/YudiP.jpg') }}" 
      alt="Foto Developer" 
      class="w-32 h-32 mx-auto rounded-full shadow-md object-cover mb-6 border-4 border-blue-100"
    />

    <!-- Nama & Deskripsi -->
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Yudi Permana</h1>
    <p class="text-gray-600 text-sm sm:text-base">Mahasiswa Unbaja Angkatan 2024 • Teknik Informatika</p>
    <p class="text-gray-500 italic mt-2 text-sm">"Ngoding bari ngopi jeng Sebat Meh inspirasi teu pareum ☕"</p>

    <!-- Informasi Kontak -->
    <div class="mt-8 space-y-5 text-gray-700">
      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-200 pb-3">
        <span class="font-semibold text-blue-700">📞 Whatsapp</span>
        <a href="https://wa.me/6281389090873" target="_blank" class="text-blue-600 hover:underline text-sm sm:text-base">
          +62 813-8909-0873
        </a>
      </div>

      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-200 pb-3">
        <span class="font-semibold text-blue-700">📧 Email</span>
        <a href="mailto:kuyud45@gmail.com" class="text-blue-600 hover:underline text-sm sm:text-base">
          kuyud45@gmail.com
        </a>
      </div>

      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-200 pb-3">
        <span class="font-semibold text-blue-700">🌐 Portofolio</span>
        <a href="https://alex-99.github.io/myporto.id/" target="_blank" class="text-blue-600 hover:underline text-sm sm:text-base">
          MyPorto.id
        </a>
      </div>

      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <span class="font-semibold text-blue-700">📍 Lokasi</span>
        <span class="text-gray-600 text-sm sm:text-base">Lebak, Banten, Indonesia</span>
      </div>
    </div>

    <!-- Media Sosial -->
    <div class="mt-10">
      <h2 class="text-xl font-semibold text-gray-800 mb-5">Media Sosial</h2>
      <div class="flex justify-center space-x-8">

        <!-- Facebook -->
        <a href="https://www.facebook.com/profile.php?id=100013086767710" target="_blank" 
           class="text-blue-600 hover:text-blue-700 transform hover:scale-110 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 12.07C22 6.51 17.52 2 12 2S2 6.51 2 12.07c0 5.02 3.66 9.18 8.44 9.93v-7.03H8.09v-2.9h2.35V9.83c0-2.33 1.38-3.62 3.5-3.62.7 0 1.43.12 1.43.12v2.5h-.8c-.79 0-1.04.49-1.04 1v1.2h2.77l-.44 2.9h-2.33V22c4.78-.75 8.44-4.91 8.44-9.93Z"/>
          </svg>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/yuuuddd14?igsh=MWUxc2h0ZDJ6aWt5eQ==" target="_blank" 
           class="text-pink-500 hover:text-pink-600 transform hover:scale-110 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7Zm10 2c1.66 0 3 1.34 3 3v10c0 1.65-1.34 3-3 3H7c-1.65 0-3-1.35-3-3V7c0-1.66 1.35-3 3-3h10ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm4.5-2a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z"/>
          </svg>
        </a>

        <!-- TikTok -->
        <a href="https://www.tiktok.com/@lawxcorazon71?_r=1&_t=ZS-917forBUFyk" target="_blank" 
           class="text-gray-800 hover:text-gray-900 transform hover:scale-110 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12.75 2h2.09c.15 1.58.84 2.88 2.03 3.96 1.19 1.09 2.51 1.64 4.13 1.7v2.21c-1.53-.04-2.96-.46-4.23-1.26v6.6a6.61 6.61 0 0 1-1.34 3.98 6.64 6.64 0 0 1-7.19 2.32 6.63 6.63 0 0 1-4.8-6.34c0-3.76 3.04-6.67 6.75-6.67.37 0 .75.03 1.13.09v2.35c-.36-.08-.73-.12-1.11-.12a4.32 4.32 0 0 0-4.37 4.35 4.33 4.33 0 0 0 2.93 4.1 4.35 4.35 0 0 0 5.04-1.52 4.28 4.28 0 0 0 .79-2.52V2Z"/>
          </svg>
        </a>

      </div>
    </div>

    <!-- Pesan Penutup -->
    <p class="mt-10 text-gray-500 text-sm italic leading-relaxed">
      Terimakasih Sudah Mampir 🙏 <br>
      Upami aya ide, kolaborasi, atanapi sekadar silaturahmi, mangga waé dihubungi, nya 😊
    </p>

  </div>
</div>
@endsection
