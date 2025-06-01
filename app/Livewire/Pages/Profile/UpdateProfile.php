<?php

namespace App\Livewire\Pages\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public string $firstname = '';
    public string $lastname = '';
    public string $username = '';
    public string $email = '';
    public string $profile_photo_path = '';
    public $profile_photo;

    public string $editing = '';

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];

    protected $messages = [
        'profile_photo.mimes' => 'Nur JPG, PNG oder WEBP werden unterstützt.',
        'profile_photo.max' => 'Das Bild darf maximal 2MB groß sein.',
    ];

    public function mount(): void
    {
        $user = Auth::user()->fresh();
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->profile_photo_path = $user->profile_photo_path ?? '';
    }

    public function updatedProfilePhoto()
    {
        try {
            $this->validateOnly('profile_photo');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return;
        }
        $this->resetErrorBag('profile_photo');
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function updatePassword()
    {
        $validated = $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        $this->editing = '';

        $this->dispatch('password-updated');
    }

    public function cancelEdit()
    {
        if ($this->editing === 'profile_photo') {
            $this->reset('profile_photo');
        }

        $this->editing = '';
    }

    public function save()
    {
        $this->editing = '';
        $this->dispatch('updated');
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirect(route('dashboard'));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.pages.profile.update-profile-information-form');
    }
}
