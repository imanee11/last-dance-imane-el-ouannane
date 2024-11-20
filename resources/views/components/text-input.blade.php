@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm']) }}>
