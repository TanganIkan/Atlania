@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-[#f8f7f3] py-20 px-6">
        <div class="max-w-5xl mx-auto">

            {{-- Header Section --}}
            <div class="relative mb-16">
                <h1
                    class="text-[12vw] font-black text-[#1a1c2e] leading-[0.8] tracking-tighter uppercase opacity-[0.03] absolute -top-10 -left-4 select-none pointer-events-none">
                    Settings
                </h1>
                <div class="relative z-10">
                    <h2 class="text-5xl font-black text-[#1a1c2e] tracking-tighter uppercase">
                        Account <span class="text-[#f15a24]">Identity.</span>
                    </h2>
                    <p class="mt-4 text-gray-400 font-bold uppercase tracking-[0.3em] text-xs flex items-center gap-3">
                        <span class="w-10 h-[1px] bg-[#f15a24]"></span>
                        Manage your presence & security
                    </p>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Left Column: Profile Card --}}
                <div class="lg:col-span-1">
                    <div
                        class="bg-white p-10 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center sticky top-24">
                        <div class="relative mb-6">
                            <img class="w-32 h-32 rounded-[2rem] object-cover border-4 border-orange-50 p-1"
                                src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1a1c2e&color=fff"
                                alt="Avatar">
                            <div
                                class="absolute -bottom-2 -right-2 bg-green-500 w-8 h-8 border-4 border-white rounded-full shadow-lg">
                            </div>
                        </div>

                        <h3 class="text-2xl font-black text-[#1a1c2e] leading-tight">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-2">
                            {{ auth()->user()->email }}
                        </p>

                        <div class="mt-8 pt-8 border-t border-gray-50 w-full">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-center">
                                    <span
                                        class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Status</span>
                                    <span class="text-[10px] font-black text-green-500 uppercase">Active Now</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Joined</span>
                                    <span
                                        class="text-[10px] font-black text-[#1a1c2e] uppercase">{{ auth()->user()->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Forms --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Form Reset Password --}}
                    <div
                        class="bg-white p-10 md:p-12 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#f15a24]/5 rounded-bl-[5rem] -z-0"></div>

                        <div class="relative z-10">
                            <div class="mb-10">
                                <h4 class="text-2xl font-black text-[#1a1c2e] uppercase tracking-tighter">Security Key</h4>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mt-1">Update your
                                    password regularly</p>
                            </div>

                            @if (session('status') === 'password-updated')
                                <div
                                    class="mb-8 p-5 bg-green-50 text-green-600 rounded-3xl text-[11px] font-black uppercase tracking-widest flex items-center gap-3">
                                    <i class="fas fa-check-circle text-base"></i>
                                    Password has been updated successfully
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-8">
                                @csrf
                                @method('put')

                                <div class="space-y-5">
                                    {{-- Current Password --}}
                                    <div>
                                        <label
                                            class="text-[10px] font-bold text-[#1a1c2e] uppercase tracking-widest mb-2 block ml-1">
                                            Current Password
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="current_password" required
                                                class="w-full bg-white border border-gray-200 rounded-xl py-4 px-6 text-sm focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none placeholder-gray-300">
                                        </div>
                                    </div>

                                    {{-- New & Verify Password --}}
                                    <div class="grid md:grid-cols-2 gap-5">
                                        <div>
                                            <label
                                                class="text-[10px] font-bold text-[#1a1c2e] uppercase tracking-widest mb-2 block ml-1">
                                                New Password
                                            </label>
                                            <input type="password" name="password" required
                                                class="w-full bg-white border border-gray-200 rounded-xl py-4 px-6 text-sm focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none">
                                        </div>
                                        <div>
                                            <label
                                                class="text-[10px] font-bold text-[#1a1c2e] uppercase tracking-widest mb-2 block ml-1">
                                                Verify Password
                                            </label>
                                            <input type="password" name="password_confirmation" required
                                                class="w-full bg-white border border-gray-200 rounded-xl py-4 px-6 text-sm focus:border-[#f15a24] focus:ring-4 focus:ring-[#f15a24]/5 transition-all outline-none">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="bg-[#1a1c2e] text-white px-10 py-5 rounded-[1rem] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-[#f15a24] transition-all duration-500 shadow-xl shadow-gray-100 active:scale-95">
                                        Confirm Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Logout Section --}}
                    <div
                        class="bg-[#1a1c2e] p-10 md:p-12 rounded-[2rem] shadow-2xl shadow-gray-200 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="text-center md:text-left">
                            <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Sign Out</h4>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mt-1">Protect your
                                account before you leave</p>
                        </div>

                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-white/10 hover:bg-red-500 text-white border border-white/10 px-12 py-5 rounded-[1rem] font-black text-[11px] uppercase tracking-[0.2em] transition-all duration-300 backdrop-blur-sm">
                                Terminate Session
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection