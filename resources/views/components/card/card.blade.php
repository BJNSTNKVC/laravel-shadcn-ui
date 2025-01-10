@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class([
        'border bg-card text-card-foreground',
        'rounded-lg shadow-sm' => $theme === 'default',
        'rounded-xl shadow' => $theme === 'New York',
    ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif
