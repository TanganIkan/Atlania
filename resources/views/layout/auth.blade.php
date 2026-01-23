<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Atlania - Tech Blog')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-[#f8f7f3] flex items-center justify-center relative overflow-hidden">

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
        <div class="relative w-full max-w-md bg-white rounded-[2rem] md:rounded-[2.5rem] 
            shadow-[0_15px_40px_rgba(26,28,46,0.08)] md:shadow-[0_20px_50px_rgba(26,28,46,0.05)] 
            border border-gray-100 p-8 md:p-12 z-10 transition-all duration-500 
            hover:shadow-[0_30px_60px_rgba(26,28,46,0.1)]">
            <div
                class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-[#f15a24]/5 rounded-bl-[4rem] md:rounded-bl-[5rem] -z-0">
            </div>

            <div class="relative z-10">
                @yield('auth-content')
            </div>
        </div>
    </div>
</body>

</html>