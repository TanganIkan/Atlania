<h1>Dashboard Admin</h1>

{{-- ====== BAGIAN USER LOGIN ====== --}}
@auth
    <p>Halo, <strong>{{ auth()->user()->name }}</strong></p>

    <a href="/articles/create">+ Tambah Artikel</a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth

{{-- ====== BAGIAN GUEST ====== --}}
@guest
    <p>Silakan login untuk menulis artikel.</p>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
@endguest

<hr>

{{-- ====== LIST ARTIKEL (BISA DILIHAT SEMUA USER) ====== --}}
<h2>Daftar Artikel</h2>

@forelse ($articles as $article)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
        <h3>{{ $article->title }}</h3>
        <p>{{ Str::limit($article->content, 120) }}</p>

        {{-- ====== TOMBOL EDIT & HAPUS (HANYA PEMILIK ARTIKEL) ====== --}}
        @auth
            @if ($article->user_id === auth()->id())
                <a href="/articles/{{ $article->id }}/edit">Edit</a>

                <form action="/articles/{{ $article->id }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            @endif
        @endauth
    </div>
@empty
    <p>Belum ada artikel.</p>
@endforelse