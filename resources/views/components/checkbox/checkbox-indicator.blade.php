@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'data-state' => $state,
        'data-disabled' => $disabled ? '' : null,
        'x-ref' => 'indicator',
    ])
    ->style([
        'pointer-events' => 'none',
    ])
    ->class([
        'flex items-center justify-center text-current',
        'hidden' => $state !== 'checked',
    ])
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
                class="h-4 w-4"
            >
                <path d="M20 6 9 17l-5-5" />
            </svg>
        @endif
    </span>
@endif
