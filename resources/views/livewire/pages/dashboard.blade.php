<div>
    @if (Auth::check())
        <x-main-title>Welcome, {{ Auth::user()->firstname }}!</x-main-title>
    @else
        <p>Not logged in.</p>
    @endif

    <section>
        @if(auth()->user()->rooms->isEmpty())
            <x-info-box>
                Du hast noch keine Räume. <x-link href="/rooms/create">Jetzt erstellen</x-link>
            </x-info-box>
        @else
            <x-rooms-list :rooms="auth()->user()->rooms" />
        @endif
        <h2>Roomify</h2>
        <p>Hello 👋🏻You paused while adding items to your Bathroom 😮🛁</p>
    </section>

    <section>
        <h3 class="text-turquoise uppercase">Inspiration</h3>
        <div>
            <img src="" alt="">
        </div>
    </section>
</div>
