@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 text-sm text-gray-700 bg-gray-100 hover:bg-gray-100 transition duration-150 ease-in-out'
            : 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} role="menuitem">
    {{ $slot }}
</a>
