@extends('layout.auth')
@section('title', 'Register')

@section('auth-content')
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black text-[#1a1c2e] uppercase italic tracking-tighter">
            Atlania<span class="text-[#f15a24]">.</span>
        </h1>
        <p class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-widest italic">
            Join our community of creators
        </p>
    </div>

    <form method="POST" action="{{ route('auth.register.process') }}" class="space-y-5">
        @csrf

        {{-- Input Nama --}}
        <div>
            <label class="block text-[10px] font-black text-[#1a1c2e] uppercase tracking-[0.2em] mb-2 ml-1">
                Full Name
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter your name"
                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-[1.5rem] text-sm focus:bg-white focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder:text-gray-300 @error('name') border-red-500 @enderror" />
            @error('name')
                <span class="text-[9px] text-red-500 font-bold uppercase italic mt-2 ml-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Input Email --}}
        <div>
            <label class="block text-[10px] font-black text-[#1a1c2e] uppercase tracking-[0.2em] mb-2 ml-1">
                Email Address
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@company.com"
                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-[1.5rem] text-sm focus:bg-white focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder:text-gray-300 @error('email') border-red-500 @enderror" />
            @error('email')
                <span class="text-[9px] text-red-500 font-bold uppercase italic mt-2 ml-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-[10px] font-black text-[#1a1c2e] uppercase tracking-[0.2em] mb-2 ml-1">
                    Password
                </label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-[1.5rem] text-sm focus:bg-white focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder:text-gray-300 @error('password') border-red-500 @enderror" />
                @error('password')
                    <span class="text-[9px] text-red-500 font-bold uppercase italic mt-2 ml-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-[#1a1c2e] uppercase tracking-[0.2em] mb-2 ml-1">
                    Confirm
                </label>
                <input type="password" name="password_confirmation" required placeholder="••••••••"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-[1.5rem] text-sm focus:bg-white focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder:text-gray-300" />
            </div>
        </div>

        <div class="py-2">
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed text-center">
                By signing up, you agree to our
                <a href="#" class="text-[#1a1c2e] underline decoration-[#f15a24] decoration-2 underline-offset-4">Terms</a>
                and <a href="#"
                    class="text-[#1a1c2e] underline decoration-[#f15a24] decoration-2 underline-offset-4">Privacy</a>
            </p>
        </div>

        <div class="flex flex-col gap-4 pt-2">
            <button type="submit"
                class="w-full bg-[#1a1c2e] text-white py-5 rounded-[1.5rem] font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-gray-200 hover:bg-[#f15a24] hover:shadow-orange-100 transition-all active:scale-[0.98]">
                Join Atlania Now
            </button>

            <p class="text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                Already a member?
                <a href="{{ route('auth.login') }}"
                    class="text-[#f15a24] hover:underline decoration-2 underline-offset-4">Sign In</a>
            </p>
        </div>
    </form>
@endsection