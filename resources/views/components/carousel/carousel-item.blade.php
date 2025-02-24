@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'role' => 'group',
            'aria-roledescription' => 'slide',
        ])
        ->class([
            'min-w-0 shrink-0 grow-0 basis-full',
            'pl-4' => $orientation === 'horizontal',
            'pt-4' => $orientation === 'vertical',
        ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif
