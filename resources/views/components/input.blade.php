@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'input input-bordered rounded-md shadow-sm border-gray-800 focus:border-teal-300 focus:ring focus:ring-teal-300 focus:ring-opacity-50 text-base-content']) !!}>
