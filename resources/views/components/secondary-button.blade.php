<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2.5 bg-white border border-rose-200 rounded-xl font-semibold text-xs text-gray-600 uppercase tracking-widest shadow-sm hover:bg-rose-50 hover:border-rose-300 focus:outline-none focus:ring-2 focus:ring-rose-300 focus:ring-offset-2 disabled:opacity-25 transition-all ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
