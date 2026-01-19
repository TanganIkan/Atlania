@extends('layout.app')

@section('content')
    <div class="min-h-screen">
        <main class="max-w-7xl mx-auto px-6 py-16">

            <div class="mb-16 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 px-4">
                <div>
                    <h1 class="text-5xl font-black text-[#1a1c2e] tracking-tighter uppercase">My Articles</h1>
                    <p class="text-gray-400 mt-3 font-bold uppercase text-[10px] tracking-[0.3em] flex items-center">
                        <span class="w-8 h-[2px] bg-[#f15a24] mr-3"></span>
                        Total {{ $articles->total() }} Postingan
                    </p>
                </div>
                <a href="{{ route('articles.create') }}" class="bg-[#f15a24] text-white px-8 py-4 rounded-2xl font-black
                                            text-xs shadow-2xl shadow-orange-200 hover:scale-105 active:scale-95 transition-all uppercase
                                            tracking-widest"><i class="fas fa-plus mr-2"></i>Buat Postingan Baru
                </a>
            </div>

            @if($articles->isEmpty())
                <div class="py-32 text-center bg-white rounded-[3rem] shadow-sm">
                    <i class="fas fa-feather-alt text-5xl text-gray-200 mb-6"></i>
                    <p class="text-gray-400 font-bold uppercase text-xs tracking-widest">Belum ada karya yang ditulis.</p>
                </div>
            @else

                <div class="rounded-[4rem]">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                        @foreach($articles as $article)
                            @include('components.article-card', ['article' => $article])
                        @endforeach
                    </div>
                    <div class="mt-20 flex justify-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            @endif
        </main>
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