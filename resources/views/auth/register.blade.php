@extends('layout.auth') @section('title', 'Register') @section('auth-content')
    <h1 class="text-center text-[22px] font-semibold text-black mb-2">
        Daftar Akun
    </h1>

    <p class="text-center text-[15px] text-gray-600 mb-6">
        Masukkan detail untuk melakukan register
    </p>

    <form method="POST" action="{{ route('auth.register') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-[12px] font-semibold text-black mb-1">
                Nama*
            </label>
            <input type="text" name="name" required placeholder="Masukkan nama"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-black mb-1">
                Email*
            </label>
            <input type="email" name="email" required placeholder="Masukkan email"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-black mb-1">
                Password*
            </label>
            <input type="password" name="password" required placeholder="Masukkan password"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-black mb-1">
                Konfirmasi Password*
            </label>
            <input type="password" name="password_confirmation" required placeholder="Konfirmasi password"
                class="w-full px-3 py-2 text-sm border border-black bg-white shadow-[3px_3px_0px_0px_black] placeholder:text-gray-400 transition-all duration-150 focus:outline-none focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-[1px_1px_0px_0px_black]" />
        </div>

        <p class="text-[10px] text-black max-w-[280px] leading-snug">
            Informasi ini akan disimpan dengan aman sesuai dengan
            <strong>Ketentuan Layanan</strong>
            dan
            <a href="#" class="underline font-semibold">Kebijakan Privasi</a>
        </p>

        <div class="flex flex-col gap-3 pt-2">
            <button type="submit"
                class="w-full bg-yellow-300 border border-black px-8 py-2 text-sm font-semibold shadow-[3px_3px_0px_0px_black] transition-all duration-150 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[1px_1px_0px_0px_black] active:translate-x-[3px] active:translate-y-[3px] active:shadow-none">
                Daftar
            </button>

            <a href="/login"
                class="text-center border border-black px-6 py-2 text-sm font-semibold bg-white shadow-[3px_3px_0px_0px_black] transition-all duration-150 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[1px_1px_0px_0px_black]">
                Sudah punya akun? Login
            </a>
        </div>
    </form>
@endsection