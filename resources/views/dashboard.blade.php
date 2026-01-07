<div>
    <h2>Dashboard</h2>

    <p>Halo, {{ auth()->user()->name }}</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>

</div>