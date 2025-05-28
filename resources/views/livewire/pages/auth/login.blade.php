<div class="m-auto flex flex-col gap-4">

    <h1 class="uppercase text-center text-turquoise text-lg">Login</h1>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form wire:submit.prevent="login" class="bg-[#E9E8E6] py-6 px-8 rounded-xl shadow-lg flex flex-col gap-4">
        @csrf
        <x-form.field-label-input
            label="Email"
            name="form.email"
            type="email"
            model="form.email"
            placeholder="your-email@gmail.com"
            autocomplete="email"
            autofocus
            required
            class="lowercase"
        />


        <!-- Password -->
        <div class="flex flex-col gap-3">
            <x-form.input-password
                label="Password"
                name="form.password"
                :model="'form.password'"
                autocomplete="current-password"
                required
            />
            <x-form.checkbox/>
        </div>

        <div class="flex flex-col gap-2 items-center justify-end mt-4">
            <x-button class="ms-3">
                {{ __('Log in') }}
            </x-button>
                <a class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md"
                   href="{{ route('register') }}">
                    {{ __('I don‘t have an account yet') }}
                </a>
        </div>
    </form>
</div>
