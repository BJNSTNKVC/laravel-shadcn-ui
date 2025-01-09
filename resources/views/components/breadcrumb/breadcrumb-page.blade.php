@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'role' => 'link',
        'aria-disabled' => 'true',
        'aria-current' => 'page',
    ])
    ->class(['font-normal text-foreground']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <span {{ $attributes }}>
      {{ $slot }}
    </span>
@endif
