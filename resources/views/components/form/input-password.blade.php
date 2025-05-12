<div x-data="{ show: false }" class="@error($name) input-invalid @enderror relative">
    <label for="{{ $name }}" class="relative mb-1 lg:mb-1.5  block text-xs text-myblack ">
        {{ ucfirst($label) }}
        @if($required)
            <span aria-hidden="true" class="absolute -top-0.1 ml-1 text-turquoise text-2xl leading-none">*</span>
        @endif
    </label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        wire:model.blur="{{ $model }}"
        placeholder="••••••••"
        :type="show ? 'text' : 'password'"
        class="m-0 pt-4 pb-2 px-4 block w-full border border-myblack  rounded-lg text-myblack"
        {{ $attributes }}
    >
    <div class="absolute top-9 right-3 flex justify-center items-center space-x-1 cursor-pointer">
        <x-svg.eye/>
        <x-svg.eye-off/>
    </div>
</div>
