@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge(['aria-label' => 'breadcrumb']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <nav {{ $attributes }}>
        {{ $slot }}
    </nav>
@endif
