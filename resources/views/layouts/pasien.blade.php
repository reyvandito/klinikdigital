<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard - Klinik Digital')</title>

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
    <!-- Navbar User -->
    <x-user.navbar />

    <!-- Main Content -->
    <main class="min-h-screen pb-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    @vite(['resources/js/app.js'])
</body>

</html>