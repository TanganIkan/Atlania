@extends('layout.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

        {{-- Hero Section --}}
        <div class="mb-12 md:mb-16">
            <div class="swiper heroSwiper overflow-visible">
                <div class="swiper-wrapper">
                    @foreach ($popularArticles as $article)
                        <div class="swiper-slide">
                            {{-- Grid Responsive: Stacked on Mobile, Side-by-side on MD --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                                <div class="flex flex-col order-2 md:order-1">
                                    <div class="relative w-fit mb-6 md:mb-10">
                                        <h2 class="text-4xl md:text-6xl font-extrabold text-[#1a1c2e] relative z-10">
                                            {{ $article->category->name ?? 'Belum ada artikel' }}<span class="text-[#1a1c2e]">.</span>
                                        </h2>
                                        <div class="absolute left-0 bottom-1 w-full h-[8px] md:h-[10px] bg-purple-500"></div>
                                    </div>

                                    <div class="flex items-center space-x-3 text-xs md:text-sm text-gray-400 mb-4 md:mb-6 font-medium">
                                        <span>{{ $article->user->name ?? 'Unknown Author' }}</span>
                                        <span class="text-gray-300">—</span>
                                        <span>{{ $article->created_at->diffForHumans() }}</span>
                                    </div>

                                    <h1 class="text-3xl md:text-5xl font-bold text-[#1a1c2e] mb-4 md:mb-6 leading-[1.2] md:leading-[1.15] tracking-tight">
                                        {{ $article->title }}
                                    </h1>

                                    <div class="flex items-start space-x-4 md:space-x-5">
                                        <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                                            {{ Str::limit(strip_tags($article->content), 120) }}
                                        </p>

                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-[#f15a24] text-white rounded-xl flex items-center justify-center hover:bg-[#d44d1d] hover:translate-x-1 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-200">
                                            <svg class="w-5 h-5 md:w-6 md:h-6 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="relative order-1 md:order-2">
                                    <div class="rounded-[2rem] md:rounded-[2.5rem] shadow-sm overflow-hidden aspect-video md:aspect-[4/3] bg-gray-100 flex items-center justify-center">
                                        @if ($article->image)
                                            <img src="{{$article->image}}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400 font-bold">No Image</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Responsive --}}
                <div class="mt-8 md:mt-16 flex items-center justify-center space-x-4 md:space-x-8">
                    <div class="hidden sm:block h-[1px] bg-gray-200 flex-1"></div>
                    <div class="hero-pagination-bullet !static !w-auto flex items-baseline space-x-1"></div>
                    <div class="hidden sm:block h-[1px] bg-gray-200 flex-1"></div>
                </div>
            </div>
        </div>

        {{-- Most Popular Articles Section --}}
        <div class="mb-16">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 md:mb-12 gap-6">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#1a1c2e]">Most Popular</h2>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full md:w-auto">
                    {{-- Scrollable Category on Mobile --}}
                    <div class="flex bg-gray-50 p-1 rounded-xl border border-gray-100 overflow-x-auto max-w-full no-scrollbar">
                        <button class="whitespace-nowrap px-4 md:px-6 py-2 bg-white shadow-sm rounded-lg text-sm font-bold text-[#1a1c2e]">Technologies</button>
                        <button class="whitespace-nowrap px-4 md:px-6 py-2 text-sm font-bold text-gray-400 hover:text-[#1a1c2e] transition">Health</button>
                        <button class="whitespace-nowrap px-4 md:px-6 py-2 text-sm font-bold text-gray-400 hover:text-[#1a1c2e] transition">Business</button>
                    </div>

                    <div class="relative group w-full sm:w-40">
                        <input type="text" placeholder="Search"
                            class="w-full bg-transparent border-b border-gray-200 py-2 text-sm focus:outline-none focus:border-orange-500 transition-all">
                        <svg class="w-4 h-4 absolute right-0 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($popularArticles as $article)
                    <div class="group cursor-pointer p-4 md:p-5 transition-all duration-300 rounded-[2rem] md:rounded-[2.5rem] hover:bg-white hover:shadow-xl hover:shadow-gray-100">
                        <div class="relative aspect-[4/3] rounded-[1.5rem] md:rounded-[2rem] overflow-hidden mb-4 md:mb-6 shadow-sm bg-gray-200 flex items-center justify-center">
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

                        <h3 class="text-lg md:text-xl font-extrabold text-[#1a1c2e] leading-snug mb-2 group-hover:text-orange-600 transition-colors line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <div class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">
                            <span>— {{ $article->category->name ?? 'Technologies' }}</span>
                        </div>

                        <p class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center space-x-3 md:space-x-4 text-[10px] md:text-[11px] font-bold text-gray-400">
                                <span class="flex items-center hover:text-red-500 transition-colors">
                                    <i class="far fa-heart mr-1 text-xs"></i> {{ number_format($article->likes_count) }}
                                </span>
                                <span class="flex items-center hover:text-blue-500 transition-colors">
                                    <i class="far fa-comment mr-1 text-xs"></i> {{ number_format($article->comments_count) }}
                                </span>
                                <span class="hidden sm:flex items-center hover:text-orange-500 transition-colors">
                                    <i class="far fa-bookmark mr-1 text-xs"></i> {{ number_format($article->save_count) }}
                                </span>
                            </div>

                            <a href="{{ route('articles.show', $article->slug) }}"
                                class="w-9 h-9 md:w-10 md:h-10 bg-[#f15a24] text-white rounded-xl flex items-center justify-center transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-100">
                                <svg class="w-4 h-4 md:w-5 md:h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-16">
            <div class="flex justify-between items-end mb-8 md:mb-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#1a1c2e]">Last Article</h2>
                <a href="#" class="text-xs md:text-sm font-bold text-orange-600 flex items-center hover:underline uppercase tracking-wider">
                    See all
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-10">
                @foreach ($articles->take(1) as $article)
                    <div class="lg:col-span-7 group cursor-pointer">
                        <div class="relative aspect-video rounded-[1.5rem] md:rounded-[2rem] overflow-hidden mb-6 md:mb-8 shadow-sm">
                            <a href="{{ route('articles.show', $article->slug) }}" class="block w-full h-full">
                                @if ($article->image)
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 font-bold">No Image</div>
                                @endif
                            </a>
                        </div>
                        {{-- Detail content... --}}
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random" class="w-6 h-6 rounded-full">
                            <span class="text-xs font-bold text-[#1a1c2e]">{{ $article->user->name }}</span>
                            <span class="text-gray-300">—</span>
                            <span class="text-xs font-bold text-gray-400">{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <h3 class="text-2xl md:text-3xl font-extrabold text-[#1a1c2e] leading-tight mb-4 group-hover:text-orange-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                        </a>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ Str::limit(strip_tags($article->content), 150) }}
                        </p>
                    </div>
                @endforeach

                <div class="lg:col-span-5 space-y-6 md:space-y-8">
                    @foreach ($articles->skip(1)->take(3) as $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="flex items-start space-x-4 md:space-x-6 group">
                            <div class="flex-shrink-0 w-24 h-24 md:w-32 md:h-32 rounded-2xl overflow-hidden shadow-sm">
                                @if ($article->image)
                                    <img src="{{ $article->image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-[10px] text-gray-400 font-bold">No Image</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-[10px] font-bold text-[#1a1c2e]">{{ $article->user->name }}</span>
                                    <span class="text-gray-300">—</span>
                                    <span class="text-[10px] font-bold text-gray-400">6h ago</span>
                                </div>
                                <h4 class="text-sm md:text-base font-extrabold text-[#1a1c2e] leading-snug mb-2 group-hover:text-orange-600 transition-colors line-clamp-2">
                                    {{ $article->title }}
                                </h4>
                                <div class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                    {{ $article->category->name ?? 'Technologies' }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mb-16">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 md:mb-12 gap-4">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#1a1c2e] tracking-tight">Weekly Highlights</h2>
                <a href="#"
                    class="text-xs md:text-sm font-bold text-orange-600 flex items-center hover:underline uppercase tracking-wider">
                    See all
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="relative px-4 sm:px-10 -mx-4 sm:-mx-10 overflow-hidden">
                <div class="swiper weeklySwiper !overflow-visible py-10 px-2 sm:px-4">
                    <div class="swiper-wrapper">
                        @foreach ($articles as $article)
                            <div class="swiper-slide h-auto w-[85%] sm:w-[45%] lg:w-[30%]">
                                <div
                                    class="group cursor-pointer p-4 md:p-5 rounded-[2rem] md:rounded-[2.5rem] transition-all duration-300 hover:bg-white hover:shadow-2xl hover:shadow-gray-200/50 bg-transparent border border-transparent h-full flex flex-col">
                                    
                                    <div class="relative aspect-[4/3] rounded-[1.5rem] md:rounded-[2rem] overflow-hidden mb-6 shadow-sm">
                                        @if ($article->image)
                                            <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-400 font-bold text-xs">No Image</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center space-x-2 mb-4">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                            class="w-5 h-5 rounded-full shadow-sm">
                                        <span
                                            class="text-[10px] font-bold text-[#1a1c2e] uppercase tracking-tight truncate">{{ $article->user->name }}</span>
                                    </div>

                                    <h3
                                        class="text-lg md:text-xl font-extrabold text-[#1a1c2e] leading-snug mb-3 group-hover:text-orange-600 transition-colors line-clamp-2">
                                        {{ $article->title }}
                                    </h3>

                                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 mt-auto">
                                        — {{ $article->category->name ?? 'Technologies' }}
                                    </div>

                                    <div class="flex items-center justify-between pt-5 border-t border-gray-50">
                                        <div class="flex items-center space-x-3 md:space-x-4 text-[10px] md:text-[11px] font-bold text-gray-400">
                                            <span class="flex items-center hover:text-red-500 transition-colors cursor-pointer">
                                                <i class="far fa-heart mr-1 text-xs"></i>
                                                {{ number_format($article->likes_count) }}
                                            </span>

                                            <span class="flex items-center hover:text-blue-500 transition-colors cursor-pointer">
                                                <i class="far fa-comment mr-1 text-xs"></i>
                                                {{ number_format($article->comments_count) }}
                                            </span>

                                            <span class="hidden sm:flex items-center hover:text-orange-500 transition-colors cursor-pointer">
                                                <i class="far fa-bookmark mr-1 text-xs"></i>
                                                {{ number_format($article->save_count) }}
                                            </span>
                                        </div>

                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="w-9 h-9 md:w-10 md:h-10 bg-[#f15a24] text-white rounded-xl flex items-center justify-center transform transition-all duration-300 group-hover:translate-x-1 group-hover:-translate-y-1 shadow-lg shadow-orange-200">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 transform rotate-45" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Notification--}}
    @if (session('success'))
        <div id="success-toast" 
            class="fixed bottom-6 left-1/2 -translate-x-1/2 sm:left-auto sm:right-6 sm:translate-x-0 bg-[#1a1c2e] text-white px-6 py-4 rounded-2xl shadow-2xl z-[100] flex items-center space-x-3 transition-all duration-500 translate-y-20 opacity-0">
            <div class="bg-green-500 p-1 rounded-full">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toast = document.getElementById('success-toast');
                setTimeout(() => {
                    toast.classList.remove('translate-y-20', 'opacity-0');
                }, 100);

                setTimeout(() => {
                    toast.classList.add('translate-y-20', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }, 4000);
            });
        </script>
    @endif
@endsection