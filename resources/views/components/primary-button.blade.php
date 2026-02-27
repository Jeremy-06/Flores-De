<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-rose-500 to-pink-500 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:from-rose-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2 shadow-lg shadow-rose-500/25 hover:shadow-xl hover:shadow-rose-500/30 transition-all ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
