@props(['onclick' => ''])

<button type="button"
        {{ $attributes->merge(['class' => 'w-6 h-6 bg-white rounded-full shadow flex items-center justify-center hover:bg-gray-100 transition cursor-pointer']) }}
        @click.stop="{{ $onclick }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 text-gray-800">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
</button>
