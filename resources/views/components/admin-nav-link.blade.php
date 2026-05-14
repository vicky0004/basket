@props(['active', 'icon'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center px-4 py-3 text-sm font-semibold text-green-700 bg-green-50 rounded-xl transition-all duration-200'
        : 'flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:text-green-600 hover: rounded-xl transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i data-lucide="{{ $icon }}" class="w-5 h-5 mr-3 {{ ($active ?? false) ? 'text-green-600' : 'text-gray-400' }}"></i>
    {{ $slot }}
</a>