@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'auth-input block w-full border border-gray-300 bg-white/70 px-3 py-2.5 text-sm text-gray-900 focus:border-orange-600 focus:ring-1 focus:ring-orange-600']) }}>
