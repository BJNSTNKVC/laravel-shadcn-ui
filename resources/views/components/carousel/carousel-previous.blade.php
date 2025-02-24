@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'role' => 'group',
            'aria-roledescription' => 'slide',
            'x-ref' => 'prev',
            'disabled' => $disabled ? '' : null,
        ])
        ->class([
            'inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground absolute h-8 w-8 rounded-full',
            '-left-12 top-1/2 -translate-y-1/2' => $orientation === 'horizontal',
            '-top-12 left-1/2 -translate-x-1/2 rotate-90' => $orientation === 'vertical',
        ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <button {{ $attributes }}>
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
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
            <span class="sr-only">Previous slide</span>
        @endif
    </button>
@endif
