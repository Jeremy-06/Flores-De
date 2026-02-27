@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-rose-200 focus:border-rose-400 focus:ring-rose-300 focus:ring-opacity-50 rounded-xl px-4 py-2.5 text-sm shadow-sm transition-all duration-200 placeholder:text-gray-300']) }}>
