@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'x-ref' => 'fallback',
    ])
    ->class([
        'flex h-full w-full items-center justify-center rounded-full bg-muted',
        'hidden' => $delay !== 0,
    ]);
@endphp

@if($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <span {{ $attributes }}>
        {{ $slot }}
    </span>
@endif
