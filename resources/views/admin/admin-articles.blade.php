@extends('layout.admin')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-[#1a1c2e] tracking-tight">Manajemen Semua Artikel</h2>
            <p class="text-sm text-gray-400 mt-1">Pantau dan kelola seluruh konten dari semua penulis di website</p>
        </div>
        <a href="{{ route('articles.create') }}"
            class="px-6 py-3 bg-[#f15a24] text-white rounded-2xl font-bold text-sm shadow-lg shadow-orange-100 hover:scale-105 transition-all flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i> Buat Artikel Baru
        </a>
    </div>

    {{-- TABEL CRUD --}}
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-50">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                        <th class="px-6 pb-4">Info Artikel</th>
                        <th class="px-6 pb-4">Penulis</th>
                        <th class="px-6 pb-4">Kategori</th>
                        <th class="px-6 pb-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr class="group">
                            {{-- Judul & Preview --}}
                            <td
                                class="px-6 py-4 bg-gray-50/30 rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-gray-100 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-200 flex-shrink-0 shadow-sm">
                                        @if($article->image)
                                            <img src="{{ $article->image }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-[8px] font-bold text-gray-400">
                                                NO IMG</div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4
                                            class="font-bold text-[#1a1c2e] line-clamp-1 group-hover:text-[#f15a24] transition-colors">
                                            {{ $article->title }}
                                        </h4>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                            {{ $article->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Penulis (Logika Baru: Tampil Semua Artikel) --}}
                            <td class="px-6 py-4 bg-gray-50/30 border-y border-transparent group-hover:border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random"
                                        class="w-6 h-6 rounded-full shadow-sm">
                                    <span class="text-xs font-bold text-gray-600">{{ $article->user->name }}</span>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="px-6 py-4 bg-gray-50/30 border-y border-transparent group-hover:border-gray-100">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-white px-3 py-1.5 rounded-xl border border-gray-100">
                                    — {{ $article->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            {{-- Tombol Aksi --}}
                            <td
                                class="px-6 py-4 bg-gray-50/30 rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-gray-100 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('articles.edit', $article->id) }}"
                                        class="w-10 h-10 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-orange-600 hover:border-orange-100 transition-all shadow-sm">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Admin yakin ingin menghapus artikel ini?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="w-10 h-10 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-red-600 hover:border-red-100 transition-all shadow-sm">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>

                                    {{-- View --}}
                                    <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                                        class="w-10 h-10 flex items-center justify-center bg-[#1a1c2e] rounded-xl text-white hover:bg-[#f15a24] transition-all shadow-lg shadow-gray-200">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-24">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-newspaper text-2xl text-gray-200"></i>
                                    </div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Belum ada artikel
                                        di database</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-10 px-6">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection