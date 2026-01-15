@extends('layout.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-16">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                <div class="flex flex-col">
                    <div class="relative w-fit mb-10">
                        <h2 class="text-6xl font-extrabold text-[#1a1c2e] relative z-10">Tech<span
                                class="text-[#1a1c2e]">.</span></h2>
                        <span class="absolute left-0 bottom-1 w-full h-[10px] bg-purple-500">
                    </div>

                    <div class="flex items-center space-x-3 text-sm text-gray-400 mb-6 font-medium">
                        <span>{{ $articles->first()->user->name ?? 'Joseph Pharnaldej' }}</span>
                        <span class="text-gray-300">—</span>
                        <span>{{ $articles->first()->created_at->diffForHumans() ?? '6 hours ago' }}</span>
                    </div>

                    <h1 class="text-5xl font-bold text-[#1a1c2e] mb-6 leading-[1.15] tracking-tight">
                        {{ $articles->first()->title ?? 'The Future of Artificial Intelligence: Trends and Implications.' }}
                    </h1>

                    <div class="flex items-start space-x-5">
                        <p class="text-gray-400 text-sm leading-relaxed max-w-ld">
                            {{ Str::limit(strip_tags($articles->first()->content), 160) ?? 'The Future of Artificial Intelligence: Trends and Implications...' }}
                        </p>

                        <a href="{{ route('articles.show', optional($articles->first())->slug) }}"
                            class="flex-shrink-0 w-14 h-14 bg-[#f15a24] text-white rounded-xl flex items-center justify-center hover:bg-[#d44d1d] hover:translate-x-1 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-200 group-hover:scale-110">
                            <svg class="w-6 h-6 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>


                @if ($articles->isNotEmpty())
                    <div class="relative">
                        <div
                            class="rounded-[2.5rem] overflow-hidden shadow-2xl aspect-[4/3] bg-gray-100 flex items-center justify-center">
                            @if ($articles->first()->image)
                                <img src="{{ $articles->first()->image }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 font-bold">No Image</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-16 flex items-center justify-center space-x-8">
                <div class="h-[1px] bg-gray-200 flex-1"></div>
                <div class="flex items-baseline space-x-1">
                    <span class="text-3xl font-black text-[#1a1c2e]">2</span>
                    <span class="text-xl font-bold text-gray-300">/ 6</span>
                </div>
                <div class="h-[1px] bg-gray-200 flex-1"></div>
            </div>
        </div>

        <!-- Most Popular Articles Section -->
        <div class="mb-16">

            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                <h2 class="text-4xl font-extrabold text-[#1a1c2e]">Most Popular</h2>

                <div class="flex items-center space-x-6">
                    <div class="flex bg-gray-50 p-1 rounded-xl border border-gray-100">
                        <button
                            class="px-6 py-2.5 bg-white shadow-sm rounded-lg text-sm font-bold text-[#1a1c2e]">Technologies</button>
                        <button class="px-6 py-2.5 text-sm font-bold text-gray-400 hover:text-[#1a1c2e] transition">Digital
                            marketing</button>
                        <button
                            class="px-6 py-2.5 text-sm font-bold text-gray-400 hover:text-[#1a1c2e] transition">Business</button>
                    </div>

                    <div class="relative group">
                        <input type="text" placeholder="Search"
                            class="w-40 bg-transparent border-b border-gray-200 py-2 text-sm focus:outline-none focus:border-orange-500 transition-all">
                        <svg class="w-4 h-4 absolute right-0 top-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
                @foreach ($articles->take(6) as $article)
                    <div
                        class="group cursor-pointer p-5 transition-all duration-300 rounded-[2.5rem] hover:bg-white hover:shadow-gray-100">
                        <div
                            class="relative aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 shadow-sm bg-gray-200 flex items-center justify-center">
                            @if ($article->image)
                                <img src="{{$article->image}}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <span class="text-gray-400 font-bold uppercase text-[10px]">No Preview</span>
                            @endif
                        </div>

                        <div class="flex items-center space-x-3 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                class="w-6 h-6 rounded-full">
                            <span class="text-xs font-bold text-[#1a1c2e]">{{ $article->user->name }}</span>
                        </div>

                        <h3
                            class="text-xl font-extrabold text-[#1a1c2e] leading-snug mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <div
                            class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">
                            <span>— {{ $article->category->name ?? 'Technologies' }}</span>
                        </div>

                        <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center space-x-4 text-[11px] font-bold text-gray-400">
                                <span class="flex items-center hover:text-red-500 transition-colors cursor-pointer">
                                    <i class="far fa-heart mr-1.5 text-xs"></i>
                                    {{ number_format($article->likes_count) }}
                                </span>

                                <span class="flex items-center hover:text-blue-500 transition-colors cursor-pointer">
                                    <i class="far fa-comment mr-1.5 text-xs"></i>
                                    {{ number_format($article->comments_count) }}
                                </span>

                                <span class="flex items-center hover:text-orange-500 transition-colors cursor-pointer">
                                    <i class="far fa-bookmark mr-1.5 text-xs"></i>
                                    {{ number_format($article->save_count) }}
                                </span>
                            </div>

                            <a href="{{ route('articles.show', $article->slug) }}"
                                class="w-10 h-10 bg-[#f15a24] text-white rounded-xl flex items-center justify-center transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-100">
                                <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Must Read Section -->
        <div class="mb-16">
            <div class="flex justify-between items-end mb-10">
                <h2 class="text-4xl font-extrabold text-[#1a1c2e]">Must Read</h2>
                <a href="#"
                    class="text-sm font-bold text-orange-600 flex items-center hover:underline uppercase tracking-wider">
                    See all
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                @foreach ($articles->take(1) as $article)
                    <div class="lg:col-span-7 group cursor-pointer">
                        <div class="relative aspect-[16/8] rounded-[2rem] overflow-hidden mb-8 shadow-sm">
                            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                @if ($article->image)
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <span class="text-gray-400 font-bold">No Image</span>
                                @endif
                            </a>
                        </div>

                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                class="w-6 h-6 rounded-full">
                            <span class="text-xs font-bold text-[#1a1c2e]">{{ $article->user->name }}</span>
                            <span class="text-gray-300">—</span>
                            <span class="text-xs font-bold text-gray-400">{{ $article->created_at->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <h3
                                class="text-3xl font-extrabold text-[#1a1c2e] leading-tight mb-4 group-hover:text-orange-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                        </a>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ Str::limit(strip_tags($article->content), 180) }}
                        </p>

                        <div class="flex items-center space-x-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                            <span>{{ $article->category->name ?? 'Technologies' }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>{{ $article->read_time ?? '2min read' }}</span>
                        </div>
                    </div>
                @endforeach

                <div class="lg:col-span-5 space-y-8">
                    @foreach ($articles->take(3) as $article)
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="flex items-start space-x-6 group cursor-pointer">
                            <div class="flex items-start space-x-6 group cursor-pointer">
                                <div class="flex-shrink-0 w-32 aspect-square rounded-2xl overflow-hidden shadow-sm">
                                    @if ($article->image)
                                        <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <span class="text-gray-400 font-bold">No Image</span>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                            class="w-5 h-5 rounded-full">
                                        <span class="text-[10px] font-bold text-[#1a1c2e]">{{ $article->user->name }}</span>
                                        <span class="text-gray-300">—</span>
                                        <span class="text-[10px] font-bold text-gray-400">6 hours ago</span>
                                    </div>

                                    <h4
                                        class="text-base font-extrabold text-[#1a1c2e] leading-snug mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                        {{ $article->title }}
                                    </h4>

                                    <div
                                        class="flex items-center space-x-3 text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                        <span>{{ $article->category->name ?? 'Technologies' }}</span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span>2min read</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Weekly Highlights Section -->
        <div class="mb-16">
            <div class="flex justify-between items-end mb-12">
                <h2 class="text-4xl font-extrabold text-[#1a1c2e] tracking-tight">Weekly Highlights</h2>
                <a href="#"
                    class="text-sm font-bold text-orange-600 flex items-center hover:underline uppercase tracking-wider">
                    See all
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="relative px-10 -mx-10 overflow-hidden">
                <div class="swiper weeklySwiper !overflow-visible py-10 px-4">
                    <div class="swiper-wrapper">
                        @foreach ($articles as $article)
                            <div class="swiper-slide h-auto">
                                <div
                                    class="group cursor-pointer p-5 rounded-[2.5rem] transition-all duration-300 hover:bg-white hover:shadow-2xl hover:shadow-gray-200/50 bg-transparent border border-transparent">
                                    <div class="relative aspect-[4/3] rounded-[2.5rem] overflow-hidden mb-6 shadow-sm">
                                        @if ($article->image)
                                            <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                        @else
                                            <span class="text-gray-400 font-bold">No Image</span>
                                        @endif
                                    </div>

                                    <div class="flex items-center space-x-2 mb-4">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                            class="w-5 h-5 rounded-full shadow-sm">
                                        <span
                                            class="text-[10px] font-bold text-[#1a1c2e] uppercase tracking-tight">{{ $article->user->name }}</span>
                                    </div>

                                    <h3
                                        class="text-xl font-extrabold text-[#1a1c2e] leading-snug mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                        {{ $article->title }}
                                    </h3>

                                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">
                                        — {{ $article->category->name ?? 'Technologies' }}
                                    </div>

                                    <div class="flex items-center justify-between pt-5 border-t border-gray-50">
                                        <div class="flex items-center space-x-4 text-[11px] font-bold text-gray-400">
                                            <span class="flex items-center hover:text-red-500 transition-colors cursor-pointer">
                                                <i class="far fa-heart mr-1.5 text-xs"></i>
                                                {{ number_format($article->likes_count) }}
                                            </span>

                                            <span
                                                class="flex items-center hover:text-blue-500 transition-colors cursor-pointer">
                                                <i class="far fa-comment mr-1.5 text-xs"></i>
                                                {{ number_format($article->comments_count) }}
                                            </span>

                                            <span
                                                class="flex items-center hover:text-orange-500 transition-colors cursor-pointer">
                                                <i class="far fa-bookmark mr-1.5 text-xs"></i>
                                                {{ number_format($article->save_count) }}
                                            </span>
                                        </div>

                                        <div
                                            class="w-10 h-10 bg-[#f15a24] text-white rounded-xl flex items-center justify-center transform transition-all duration-300 group-hover:translate-x-1 group-hover:-translate-y-1 shadow-lg shadow-orange-200">
                                            <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if (session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.fixed').remove();
            }, 3000);
        </script>
    @endif
@endsection