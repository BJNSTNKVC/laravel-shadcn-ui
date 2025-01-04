@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $root = $attributes->style([
        'position: relative',
        'width: 100%',
        'padding-bottom: ' . 100 / $ratio . '%',
    ])
    ->merge([
        'aspect-ratio-wrapper' => ''
    ])
    ->except('class');

    $styles = $attributes->style([
        'position: absolute',
        'height: 100%',
        'width: 100%',
        'inset: 0px',
        'color: transparent',
    ]);
@endphp

@if ($asChild)
    <div {{ $root }}>
        <x-compile-as-child :$slot :attributes="$styles" />
    </div>
@else
    <div {{ $root }}>
        <div {{ $attributes }} {{ $styles }}>
            {{ $slot }}
        </div>
    </div>
@endif


