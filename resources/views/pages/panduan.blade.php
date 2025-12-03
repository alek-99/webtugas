@extends('layouts.page')

@section('title', 'Panduan Penggunaan')
@section('header', 'Panduan Penggunaan')
@section('subtitle', 'Pelajari cara menggunakan Website ini dengan mudah dan aman.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h5>1. Pendaftaran Akun</h5>
            <p>Buat akun Anda dengan mengisi formulir pendaftaran secara lengkap dan benar, Setelah Berhasil Mendaftar maka akan langsung menuju ke dashboard.</p>

            <h5>2. Login dan Keamanan</h5>
            <p>Jika sudah membuat akun maka langsung aja login dengan menggunakan email dan kata sandi yang terdaftar untuk masuk. Jaga kerahasiaan akun Anda.</p>

            <h5>3. Penggunaan Fitur</h5>
            <p>Gunakan fitur yang disediakan sesuai kebutuhan. Untuk bantuan, <a href="{{ route('hubungidev') }}">hubungi developer.</a></p>
            <a href="{{ route('detailpanduan') }}">Lihat Detail Penggunaan</a>

        </div>
    </div>
@endsection
