@component('mail::message')
    # Hey there!👋🏻

    Thanks for joining **Roomify** ✨
    To start, please confirm your email by clicking the button below. 👇

    @component('mail::button', ['url' => $url])
        ✅ Verify My Email
    @endcomponent

    If you didn’t sign up, no worries — just ignore this message. 🙈

    Stay cozy,
    The {{ config('app.name') }} Team🤎
@endcomponent
