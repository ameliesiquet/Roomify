<div class="m-auto flex flex-col gap-4">
    <h1 class="uppercase text-center text-turquoise">Register</h1>
    <form wire:submit="register"
          class="pb-2 mx-auto px-4  bg-light-sand lg:py-6 lg:px-8 rounded-xl shadow-lg flex flex-col gap-4 text-xs w-[80%]">
        @csrf
        <div class="flex justify-center">
            <x-svg.camera-register/>
            <a href="">
                <x-svg.edit-pencil/>
            </a>
        </div>
        <!-- Name -->
        <div class="flex justify-between gap-4">
            <!-- Firstname -->
            <x-form.field-label-input
                    label="Firstname"
                    name="form.firstname"
                    model="form.firstname"
                    placeholder="Your firstname"
                    autocomplete="firstname"
                    autofocus
                    required
                    class="capitalize"
            />
            <!-- Lastname -->
            <x-form.field-label-input
                    label="Lastname"
                    name="form.lastname"
                    model="form.lastname"
                    placeholder="Your lastname"
                    autocomplete="lastname"
                    autofocus
                    required
                    class="capitalize"
            />
        </div>
        <!-- Email -->
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
        <!-- Username -->
        <x-form.field-label-input
                label="Username"
                name="form.username"
                model="form.username"
                placeholder="your_username"
                autocomplete="username"
                required
                class="lowercase"
        />
        <!-- Password -->
        <x-form.input-password
                label="Password"
                name="form.password"
                :model="'form.password'"
                autocomplete="current-password"
                required
        />
        <div class="flex flex-col gap-4 items-center justify-end mt-4">
            <x-button>Create my account</x-button>
            @if (Route::has('login'))
                <a class="underline text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('login') }}" wire:navigate>
                    {{ __('I already have an account') }}
                </a>
            @endif
        </div>
    </form>
</div>
<!-- TODO : make camera icon functionnal -->
