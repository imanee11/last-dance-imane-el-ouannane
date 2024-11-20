@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#fff] ']) }}>
    {{ $value ?? $slot }}
</label>
