@extends('layout.auth')
@section('title', 'Login')

@section('auth-content')

    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black text-[#1a1c2e] uppercase italic tracking-tighter">
            Atlania<span class="text-[#f15a24]">.</span>
        </h1>
        <p class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-widest italic">
            Enter your credentials to continue
        </p>
    </div>

    {{-- Display Error Message --}}
    @if (session('error'))
        <div class="bg-red-50 border border-red-100 p-4 rounded-2xl mb-6 flex items-center gap-3 animate-pulse">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <p class="text-red-600 text-[11px] font-black uppercase tracking-wider">
                {{ session('error') }}
            </p>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login.process') }}" class="space-y-6">
        @csrf

        {{-- Email Field --}}
        <div>
            <label class="block text-[10px] font-black text-[#1a1c2e] uppercase tracking-[0.2em] mb-2 ml-1">
                Email Address
            </label>
            <div class="relative group">
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@company.com"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[1.5rem] text-sm focus:bg-white focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder:text-gray-300 @error('email') border-red-500 @enderror" />
                <div
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#f15a24] transition-colors">
                    <i class="far fa-envelope"></i>
                </div>
            </div>
            @error('email')
                <span class="text-[9px] text-red-500 font-bold uppercase italic mt-2 ml-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password Field --}}
        <div>
            <div class="flex justify-between items-center mb-2 ml-1">
                <label class="block text-[10px] font-black text-[#1a1c2e] uppercase tracking-[0.2em]">
                    Password
                </label>
                <a href="#"
                    class="text-[9px] font-black text-gray-400 hover:text-[#f15a24] uppercase tracking-widest transition-colors">Forgot?</a>
            </div>
            <div class="relative group">
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-[1.5rem] text-sm focus:bg-white focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder:text-gray-300" />
                <div
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#f15a24] transition-colors">
                    <i class="far fa-eye-slash"></i>
                </div>
            </div>
        </div>

        {{-- Remember Me: Custom Rounded --}}
        <div class="flex items-center ml-1">
            <label class="relative flex items-center cursor-pointer">
                <input type="checkbox" name="remember" id="remember" class="sr-only peer">
                <div
                    class="w-5 h-5 bg-gray-100 border border-gray-200 rounded-lg peer peer-checked:bg-[#f15a24] peer-checked:border-[#f15a24] transition-all flex items-center justify-center">
                    <i
                        class="fa-solid fa-check pt-1 text-white md:text-white text-[10px] scale-100 peer-checked:scale-100 transition-transform"></i>
                </div>
                <span
                    class="ml-3 text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover:text-[#1a1c2e] transition-colors">
                    Keep me signed in
                </span>
            </label>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col gap-4 pt-2">
            <button type="submit"
                class="w-full bg-[#1a1c2e] text-white py-5 rounded-[1.5rem] font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-gray-200 hover:bg-[#f15a24] hover:shadow-orange-100 transition-all active:scale-[0.98]">
                Sign In to Atlania
            </button>

            <p class="text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                Don't have an account?
                <a href="{{ route('auth.register') }}"
                    class="text-[#f15a24] hover:underline decoration-2 underline-offset-4">Create One</a>
            </p>
        </div>
    </form>
@endsection