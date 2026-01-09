<h1>Buat Artikel</h1>

<form method="POST" action="/articles">
    @csrf

    <input type="text" name="title" placeholder="Judul" required><br><br>

    <select name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select><br><br>

    <textarea name="content" placeholder="Isi artikel" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>