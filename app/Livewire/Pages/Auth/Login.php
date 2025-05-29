<?php
namespace App\Livewire\Pages\Auth;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Auth;
class Login extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(route('dashboard'));
    }
    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.guest', [
                'title' => 'Login',
                'header' => 'Login to your account',
            ]);
    }
}
