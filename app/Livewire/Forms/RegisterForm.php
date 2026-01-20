<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class RegisterForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $firstname = '';

    #[Validate('required|string|max:255')]
    public string $lastname = '';

    #[Validate('required|string|max:255')]
    public string $username = '';

    #[Validate('required|string|lowercase|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate]
    public string $password = '';

    #[Validate]
    public $profile_photo;

    public function rules(): array
    {
        return [
            'password' => ['required', 'string', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(): void
    {
        $validated = $this->validate();

        if (User::where('email', $validated['email'])->exists()) {
            throw ValidationException::withMessages([
                'form.email' => trans('auth.email_taken'),
            ]);
        }

        if ($this->profile_photo) {
            $path = $this->profile_photo->store('profile-photos', 'public');
            $validated['profile_photo_path'] = $path;
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user, true);

        session()->put('first_registration', true);
        session()->save();
    }
}
