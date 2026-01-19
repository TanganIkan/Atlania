@extends('layout.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-16 font-['Plus_Jakarta_Sans']">
        <div class="max-w-3xl mb-12">
            <span class="text-[#f15a24] font-bold uppercase tracking-widest text-xs">
                — {{ $article->category->name }}
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-[#1a1c2e] mt-4 leading-[1.1]">
                {{ $article->title }}
            </h1>
        </div>

        <div class="flex flex-col lg:flex-row gap-16">
            <div class="lg:w-2/3">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl mb-12 aspect-video bg-gray-100">
                    @if ($article->image)
                        <img src="{{ $article->image }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                </div>

                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed font-medium">
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed font-medium">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="sticky top-24 space-y-8">

                    <div class="p-6 bg-gray-50 rounded-[2.5rem] border border-gray-100">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Published By</p>
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-12 h-12 bg-[#f15a24] rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-orange-200">
                                <div
                                    class="w-12 h-12 bg-[#f15a24] rounded-xl flex items-center justify-center text-white font-black shadow-lg shadow-orange-200">
                                    {{ Str::upper(substr($article->user->name, 0, 2)) }}
                                </div>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-[#1a1c2e] leading-none">{{ $article->user->name }}</h4>
                                <p class="text-[10px] text-gray-400 font-bold mt-1">
                                    {{ $article->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-2">
                            <div class="flex space-x-4 text-gray-400 text-xs font-bold">
                                <span class="flex items-center"><i class="far fa-heart mr-1.5 text-red-400"></i>
                                    {{ $article->likes_count }}</span>
                                <span class="flex items-center"><i class="far fa-comment mr-1.5 text-blue-400"></i>
                                    {{ $article->comments_count }}</span>
                                <span class="flex items-center"><i class="far fa-bookmark mr-1.5 text-gray-400"></i>
                                    {{ $article->save_count }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <button
                                    class="w-10 h-10 bg-white shadow-xl rounded-xl flex items-center justify-center text-[#f15a24]">
                                    <i class="far fa-bookmark"></i>
                                </button>

                                <a href="{{ route('articles.download.pdf', $article->id) }}" title="Download PDF"
                                    class="w-10 h-10 bg-white shadow-xl rounded-xl flex items-center justify-center text-red-500 hover:bg-red-50 transition">
                                    <i class="far fa-file-pdf"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-extrabold text-[#1a1c2e] px-2">More From {{ $article->user->name }}</h3>

                        <div class="flex flex-col gap-2">
                            @foreach ($relatedArticles as $related)
                                <a href="{{ route('articles.show', $related->slug) }}"
                                    class="group flex items-center gap-4 p-2 hover:bg-gray-50 rounded-2xl transition-all">
                                    <div class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                                        @if ($related->image)
                                            <img src="{{$related->image}}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @endif
                                    </div>
                                    <div>
                                        <span
                                            class="text-[9px] font-bold text-[#f15a24] uppercase tracking-wider">{{ $related->category->name }}</span>
                                        <h4
                                            class="text-sm font-bold text-[#1a1c2e] leading-snug line-clamp-2 group-hover:text-[#f15a24] transition-colors">
                                            {{ $related->title }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
    </main>
@endsection