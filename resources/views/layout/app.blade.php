<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Atlania - Tech Blog')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f7f3;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="bg-[#f8f7f3] border-b border-gray-100 sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 items-center h-16">

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'text-orange-500' : 'text-slate-600' }} hover:text-orange-500 transition text-sm font-semibold">
                        Home</a>
                    <div class="relative group">
                        <button
                            class="text-slate-600 hover:text-orange-500 transition flex items-center text-sm font-semibold">
                            Categories
                            <svg class="w-3 h-3 ml-1 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                    <a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about') ? 'text-orange-500' : 'text-slate-600' }} hover:text-orange-500 transition text-sm font-semibold">
                        About
                    </a>
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('dashboard') }}" class="text-4xl font-black text-[#1a1c2e] tracking-tighter">
                        Atlania<span class="text-orange-500">.</span>
                    </a>
                </div>

                <div class="flex items-center pl-6 ml-4">
                    @auth
                        <div class="flex items-center gap-6">

                            <div class="flex-shrink-0">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="text-[10px] font-black bg-[#1a1c2e] text-white px-5 py-2.5 rounded-full hover:bg-orange-600 transition flex items-center gap-2 tracking-widest uppercase">
                                        <i class="fas fa-th-large text-[10px]"></i>
                                        DASHBOARD
                                    </a>
                                @else
                                    <a href="{{ route('articles.create') }}"
                                        class="text-[10px] font-black bg-orange-600 text-white px-5 py-2.5 rounded-full hover:bg-orange-700 transition tracking-widest uppercase">
                                        WRITE
                                    </a>
                                @endif
                            </div>

                            <a href="{{ route('articles.my') }}"
                                class="hidden xl:block text-[10px] font-bold text-slate-400 hover:text-orange-500 transition uppercase tracking-widest">
                                See My Articles
                            </a>

                            {{-- Profile Section --}}
                            <a href="{{ route('profile.index') }}"
                                class="flex items-center gap-3 group border-l pl-6 border-gray-200">
                                <div class="text-right hidden lg:block">
                                    <div
                                        class="text-[10px] font-black text-[#1a1c2e] uppercase tracking-tighter leading-none group-hover:text-orange-500 transition">
                                        {{ auth()->user()->name }}
                                    </div>
                                    <div class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1">
                                        Settings
                                    </div>
                                </div>

                                <div class="relative flex-shrink-0">
                                    <img class="w-10 h-10 rounded-xl border-2 border-transparent group-hover:border-orange-500 transition-all p-0.5 object-cover"
                                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1a1c2e&color=fff"
                                        alt="Profile">
                                    {{-- Status Indicator --}}
                                    <div
                                        class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 border-2 border-[#f8f7f3] rounded-full shadow-sm">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="flex-1 flex justify-end">
                            <a href="{{ route('auth.login') }}"
                                class="hover:text-orange-500 transition text-sm font-semibold uppercase tracking-widest text-slate-600">
                                Login
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

        </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#1a1c2e] text-white pt-24 pb-12 font-['Plus_Jakarta_Sans',sans-serif]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col items-center text-center mb-24 relative">
                <div class="hidden lg:block absolute left-[20%] top-10">
                    <svg width="60" height="40" viewBox="0 0 60 40" fill="none" class="opacity-50">
                        <path d="M1 39C15 25 35 35 55 5" stroke="white" stroke-dasharray="4 4" />
                        <path d="M50 5H55V10" stroke="white" />
                    </svg>
                </div>

                <h2 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight">
                    Subscribe to our <br class="md:hidden"><br>
                    <span class="relative inline-block font-bold">
                        newsletter
                        <span class="absolute left-0 bottom-1 w-full h-[10px] bg-purple-400/40">
                        </span>
                    </span>

                </h2>

                <div class="w-full max-w-xl mt-10">
                    <div class="relative flex items-center bg-[#f8f7f3] rounded-xl p-2">
                        <input type="email" placeholder="Enter Your Email"
                            class="w-full bg-transparent px-6 py-4 text-[#1a1c2e] font-medium focus:outline-none placeholder:text-gray-400">
                        <button class="bg-[#1a1c2e] p-4 rounded-lg hover:bg-orange-600 transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center py-10 border-b border-gray-700/50">
                <div class="mb-8 md:mb-0">
                    <h3 class="text-4xl font-black tracking-tighter">Atlania.</h3>
                </div>

                <div
                    class="flex flex-wrap justify-center gap-x-10 gap-y-4 mb-8 md:mb-0 text-sm font-semibold tracking-wide text-gray-300">
                    <a href="#" class="hover:text-purple-400 transition">About</a>
                    <a href="#" class="hover:text-purple-400 transition">Categories</a>
                    <a href="#" class="hover:text-purple-400 transition">Support</a>
                </div>

                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center bg-white/10 hover:bg-white hover:text-[#1a1c2e] rounded-full transition-all duration-300">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center bg-white/10 hover:bg-white hover:text-[#1a1c2e] rounded-full transition-all duration-300">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center bg-white/10 hover:bg-white hover:text-[#1a1c2e] rounded-full transition-all duration-300">
                        <i class="fab fa-medium-m text-sm"></i>
                    </a>
                </div>
            </div>

            <div
                class="flex flex-col md:flex-row justify-between items-center pt-8 text-xs font-medium text-gray-400 tracking-wider">
                <p>© Copyright 2022, All Rights Reserved</p>
                <div class="flex space-x-8 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>