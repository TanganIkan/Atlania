<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    {{-- Flowbite & Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus_Jakarta_Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50/50">

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-100">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="#" class="flex ml-2 md:mr-24">
                        <span
                            class="self-center text-xl font-extrabold sm:text-2xl whitespace-nowrap text-[#1a1c2e] uppercase tracking-tighter">Admin<span
                                class="text-[#f15a24]">Panel</span></span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <img class="w-8 h-8 rounded-xl"
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=f15a24&color=fff"
                            alt="user photo">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-100 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-4 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-bold text-sm uppercase tracking-wider">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 text-gray-500 rounded-2xl hover:bg-orange-50 hover:text-[#f15a24] group {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-[#f15a24]' : '' }}">
                        <i class="fas fa-th-large w-5 h-5 transition duration-75"></i>
                        <span class="ml-3 text-[11px]">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-3 text-gray-500 rounded-2xl hover:bg-orange-50 hover:text-[#f15a24] group {{ request()->routeIs('articles.index') ? 'bg-orange-50 text-[#f15a24]' : '' }}">
                        <i class="fas fa-newspaper w-5 h-5 transition duration-75"></i>
                        <span class="ml-3 text-[11px]">My Articles</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center p-3 text-gray-500 rounded-2xl hover:bg-red-50 hover:text-red-600 group transition">
                            <i class="fas fa-sign-out-alt w-5 h-5"></i>
                            <span class="ml-3 text-[11px]">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    {{-- Content --}}
    <div class="p-4 sm:ml-64 bg-gray-50/50 min-h-screen">
        <div class="p-4 mt-14">
            @yield('content')
        </div>
    </div>

</body>

</html>