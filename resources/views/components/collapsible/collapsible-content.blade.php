@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'id' => $id,
        'data-state' => $state,
        'data-disabled' => $disabled ? '' : null,
        'hidden' => $state === 'closed',
        'x-ref' => 'content',
    ]);
@endphp


@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif
