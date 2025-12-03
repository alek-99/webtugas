<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/0a22e1a83b.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8fafc;
            color: #1e293b;
            font-family: 'Poppins', sans-serif;
        }

        header {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        footer {
            background: #1e293b;
            color: #cbd5e1;
            padding: 1.5rem 0;
            margin-top: 4rem;
            text-align: center;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1 class="fw-bold">@yield('header', 'Informasi Website')</h1>
        <p class="lead mb-0">@yield('subtitle')</p>
    </header>

    <!-- Content -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <small>
            <a href="{{ route('panduan') }}" class="text-light me-3">Panduan Penggunaan</a>
            <a href="{{ route('kebijakan') }}" class="text-light me-3">Kebijakan Privasi</a>
            <a href="{{ route('syarat') }}" class="text-light">Syarat & Ketentuan</a>
            <a href="{{ route('hubungidev') }}" class="text-light">Hubungi Developer</a>
            <a href="{{ route('login') }}">Kembali Ke Halaman Login</a>
        </small>
        <div class="mt-2 text-secondary">&copy; {{ date('Y') }} WebTugas. All rights reserved.</div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
