@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class(['transition-colors hover:text-accent-foreground']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <a {{ $attributes }}>
        {{ $slot }}
    </a>
@endif
