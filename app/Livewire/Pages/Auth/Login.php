<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Login')]
class Login extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        logger()->info('Login-Methode aufgerufen', [
            'username' => $this->form->username,
            'password_present' => !empty($this->form->password),
        ]);

        $this->form->validate();

        try {
            $this->form->authenticate();
            logger()->info('Authentifizierung erfolgreich', ['username' => $this->form->username]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            logger()->warning('Authentifizierung fehlgeschlagen', [
                'username' => $this->form->username,
                'errors' => $e->errors(),
            ]);

            throw $e;
        }

        \Session::regenerate();

        // ⛔ vorher:
         $this->redirect(route('dashboard'));

        // ✅ stattdessen:
       // $this->dispatch('redirectToDashboard');


    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
