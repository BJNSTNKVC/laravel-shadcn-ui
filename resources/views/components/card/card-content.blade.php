@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class(['p-6 pt-0']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif