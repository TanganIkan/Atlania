<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Atlania - Tech Blog')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white antialiased flex flex-col min-h-screen">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="hidden md:flex items-center space-x-8 text-sm font-bold">
                    <a href="/dashboard" class="{{ Request::is('dashboard') ? 'text-orange-500' : 'text-gray-500' }}">Home</a>
                    <a href="#" class="text-gray-500 hover:text-black">Categories</a>
                    <a href="#" class="text-gray-500 hover:text-black">About</a>
                </div>

                <div class="text-3xl font-black italic tracking-tighter">
                    Atlania<span class="text-orange-500">.</span>
                </div>

                <div class="flex items-center space-x-5">
                    @auth
                        <span class="text-sm font-medium text-gray-600">Hi, {{ Auth::user()->name }}</span>
                        <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-bold bg-black text-white px-4 py-2 rounded-lg">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('auth.login') }}" class="text-sm font-bold">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-[#1a1c2e] text-white py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Subscribe to our <span class="text-purple-400 underline italic">newsletter</span>.</h2>
            
            <div class="mt-8 relative max-w-md mx-auto">
                <input type="email" placeholder="Enter Your Email" class="w-full bg-white text-black py-4 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button class="absolute right-2 top-2 bg-gray-900 p-2 rounded-lg hover:bg-black transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </button>
            </div>

            <div class="mt-16 flex flex-col md:flex-row justify-between items-center border-t border-gray-700 pt-10 text-sm text-gray-400">
                <span class="text-2xl font-black text-white italic mb-4 md:mb-0">Atlania.</span>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white">About</a>
                    <a href="#" class="hover:text-white">Features</a>
                    <a href="#" class="hover:text-white">Categories</a>
                    <a href="#" class="hover:text-white">Support</a>
                </div>
                <p class="mt-4 md:mt-0">&copy; 2026 Atlania. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>