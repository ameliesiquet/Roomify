@props([
    'expanded' => true,
])
<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<ul class="font-medium flex flex-col items-center gap-8 text-center w-full lg:items-start" role="list">
    <x-sidebar.link href="{{ route('profile') }}" icon="profile" label="Profile" :expanded="$expanded"/>
    <li class="">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-button>Logout</x-button>
        </form>
    </li>
</ul>

