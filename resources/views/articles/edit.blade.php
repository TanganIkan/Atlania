<h1>Edit Artikel</h1>

<form method="POST" action="/articles/{{ $article->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $article->title }}" required><br><br>

    <select name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select><br><br>

    <textarea name="content" required>{{ $article->content }}</textarea><br><br>

    <button type="submit">Update</button>
</form>