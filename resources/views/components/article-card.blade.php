<div
    class="group cursor-pointer p-5 transition-all duration-300 rounded-[2.5rem] hover:bg-white hover:shadow-2xl hover:shadow-gray-100/50">

    <div
        class="relative aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 shadow-sm bg-gray-200 flex items-center justify-center">
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
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

    <div class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">
        <span>— {{ $article->category->name ?? 'Technologies' }}</span>
    </div>

    <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-3">
        {{ Str::limit(strip_tags($article->content), 120) }}
    </p>

    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
        <div class="flex items-center space-x-2">
            <a href="{{ route('articles.edit', $article->id) }}"
                class="px-4 py-2 bg-gray-50 hover:bg-black hover:text-white text-gray-400 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                Edit
            </a>

            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-gray-50 hover:bg-red-50 hover:text-red-600 text-gray-400 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                    Hapus
                </button>
            </form>
        </div>

        <a href="{{ route('articles.show', $article->slug) }}"
            class="w-10 h-10 bg-[#f15a24] text-white rounded-xl flex items-center justify-center transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-100">
            <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </a>
    </div>
</div>