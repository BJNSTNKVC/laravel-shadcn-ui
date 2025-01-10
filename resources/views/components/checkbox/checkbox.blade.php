@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'type' => 'button',
        'role' => 'checkbox',
        'aria-checked' => json_encode($checked),
        'aria-required' => $required ? json_encode($required) : null,
        'data-state' => $state,
        'data-disabled' => $disabled ? '' : null,
        'disabled' => $disabled ? '' : null,
        'value' => $value,
        'x-data' => 'checkbox',
    ])
    ->class([
        'peer h-4 w-4 shrink-0 rounded-sm border border-primary focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground',
        'ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2' => $theme === 'default',
        'shadow focus-visible:ring-1' => $theme === 'New York',
    ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes>
        <x-checkbox-indicator />
    </x-compile-as-child>
@else
    <button {{ $attributes }}>
        <x-checkbox-indicator />
    </button>
@endif
