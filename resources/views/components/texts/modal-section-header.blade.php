@props([
    'title',
    'editable' => true,
])

<div class="flex items-center justify-between mb-4 border-b border-light-sand shadow-2xs">
    <h3 class="text-sm uppercase text-[#5a7d7c]">
        {{ $title }}
    </h3>

    @if($editable)
        <button
            type="button"
            {{ $attributes->merge([
                'class' => 'flex items-center gap-1 text-sm text-gray-600 hover:text-black cursor-pointer'
            ]) }}
        >
            Edit
            <x-svg.edit-pencil />
        </button>
    @endif
</div>
