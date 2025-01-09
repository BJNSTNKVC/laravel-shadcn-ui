@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class(['inline-flex items-center gap-1.5']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <li {{ $attributes }}>
        {{ $slot }}
    </li>
@endif
