@extends('layout.auth')
@section('title', 'Login')

@section('auth-content')

    <h1 class="text-center text-[22px] font-semibold mb-2 text-black">Login</h1>

    <p class="text-center text-[15px] text-gray-600 mb-5">
        Masukkan detail untuk melakukan login
    </p>

    @if (session('error'))
        <div class="bg-red-50 border-2 border-red-500 p-3 rounded-xl mb-6 shadow-[3px_3px_0px_0px_#ef4444]">
            <p class="text-red-600 text-xs font-bold text-center">
                {{ session('error') }}
        </div>
        </p>
    @endif

    <form method="POST" action="{{ route('auth.login.process') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-[12px] font-semibold mb-1 text-black">
                Email*
            </label>

            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black] @error('email') border-red-500 @enderror" />

            @error('email')
                <span class="text-[10px] text-red-500 font-bold italic mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <div class="flex justify-between items-center mb-1">
                <label class="block text-[12px] font-semibold text-black">
                    Password*
                </label>
                {{-- Tambahan Opsional: Lupa Password --}}
                <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-black underline">Lupa Password?</a>
            </div>

            <input type="password" name="password" required placeholder="Masukkan password"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>


        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember"
                class="w-4 h-4 border-2 border-black rounded-none appearance-none checked:bg-yellow-300 checked:after:content-['✓'] checked:after:flex checked:after:justify-center checked:after:text-[10px] focus:ring-0 cursor-pointer transition-all">
            <label for="remember" class="ml-2 text-[10px] font-bold text-black uppercase cursor-pointer">Ingat Saya</label>
        </div>

        <div class="flex flex-col gap-3 pt-2">
            <button type="submit"
                class="w-full bg-yellow-300 border border-black px-6 py-2 text-sm font-semibold shadow-[3px_3px_0px_0px_black] transition-all duration-150 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[1px_1px_0px_0px_black] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none uppercase tracking-wider">
                Login
            </button>

            <a href="{{ route('auth.register') }}"
                class="text-center border border-black px-6 py-2 text-sm font-semibold bg-white shadow-[3px_3px_0px_0px_black] transition-all duration-150 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[1px_1px_0px_0px_black]">
                Belum punya akun? Daftar
            </a>
        </div>
    </form>

@endsection