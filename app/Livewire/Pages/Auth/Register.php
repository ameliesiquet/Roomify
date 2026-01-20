<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\RegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Register')]
class Register extends Component
{
    use WithFileUploads;
    public RegisterForm $form;

    public function register()
    {
        $this->validate();
        $this->form->register();

        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.pages.auth.register')
            ->layout('layouts.guest', [
                'title' => 'Register',
                'header' => 'Create an account',
            ]);
    }

}
