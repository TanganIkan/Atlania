<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | AdminPanel</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50/60 custom-scrollbar">

    {{-- Top Navbar --}}
    <nav class="fixed top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                    class="inline-flex items-center p-2 text-gray-500 rounded-xl sm:hidden hover:bg-gray-100">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <span class="text-xl font-black tracking-tighter text-[#1a1c2e] uppercase italic">
                    Admin<span class="text-[#f15a24]">Panel.</span>
                </span>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span
                        class="text-[11px] font-black text-[#1a1c2e] uppercase tracking-wider">{{ auth()->user()->name }}</span>
                    <span
                        class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ auth()->user()->email }}</span>
                </div>
                <div class="relative group">
                    <img class="w-10 h-10 rounded-2xl border-2 border-orange-100 p-0.5 object-cover"
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1a1c2e&color=fff"
                        alt="user">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-100 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-6 pb-6 overflow-y-auto bg-white flex flex-col justify-between custom-scrollbar">

            <div>
                {{-- Quick Search Mini --}}
                <div class="relative mb-8 mt-2">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                        <i class="fas fa-search text-[10px]"></i>
                    </span>
                    <input type="text" placeholder="Search menu..."
                        class="w-full bg-gray-50 border-none rounded-2xl py-3 pl-10 text-[10px] focus:ring-2 focus:ring-orange-100 placeholder-gray-400 font-bold uppercase tracking-[0.1em]">
                </div>

                <p class="px-2 mb-4 text-[10px] font-black text-gray-300 uppercase tracking-[0.25em]">General</p>

                <ul class="space-y-2 text-xs font-bold uppercase tracking-wider">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-3.5 rounded-[1.25rem] transition-all duration-300 group
                            {{ request()->routeIs('admin.dashboard') ? 'bg-[#1a1c2e] text-white shadow-xl shadow-gray-200' : 'text-gray-500 hover:bg-orange-50 hover:text-[#f15a24]' }}">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-[#f15a24]/20' : 'bg-gray-50' }} group-hover:bg-[#f15a24]/10 transition-colors">
                                <i class="fas fa-chart-pie text-base"></i>
                            </span>
                            <span class="ml-3 tracking-tight">Overview</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.articles') }}"
                            class="flex items-center p-3.5 rounded-[1.25rem] transition-all duration-300 group
                            {{ request()->routeIs('admin.articles*') ? 'bg-[#1a1c2e] text-white shadow-xl shadow-gray-200' : 'text-gray-500 hover:bg-orange-50 hover:text-[#f15a24]' }}">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('admin.articles*') ? 'bg-[#f15a24]/20' : 'bg-gray-50' }} group-hover:bg-[#f15a24]/10 transition-colors">
                                <i class="fas fa-file-alt text-base"></i>
                            </span>
                            <span class="ml-3 tracking-tight">Article Manager</span>
                        </a>
                    </li>
                </ul>

                <p class="px-2 mt-10 mb-4 text-[10px] font-black text-gray-300 uppercase tracking-[0.25em]">Tools</p>
                <ul class="space-y-2 text-xs font-bold uppercase tracking-wider">
                    <li>
                        <a href="/" target="_blank"
                            class="flex items-center p-3.5 text-gray-500 rounded-[1.25rem] hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 group">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gray-50 transition-colors group-hover:bg-blue-100">
                                <i class="fas fa-external-link-alt text-base"></i>
                            </span>
                            <span class="ml-3 tracking-tight">Live Preview</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Logout Action --}}
            <div class="mt-auto">
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center p-4 text-gray-500 bg-gray-50 rounded-[2rem] hover:bg-red-50 hover:text-red-600 transition-all duration-300 group border border-transparent hover:border-red-100">
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-sm transition-colors group-hover:bg-red-600 group-hover:text-white text-red-500">
                            <i class="fas fa-power-off text-sm"></i>
                        </span>
                        <span class="ml-4 font-black uppercase text-[11px] tracking-widest">Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="p-4 sm:ml-72 min-h-screen">
        <div class="p-4 mt-20">
            @yield('content')
        </div>
    </div>

</body>

</html>