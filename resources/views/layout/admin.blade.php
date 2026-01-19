<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50/60">

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-100">
        <div class="px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                    class="inline-flex items-center p-2 text-gray-500 rounded-xl sm:hidden hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                <span class="text-xl font-extrabold tracking-tight text-[#1a1c2e] uppercase">
                    Admin<span class="text-[#f15a24]">Panel</span>
                </span>
            </div>

            <img class="w-9 h-9 rounded-xl"
                src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=f15a24&color=fff"
                alt="user">
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-100 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-4 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 text-xs font-bold uppercase tracking-wider">

                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 rounded-2xl transition group
                    {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-[#f15a24]' : 'text-gray-500 hover:bg-orange-50 hover:text-[#f15a24]' }}">

                        <span class="inline-flex items-center justify-center w-6 h-6">
                            <i class="fas fa-th-large text-base"></i>
                        </span>

                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.articles') }}"
                        class="flex items-center p-3 rounded-2xl transition group
                    {{ request()->routeIs('admin.articles*') ? 'bg-orange-50 text-[#f15a24]' : 'text-gray-500 hover:bg-orange-50 hover:text-[#f15a24]' }}">

                        <span class="inline-flex items-center justify-center w-6 h-6">
                            <i class="fas fa-newspaper text-base"></i>
                        </span>

                        <span class="ml-3">Artikel</span>
                    </a>
                </li>

                <li class="pt-4 border-t border-gray-50 mt-4">
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center p-3 text-gray-400 rounded-2xl hover:bg-red-50 hover:text-red-600 transition group">

                            <span class="inline-flex items-center justify-center w-6 h-6">
                                <i class="fas fa-sign-out-alt text-base"></i>
                            </span>

                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </aside>

    {{-- CONTENT --}}
    <div class="p-4 sm:ml-64 bg-gray-50/60 min-h-screen">
        <div class="p-4 mt-16">
            @yield('content')
        </div>
    </div>

    {{-- Flowbite --}}
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>