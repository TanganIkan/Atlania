<div>
    <h1>halaman atmin</h1>
    <p>Halo, {{ auth()->user()->name }}</p>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>