@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'data-orientation' => $orientation,
        'data-state' => $state,
        'data-disabled' => $disabled ? true : null,
        'x-init' => "add('$id', \$el)",
    ])
    ->class(['border-b']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif
