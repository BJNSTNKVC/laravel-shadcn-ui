@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'role' => 'presentation',
        'aria-hidden' => 'true',
    ])
    ->class(['flex h-9 w-9 items-center justify-center']);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <span {{ $attributes }}>
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
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
        </svg>
        <span class="sr-only">More</span>
    </span>
@endif
