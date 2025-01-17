@php
    $config = json_encode(['loop' => $loop]);

    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'role' => 'radiogroup',
            'aria-required' => json_encode($required),
            'aria-orientation' => $orientation ?? null,
            'data-disabled' => $disabled ? '' : null,
            'data-orientation' => $orientation ?? null,
            'disabled' => $disabled ? '' : null,
            'dir' => $direction,
            'tabindex' => 0,
            'x-data' => "radiogroup($config)",
        ])
        ->style([
            'outline: none',
        ])
        ->class([
            'grid gap-2',
        ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif
