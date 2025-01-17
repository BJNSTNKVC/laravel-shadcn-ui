@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'type' => 'button',
            'role' => 'radio',
            'aria-checked' => json_encode($checked),
            'aria-required' => $required ? json_encode($required) : null,
            'data-state' => $state,
            'data-disabled' => $disabled ? '' : null,
            'disabled' => $disabled ? '' : null,
            'value' => $value,
            'x-ref' => 'radio',
        ])
        ->class([
            'aspect-square h-4 w-4 rounded-full border border-primary text-primary disabled:cursor-not-allowed disabled:opacity-50',
            'ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2' => $theme === 'default',
            'shadow focus:outline-none focus-visible:ring-1 focus-visible:ring-ring' => $theme === 'New York',
        ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes>
        <x-radio-group-indicator />
    </x-compile-as-child>
@else
    <button {{ $attributes }}>
        <x-radio-group-indicator />
    </button>
@endif
