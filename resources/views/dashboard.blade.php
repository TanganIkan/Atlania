<h1>Dashboard</h1>

{{-- <p>Halo, {{ auth()->user()->name }}</p> --}}

<hr>

<h2>Artikel Saya</h2>

@foreach ($articles as $article)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
        <h3>{{ $article->title }}</h3>
        <p>{{ Str::limit($article->content, 100) }}</p>
    </div>
@endforeach