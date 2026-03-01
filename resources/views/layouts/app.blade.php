<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaraFreelance') — Биржа для фрилансеров</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    html { scroll-behavior: smooth; }
    .project-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }
    .project-card {
        transition: all 0.3s ease;
    }
</style>
</head>
<body class="bg-gray-50 font-sans antialiased">

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

   @include('partials.header')

<main>
    @yield('content')
</main>

@include('partials.footer', ['currentYear' => $currentYear ?? date('Y'), 'siteName' => $siteName ?? 'LaraFreelance'])

</body>
</html>