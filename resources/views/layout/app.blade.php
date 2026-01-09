<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Blog')</title>

    {{-- Tailwind --}}
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased">
    @yield('content')
</body>
</html>
