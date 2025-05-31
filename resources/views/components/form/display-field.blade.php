@props([
    'label' => '',
    'value' => '',
    'editable' => false,
    'editing' => null,
    'model' => null,
])
@php
    $isEditing = $editing === \Illuminate\Support\Str::slug($label);
@endphp
<div class="w-full border-b border-gray-300 flex flex-col gap-1 pb-1">
    <label class="text-s text-gray-600" for="{{ $model }}">{{ $label }}</label>
    <div class="flex items-center justify-between">
        @if ($isEditing)
            <div class="flex flex-col gap-2 w-full">
                <input
                    id="{{ $model }}"
                    type="text"
                    wire:model.defer="{{ $model }}"
                    class="text-xs text-gray-800 font-medium w-full p-2 bg-white border rounded"
                />
                <x-form.save-cancel-buttons :editing="$editing"/>
            </div>
        @else
            <p class="text-xs text-gray-800 font-medium">{{ $value }}</p>
        @endif
        @if ($editable && ! $isEditing)
            <button wire:click="$set('editing', '{{ \Illuminate\Support\Str::slug($label) }}')"
                class="text-xs text-turquoise hover:underline cursor-pointer ml-2">
                edit
            </button>
        @endif
    </div>
</div>
