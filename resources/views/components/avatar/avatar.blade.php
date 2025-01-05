@php
    $config = json_encode(['delay' => $delay]);

    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'x-data' => "avatar($config)",
    ])
    ->class(['relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full'])
@endphp

@if($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <span {{ $attributes }}>
        {{ $slot }}
    </span>
@endif
