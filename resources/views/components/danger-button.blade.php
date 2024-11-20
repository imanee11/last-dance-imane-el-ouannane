<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-md px-4 py-3 bg-red-600 border border-transparent  font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
