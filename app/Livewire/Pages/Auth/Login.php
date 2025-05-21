<?php
namespace App\Livewire\Pages\Auth;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Auth;
#[Layout('layouts.guest')]
class Login extends Component
{
    public LoginForm $form;


    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();

        Session::regenerate();
        logger()->info('User logged in?', ['user' => auth()->user()]);

        $this->redirect(route('dashboard'));
    }


}
