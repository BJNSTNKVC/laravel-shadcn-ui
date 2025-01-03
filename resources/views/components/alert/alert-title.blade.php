@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class(['mb-1 font-medium leading-none tracking-tight']);
@endphp

@if($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <h5 {{ $attributes }}>
        {{ $slot }}
    </h5>
@endif

