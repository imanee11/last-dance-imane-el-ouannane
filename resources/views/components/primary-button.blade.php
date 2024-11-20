<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-[full] rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] font-medium  hover:bg-transparent hover:border-[2px] hover:border-[#fff] hover:text-[#fff] transition duration-300']) }}>
    {{ $slot }}
</button>
