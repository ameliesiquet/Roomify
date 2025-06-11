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
        <x-button wire:click="logout" type="button">
            {{ __('Logout') }}
        </x-button>
    </li>
</ul>

