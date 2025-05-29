@props([
    'label',
    'name',
    'type' => 'text',
    'model' => '',
    'placeholder' => '',
    'required' => false,
])

<x-form.label-errors :label="$label" :name="$name" :model="$model" :placeholder="$placeholder" :required="$required">
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        @if($model)
            wire:model.defer="{{ $model }}"
        @endif
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full pt-2.5 rounded-md text-0.2em pb-1.5 lg:pt-4 lg:pb-2 px-4 lg:text-xs  border border-myblack  lg:rounded-lg text-myblack ' . ($errors->has($name) ? ' input-invalid' : ''),
        ]) }}
        @if($required) required @endif
    >

</x-form.label-errors>
