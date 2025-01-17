@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'data-state' => $state,
            'data-disabled' => $disabled ? '' : null,
            'x-ref' => 'indicator',
        ])
        ->style([
            'pointer-events' => 'none',
        ])
        ->class([
            'h-full flex items-center justify-center',
            'hidden' => $state !== 'checked',
        ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <span {{ $attributes }}>
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                @class([
                    'fill-current text-current',
                    'h-2.5 w-2.5' => $theme === 'default',
                    'h-3.5 w-3.5' => $theme === 'New York',
                ])
            >
                <circle cx="12" cy="12" r="10" />
            </svg>
        @endif
    </span>
@endif
