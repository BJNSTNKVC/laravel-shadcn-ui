@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'id' => $id,
        'type' => 'button',
        'aria-controls' => $id,
        'aria-expanded' => $state === 'open' ? 'true' : 'false',
        'data-state' => $state,
        'data-disabled' => $disabled ? '' : null,
        'disabled' => $disabled ? '' : null,
        'x-ref' => 'trigger',
    ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <button {{ $attributes }}>
        {{ $slot }}
    </button>
@endif


