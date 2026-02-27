<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-500 to-rose-500 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-600 active:from-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 shadow-lg shadow-red-500/25 transition-all ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
