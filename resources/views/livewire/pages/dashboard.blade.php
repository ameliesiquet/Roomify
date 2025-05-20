<div>
    <h1>Dashboard</h1>
    @auth
        <p class="text-green-500">✅ Eingeloggt als {{ auth()->user()->username }}</p>
    @else
        <p class="text-red-500">❌ Nicht eingeloggt</p>
    @endauth

</div>
