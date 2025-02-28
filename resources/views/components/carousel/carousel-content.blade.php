@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $root = $attributes
        ->merge([
            'x-bind' => 'content',
        ])
        ->class('overflow-hidden');

    $attributes = $attributes
        ->class([
            'flex',
            '-ml-4' => $orientation === 'horizontal',
            '-mt-4 flex-col' => $orientation === 'vertical',
        ])
@endphp

<div {{ $root }}>
    @if ($asChild)
        <x-compile-as-child :$slot :$attributes />
    @else
        <div {{ $attributes }}>
            {{ $slot }}
        </div>
    @endif
</div>

