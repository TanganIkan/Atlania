@extends('layout.app') {{-- Pastikan kamu punya layout utama --}}

@section('content')
<div class="bg-white min-h-screen font-sans text-gray-900">
    
    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @php
            $featured = $articles->where('is_featured', true)->first() ?? $articles->first();
        @endphp

        @if($featured)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-6xl font-black mb-4">Tech<span class="text-purple-600">.</span></h1>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                    <span class="font-bold text-black">{{ $featured->user->name }}</span>
                    <span>•</span>
                    <span>{{ $featured->created_at->diffForHumans() }}</span>
                </div>
                <h2 class="text-4xl font-extrabold leading-tight mb-6">
                    {{ $featured->title }}
                </h2>
                <p class="text-gray-600 mb-8 line-clamp-3">
                    {{ Str::limit(strip_tags($featured->content), 180) }}
                </p>
                <a href="#" class="inline-flex items-center justify-center w-12 h-12 bg-orange-500 text-white rounded-bl-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <div class="relative">
                <img src="{{ $featured->image ? asset('storage/'.$featured->image) : 'https://via.placeholder.com/800x500' }}" 
                     class="w-full h-[450px] object-cover rounded-3xl shadow-2xl" alt="Featured Image">
                <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white px-6 py-2 rounded-full shadow-md flex gap-4 text-sm font-bold">
                    <span class="text-gray-300">2</span> <span class="text-gray-800">/ 6</span>
                </div>
            </div>
        </div>
        @endif
    </header>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-black">Latest Articles</h2>
            </div>
            <div class="hidden md:flex gap-4">
                <button class="px-5 py-2 rounded-full border border-gray-200 text-sm font-bold hover:bg-black hover:text-white transition">Technologies</button>
                <button class="px-5 py-2 rounded-full border border-gray-200 text-sm font-bold hover:bg-black hover:text-white transition">Digital Marketing</button>
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-4 pr-10 py-2 border border-gray-200 rounded-full text-sm">
                    <svg class="w-4 h-4 absolute right-4 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($articles->skip(1) as $article) {{-- Skip 1 karena sudah tampil di Hero --}}
            <article class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl mb-4">
                    <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://via.placeholder.com/400x300' }}" 
                         class="w-full h-64 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">
                    <img src="https://ui-avatars.com/api/?name={{ $article->user->name }}" class="w-6 h-6 rounded-full">
                    <span>{{ $article->user->name }}</span>
                    <span>•</span>
                    <span class="text-orange-500">{{ $article->category->name }}</span>
                </div>
                <h3 class="text-xl font-extrabold group-hover:text-orange-500 transition mb-3">
                    {{ $article->title }}
                </h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                    {{ Str::limit(strip_tags($article->content), 100) }}
                </p>
                <div class="flex items-center justify-between text-gray-400 text-xs">
                    <div class="flex gap-4">
                        <span>👁️ 2,124</span>
                        <span>💬 735</span>
                    </div>
                    <div class="bg-orange-500 p-2 text-white rounded-bl-xl opacity-0 group-hover:opacity-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section>
</div>
@endsection