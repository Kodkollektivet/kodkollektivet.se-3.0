@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-teal-300 focus:outline-none focus:border-teal-300 transition duration-150 ease-in-out hover:text-white hover:border-white'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-base-content hover:text-teal-300 hover:border-teal-300 focus:outline-none focus:text-teal-300 focus:border-teal-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
