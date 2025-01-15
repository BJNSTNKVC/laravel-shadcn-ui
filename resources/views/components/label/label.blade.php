@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'for' => $for,
        ])
        ->class([
            'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70',
        ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <label {{ $attributes }}>
        {{ $slot }}
    </label>
@endif

