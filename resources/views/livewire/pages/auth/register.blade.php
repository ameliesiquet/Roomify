
        <form wire:submit="register"
              class="pb-2 px-4  bg-mybeige py-6 lg:px-8 rounded-xl shadow-lg flex flex-col gap-4 text-xs">
            @csrf
            <!-- Profile photo -->
            <div class="flex items-center gap-3">
                <div class="relative w-20 h-20 mx-auto rounded-full ">
                    @if ($form->profile_photo)
                        <img src="{{ $form->profile_photo->temporaryUrl() }}"
                             class="w-full h-full object-cover rounded-full "/>
                    @else
                        <x-svg.camera-register class="w-full h-full text-gray-400"/>
                    @endif
                    <label for="profile_photo"
                           class="absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 cursor-pointer bg-mywhite rounded-full p-1 shadow-md hover:bg-gray-100 z-50">
                        <x-svg.edit-pencil class="w-6 h-6 text-turquoise"/>
                    </label>
                </div>
                <input type="file" id="profile_photo" wire:model="form.profile_photo" class="hidden" accept="image/*">
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
    </section>

    <!-- TODO : make camera icon functionnal -->

