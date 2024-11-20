@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'w-full rounded-full text-[#fff] inline-flex items-center bg-[#6737f5] text-sm font-medium leading-5 focus:outline-none transition duration-300 ease-in-out'
            : 'w-full rounded-full inline-flex items-center text-sm font-medium leading-5 text-[#fff]/50  focus:outline-none transition duration-300 ease-in-out';

$iconClasses = ($active ?? false)
            ? 'text-[#fff] bg-[#272727] w-[3.2vw] h-[6.5vh] rounded-full' // Icon style when active
            : 'text-[#fff]/50 w-[3.2vw] h-[6.5vh] rounded-full '; // Icon style when inactive
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center gap-3 py-1 px-2">
        <i class="{{ $icon }} text-[15px] {{ $iconClasses }} flex items-center justify-center text-center"></i> 
        {{ $slot }}
    </div>
</a>
