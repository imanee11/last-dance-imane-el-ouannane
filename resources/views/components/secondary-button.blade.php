<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent  border border-[#fff]/25  rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none disabled:opacity-25 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
