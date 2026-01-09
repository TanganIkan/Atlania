<h1>Dashboard</h1>

{{-- <p>Halo, {{ auth()->user()->name }}</p> --}}

<hr>

<h2>Artikel Saya</h2>

@foreach ($articles as $article)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
        <h3>{{ $article->title }}</h3>
        <p>{{ Str::limit($article->content, 100) }}</p>
    </div>
    <a href="/articles/create">+ Tambah Artikel</a>

    @foreach ($articles as $article)
        <h3>{{ $article->title }}</h3>
        <p>{{ $article->category->name }}</p>

        <a href="/articles/{{ $article->id }}/edit">Edit</a>

        <form action="/articles/{{ $article->id }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    @endforeach

@endforeach