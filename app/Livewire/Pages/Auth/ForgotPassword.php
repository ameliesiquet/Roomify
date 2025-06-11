<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.guest')]
class ForgotPassword extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';


    public function sendPasswordResetLink(): void
    {
        $this->validate();
        $user = \App\Models\User::where('email', $this->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'No user found with this email.',
            ]);
        }
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        Session::flash('status', __($status));
    }
}
