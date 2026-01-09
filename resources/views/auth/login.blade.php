@extends('layout.app') @extends('layout.auth') @section('title', 'Login')
@section('auth-content')

    <h1 class="text-center text-[22px] font-semibold mb-2 text-black">Login</h1>

    <p class="text-center text-[15px] text-gray-600 mb-5">
        Masukkan detail untuk melakukan login
    </p>

    @if (session('error'))
        <p class="text-red-600 text-sm font-semibold text-center mb-4">
            {{ session('error') }}
        </p>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf {{-- EMAIL --}}
        <div>
            <label class="block text-[12px] font-semibold mb-1 text-black">
                Email*
            </label>

            <input type="email" name="email" required placeholder="Masukkan email"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="block text-[12px] font-semibold mb-1 text-black">
                Password*
            </label>

            <input type="password" name="password" required placeholder="Masukkan password"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>

        {{-- BUTTON --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-3">
            <a href="{{ url('/register') }}"
                class="text-center border border-black px-6 py-2 text-sm font-semibold bg-white shadow-[3px_3px_0px_0px_black] transition-all duration-150 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[1px_1px_0px_0px_black]">
                Belum punya akun?
            </a>

            <button type="submit"
                class="bg-yellow-300 border border-black px-6 py-2 text-sm font-semibold shadow-[3px_3px_0px_0px_black] transition-all duration-150 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[1px_1px_0px_0px_black] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none">
                Login
            </button>
        </div>
    </form>

@endsection
