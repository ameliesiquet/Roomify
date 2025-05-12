@props([
    'label',
    'name',
    'model' => '',
    'placeholder' => '',
    'required' => false,
])

<div {{ $attributes->merge(['class' => 'm-0 p-0']) }}>
    <label for="{{ $name }}" class="relative mb-1.5  block text-xs text-myblack ">
        {{ ucfirst($label) }}
        @if($required)
            <span aria-hidden="true" class="absolute -top-0.1 ml-1 text-turquoise text-2xl leading-none">*</span>
        @endif
    </label>

    {{ $slot }}

    @error($model)
    <ul class="my-2 flex flex-col gap-2 font-medium text-red-500 ">
        @foreach ($errors->get($model) as $error)
            <li class="pl-2 pr-1 text-sm text-red-500 ">
                {{ $error }}
            </li>
        @endforeach
    </ul>
    @enderror
</div>

