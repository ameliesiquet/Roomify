@props(['value'])
<label {{ $attributes->merge(['class' => 'block text-sm text-gray-700 border-myblack']) }}>
    {{ $value ?? $slot }}
</label>
