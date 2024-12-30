@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'id' => $id,
        'aria-controls' => $id,
        'aria-expanded' => $state === 'open' ? 'true' : 'false',
        'data-orientation' => $orientation,
        'data-state' => $state,
        'data-disabled' => $disabled ? '' : null,
        'disabled' => $disabled ? '' : null,
    ])
    ->class([
        'flex flex-1 items-center justify-between py-4 font-medium transition-all hover:underline text-left [&[data-state=open]>svg]:rotate-180',
        'text-sm' => $theme === 'New York',
    ]);
@endphp

<h3 class="flex" {{ $attributes->only(['data-orientation', 'data-disabled']) }}>
    @if ($asChild)
        <x-compile-as-child :$slot :$attributes>
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
                class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"
            >
                <path d="m6 9 6 6 6-6"></path>
            </svg>
        </x-compile-as-child>
    @else
        <button {{ $attributes }}>
            {{ $slot }}
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
                class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"
            >
                <path d="m6 9 6 6 6-6"></path>
            </svg>
        </button>
    @endif
</h3>


