<div
    class="group cursor-pointer p-5 transition-all duration-300 rounded-[2.5rem] hover:bg-white hover:shadow-2xl hover:shadow-gray-100/50">

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

    <div class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">
        <span>— {{ $article->category->name ?? 'Technologies' }}</span>
    </div>

    <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-3">
        {{ Str::limit(strip_tags($article->content), 120) }}
    </p>

    <div class="flex items-center justify-between pt-5 border-t border-gray-100 mt-auto">
        <div class="flex items-center gap-2">

            <a href="{{ route('articles.edit', $article->id) }}"
                class="group/edit flex items-center px-4 py-2.5 bg-[#1a1c2e] text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-black hover:shadow-lg active:scale-95">
                <i class="far fa-edit mr-2 text-[12px] transition-transform group-hover/edit:scale-110"></i>
                Edit
            </a>

            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus artikel ini? Data tidak bisa dikembalikan.')"
                class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="group/del flex items-center px-4 py-2.5 bg-red-50 text-red-600 border border-red-100 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-red-600 hover:text-white hover:shadow-lg active:scale-95">
                    <i class="far fa-trash-alt mr-2 text-[12px] transition-transform group-hover/del:scale-110"></i>
                    Delete
                </button>
            </form>
        </div>

        <a href="{{ route('articles.show', $article->slug) }}"
            class="w-11 h-11 bg-[#f15a24] text-white rounded-2xl flex items-center justify-center transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-100 active:scale-90"
            title="View Article">
            <svg class="w-5 h-5 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </a>
    </div>
</div>