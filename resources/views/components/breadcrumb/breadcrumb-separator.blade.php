@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'role' => 'presentation',
        'aria-hidden' => 'true',
    ])
    ->class(['[&>svg]:w-3.5 [&>svg]:h-3.5']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <li {{ $attributes }}>
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
            >
                <path d="m9 18 6-6-6-6" />
            </svg>
        @endif
    </li>
@endif



