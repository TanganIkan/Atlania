<div class="group">
    <div
        class="relative aspect-[4/3] rounded-[2rem] overflow-hidden mb-4 shadow-sm bg-gray-100 flex items-center justify-center">
        @if($article->image)
            <img src="{{ $article->image }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @else
            <span class="text-gray-400 font-bold text-[10px]">No Image</span>
        @endif
    </div>

    <span class="text-[#f15a24] font-bold uppercase tracking-widest text-[10px]">
        — {{ $article->category->name }}
    </span>

    <a href="{{ route('articles.show', $article->slug) }}" class="block mt-2">
        <h3 class="text-lg font-extrabold text-[#1a1c2e] leading-tight hover:text-[#f15a24] transition-colors">
            {{ $article->title }}
        </h3>
    </a>

    <div class="flex items-center space-x-4 mt-3 text-[10px] font-bold text-gray-400">
        <span><i class="far fa-heart mr-1"></i> {{ number_format($article->likes_count) }}</span>
        <span><i class="far fa-comment mr-1"></i> {{ number_format($article->comments_count) }}</span>
    </div>
</div>