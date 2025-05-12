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
        wire:model.blur="{{ $model }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full pt-4 pb-2 px-4 placeholder:text-0.3em text-xs  border border-myblack  rounded-lg text-myblack ' . ($errors->has($name) ? ' input-invalid' : ''),
        ]) }}
    >
</x-form.label-errors>
