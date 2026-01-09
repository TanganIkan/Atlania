<h1>Dashboard User</h1>

@auth
    <a href="/articles/create">+ Tambah Artikel</a>
@endauth

<hr>

@foreach ($articles as $article)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
        <h3>{{ $article->title }}</h3>
        <p>{{ Str::limit($article->content, 120) }}</p>
        

        @auth
            @if ($article->user_id === auth()->id())
                <a href="/articles/{{ $article->id }}/edit">Edit</a>
                <form action="/articles/{{ $article->id }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button>Hapus</button>
                </form>
            @endif
        @endauth
    </div>
@endforeach