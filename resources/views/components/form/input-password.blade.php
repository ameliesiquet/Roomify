@props(['label', 'name', 'type' => 'text','model' => '', 'placeholder' => '', 'required' => false])

<div x-data="{ show: false }" class="@error($name) input-invalid @enderror relative">
    <label for="{{ $name }}" class="relative mb-1 block text-xs text-myblack ">
        {{ ucfirst($label) }}
        @if ($required)
            <span aria-hidden="true" class="absolute -top-0.1 ml-1 text-turquoise text-xs lg:text-2xl leading-none">*</span>
        @endif
    </label>
    <div class="flex flex-row justify-between border border-myblack rounded-lg text-myblack pr-2">
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            :type="show ? 'text' : 'password'"
            @if($model)
                wire:model.defer="{{ $model }}"
            @endif
            placeholder="{{ $placeholder ?: '••••••••' }}"
            class="m-0  pt-2.5 pb-1.5 lg:pt-4 lg:pb-2 px-4  block w-full text-gray-500 text-xs"
            {{ $attributes }}
        >
        <div class="  flex justify-center items-center space-x-1 cursor-pointer">
            <x-svg.eye />
            <x-svg.eye-off />
        </div>
    </div>
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
