<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\RegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.guest')]
#[Title('Register')]
class Register extends Component
{
    use WithFileUploads;
    public RegisterForm $form;

    public function register(): void
    {
        $this->validate();

        $this->form->register();
        $this->redirect(route('dashboard'));

    }
}
