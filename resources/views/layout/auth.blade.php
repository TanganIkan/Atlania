<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Atlania - Tech Blog')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>
    <div class="min-h-screen bg-[#d9d9d9] flex items-center justify-center relative overflow-hidden">

    <div aria-hidden="true" class="absolute inset-0 pointer-events-none z-0">
        <svg class="w-full h-full opacity-30" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="wavePattern" x="0" y="0" width="100" height="20" patternUnits="userSpaceOnUse">
                    <path d="M0 10 c12.5 -10, 37.5 -10, 50 0 s37.5 10, 50 0" fill="none" stroke="#737373"
                        stroke-width="1" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#wavePattern)" />
        </svg>
    </div>

    <div class="hidden lg:block absolute left-0 top-0 w-1/3 h-full pointer-events-none z-10">
        <img src="{{ asset('assets/images/11.webp') }}"
            class="absolute right-[-20px] top-[15%] w-[280px] drop-shadow-md" />
        <img src="{{ asset('assets/images/12.webp') }}"
            class="absolute left-[10%] top-[50%] w-[320px] drop-shadow-md" />
    </div>

    <div class="hidden lg:block absolute right-0 top-0 w-1/3 h-full pointer-events-none z-10">
        <img src="{{ asset('assets/images/21.webp') }}"
            class="absolute right-[5%] top-[10%] w-[300px] drop-shadow-md" />
        <img src="{{ asset('assets/images/22.webp') }}"
            class="absolute right-[20%] top-[60%] w-[350px] drop-shadow-md" />
    </div>

    <div
        class="relative w-full max-w-md bg-gradient-to-b from-white to-[#f7f7f7] border border-black shadow-[6px_6px_0px_0px_black] p-8 z-10">
        @yield('auth-content')
    </div>
</div>
</body>
</html>
