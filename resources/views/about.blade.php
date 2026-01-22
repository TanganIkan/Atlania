@extends('layout.app')

@section('content')
    <div>
        <section class="relative min-h-screen flex items-center overflow-hidden bg-[#f8f7f3]">
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
                <h1 class="text-[25vw] font-black uppercase tracking-tighter text-[#1a1c2e]">
                    Journal
                </h1>
            </div>

            <div class="max-w-7xl mx-auto px-6 w-full relative z-10">
                <div class="flex flex-col">
                    <div class="overflow-hidden">
                        <h2
                            class="text-6xl md:text-8xl lg:text-9xl font-black text-[#1a1c2e] leading-[0.9] tracking-tighter uppercase mb-8">
                            Curating <span class="text-[#f15a24]">Ideas</span><br>
                            For <span class="relative">
                                Creators.
                                <span class="absolute bottom-2 left-0 w-full h-3 md:h-6 bg-purple-500/20 -z-10"></span>
                            </span>
                        </h2>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center gap-6 mt-4">
                        <div class="h-[2px] w-24 bg-[#f15a24]"></div>
                        <p class="text-gray-400 font-bold tracking-[0.3em] uppercase text-sm md:text-base">
                            Tech, Design, & Digital Culture Insights — Based in Denpasar
                        </p>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3">
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-[#1a1c2e]/40">Explore More</span>
                <div class="w-[1px] h-12 bg-gradient-to-b from-[#1a1c2e]/40 to-transparent"></div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 py-32">
            <div class="grid lg:grid-cols-2 gap-24 items-center">

                <div class="relative group">
                    <div
                        class="aspect-[4/5] rounded-[3.5rem] overflow-hidden shadow-2xl transition-transform duration-700 group-hover:scale-[0.98]">

                        <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=2070"
                            alt="Reading Context"
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                    </div>

                    <div
                        class="absolute -bottom-12 -right-12 bg-[#1a1c2e] p-12 rounded-[3rem] shadow-2xl text-white hidden xl:block max-w-sm border-t border-r border-white/10">
                        <p class="text-lg leading-relaxed font-medium italic opacity-90">
                            "Reading is the most efficient way to steal ideas from the future."
                        </p>
                        <div class="mt-6 flex items-center gap-3">
                            <div class="w-8 h-[1px] bg-[#f15a24]"></div>
                            <span class="font-bold text-[#f15a24] uppercase tracking-widest text-xs">The Editorial
                                Team</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-10">
                    <div class="space-y-6">
                        <span class="text-[#f15a24] font-black text-sm uppercase tracking-[0.4em]">Our Mission</span>
                        <h3 class="text-4xl md:text-5xl font-black text-[#1a1c2e] leading-tight">Bridging Code <br>&
                            Creativity.</h3>
                        <p class="text-gray-500 leading-relaxed text-lg max-w-xl">
                            We believe that every story has the power to spark a movement. This platform is more than just a
                            blog—it's a digital haven where technology meets aesthetics. We are committed to empowering
                            developers, designers, and creative minds through deep insights and thought-provoking
                            narratives.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-12 py-8 border-y border-gray-100">
                        <div>
                            <div class="text-5xl font-black text-[#1a1c2e]">500+</div>
                            <div class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.3em] mt-2">
                                Curated Stories
                            </div>
                        </div>
                        <div>
                            <div class="text-5xl font-black text-[#1a1c2e]">20k+</div>
                            <div class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.3em] mt-2">
                                Monthly Readers
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-6 group">
                            <div
                                class="w-16 h-16 bg-[#f15a24] text-white rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:rotate-[360deg] group-hover:rounded-[2rem] shadow-xl shadow-orange-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                            <span
                                class="text-[#1a1c2e] font-black uppercase tracking-tighter text-2xl group-hover:translate-x-2 transition-transform duration-300">
                                Start Exploring
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection