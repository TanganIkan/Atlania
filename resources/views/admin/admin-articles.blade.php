@extends('layout.admin')

@section('content')

    {{-- Header Section --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-extrabold text-[#1a1c2e] tracking-tight uppercase italic">Manajemen Semua Artikel</h2>
            <p class="text-xs md:text-sm text-gray-400 mt-1 uppercase tracking-widest font-bold">Pantau dan kelola seluruh konten website</p>
        </div>
        <a href="{{ route('articles.create') }}"
            class="w-full md:w-auto px-8 py-4 bg-[#f15a24] text-white rounded-2xl font-black text-xs shadow-xl shadow-orange-100 hover:scale-105 transition-all flex items-center justify-center gap-3 uppercase tracking-widest">
            <i class="fas fa-plus"></i> Buat Artikel Baru
        </a>
    </div>
    
    {{-- Articles Table --}}
    <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] p-4 md:p-8 shadow-sm border border-gray-50 overflow-hidden">
        <div class="overflow-x-auto no-scrollbar">
            {{-- Min-width ditambahkan agar tabel tidak "penyet" saat layar sangat sempit --}}
            <table class="w-full text-left border-separate border-spacing-y-3 min-w-[700px] md:min-w-full">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300">
                        <th class="px-6 pb-2">Info Artikel</th>
                        <th class="px-6 pb-2">Penulis</th>
                        <th class="px-6 pb-2">Kategori</th>
                        <th class="px-6 pb-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr class="group">
                            {{-- Image & Title Info --}}
                            <td class="px-6 py-4 bg-gray-50/50 rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-gray-100 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl md:rounded-2xl overflow-hidden bg-gray-200 flex-shrink-0 shadow-sm">
                                        @if($article->image)
                                            <img src="{{ $article->image }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[8px] font-bold text-gray-400">NO IMG</div>
                                        @endif
                                    </div>
                                    <div class="max-w-[200px] md:max-w-xs">
                                        <h4 class="font-bold text-[#1a1c2e] line-clamp-1 group-hover:text-[#f15a24] transition-colors text-sm">
                                            {{ $article->title }}
                                        </h4>
                                        <span class="text-[9px] md:text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                            {{ $article->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            {{-- Author --}}
                            <td class="px-6 py-4 bg-gray-50/50 border-y border-transparent group-hover:border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                        class="w-6 h-6 rounded-lg shadow-sm">
                                    <span class="text-[11px] font-bold text-gray-600 whitespace-nowrap">{{ $article->user->name }}</span>
                                </div>
                            </td>

                            {{-- Category Tag --}}
                            <td class="px-6 py-4 bg-gray-50/50 border-y border-transparent group-hover:border-gray-100">
                                <span class="inline-flex items-center justify-center whitespace-nowrap text-[9px] font-black uppercase tracking-widest text-gray-400 bg-white px-3 py-1.5 rounded-lg border border-gray-100 shadow-sm italic">
                                    {{ $article->category->name ?? 'Tech' }}
                                </span>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="px-6 py-4 bg-gray-50/50 rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-gray-100 text-right">
                                <div class="flex items-center justify-end gap-2 md:gap-3">
                                    <a href="{{ route('articles.edit', $article->id) }}"
                                        class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-orange-600 hover:border-orange-100 transition-all shadow-sm">
                                        <i class="fas fa-edit text-[10px]"></i>
                                    </a>

                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Admin yakin ingin menghapus artikel ini?')">
                                        @csrf @method('DELETE')
                                        <button class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-red-600 hover:border-red-100 transition-all shadow-sm">
                                            <i class="fas fa-trash text-[10px]"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                                        class="w-9 h-9 flex items-center justify-center bg-[#1a1c2e] rounded-xl text-white hover:bg-[#f15a24] transition-all shadow-lg shadow-gray-200">
                                        <i class="fas fa-eye text-[10px]"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-20">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-newspaper text-xl text-gray-200"></i>
                                    </div>
                                    <p class="text-gray-400 font-bold uppercase text-[9px] tracking-[0.2em]">Data Kosong</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-8 px-2 md:px-6">
            {{ $articles->links() }}
        </div>
    </div>
@endsection