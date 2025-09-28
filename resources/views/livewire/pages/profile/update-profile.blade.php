
<section class="p-8 bg-light-white shadow rounded-xl max-w-xl">
    <form wire:submit="updateProfileInformation" class=" space-y-6">
        <div class="flex gap-4 lg:gap-8 items-center">
            <div class="flex items-center gap-3">
                <div class="relative w-20 h-20 mx-auto rounded-full ">
                    @if ($profile_photo)
                        <img src="{{ $profile_photo->temporaryUrl() }}"
                             class="w-full h-full object-cover rounded-full "/>
                    @elseif (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                             class="w-full h-full object-cover rounded-full "/>
                    @else
                        <x-svg.camera-register class="w-full h-full text-gray-400"/>
                    @endif
                    <label for="profile_photo"
                           wire:click="$set('editing', 'profile_photo')"
                           class="absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 cursor-pointer bg-mywhite rounded-full p-1 shadow-md hover:bg-gray-100 z-50">
                        <x-svg.edit-pencil class="w-6 h-6 text-turquoise"/>
                    </label>
                </div>
                <input
                    type="file"
                    id="profile_photo"
                    wire:model="profile_photo"
                    class="hidden"
                    accept="image/png,image/jpeg,image/webp"
                >
            </div>
            <div class="flex flex-col gap-1">
                <p class="text-s ">{{Auth::user()->firstname }} {{Auth::user()->lastname }}</p>
                <p class="text-xs">{{Auth::user()->username}}</p>
            </div>
        </div>
        <x-form.save-cancel-buttons :editing="$editing === 'profile_photo'" />
        @error('profile_photo')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror

        <!-- Firstname -->
        <x-form.display-field
            label="Firstname"
            value="{{ $firstname }}"
            model="firstname"
            :editable="true"
            :editing="$editing"
        />
        <!-- Lastname -->
        <x-form.display-field
            label="Lastname"
            value="{{ $lastname }}"
            model="lastname"
            :editable="true"
            :editing="$editing"
        />
        <!-- Username -->
        <x-form.display-field
            label="Username"
            value="{{ $username }}"
            model="username"
            :editable="true"
            :editing="$editing"
        />
        <!-- Email -->
        <x-form.display-field
            label="Email"
            value="{{ $email }}"
            model="email"
            :editable="true"
            :editing="$editing"
        />
        @php
            $user = auth()->user();
        @endphp
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 text-xs text-gray-800">
                <p> {{ __('Your email address is unverified.') }}</p>
                <button
                    wire:click.prevent="sendVerification"
                    class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md cursor-pointer focus:font-bold">
                    {{ __('Click here to send the verification email.') }}
                </button>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-xs text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
        <x-form.display-password-field :editing="$editing"/>
    </form>
</section>
