<div>
    @if (Auth::check())
        <x-main-title>Welcome, {{ Auth::user()->firstname }}!</x-main-title>
    @else
        <p>Not logged in.</p>
    @endif

    <section>

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
