@props([
    'label',
    'name',
    'placeholder' => '',
    'required' => false,
])

<div {{ $attributes->merge(['class' => 'm-0 p-0']) }}>
    <label for="{{ $name }}" class="relative mb-1.5 block text-xs text-myblack ">
        {{ ucfirst($label) }}
        @if($required)
            <span aria-hidden="true" class="absolute -top-0.1 ml-1 text-turquoise text-2xl leading-none">*</span>
        @endif
    </label>

    {{ $slot }}

    @error($name)
    <ul class="my-2 flex flex-col gap-2 font-xs text-red-500">
        @foreach ($errors->get($name) as $error)
            <li class="pl-2 pr-1 text-xs text-red-500">
                {{ $error }}
            </li>
        @endforeach
    </ul>
    @enderror

</div>
