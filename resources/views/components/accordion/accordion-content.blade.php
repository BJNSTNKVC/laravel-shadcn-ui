@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'id' => $id,
        'role' => 'region',
        'aria-labelledby' => $id,
        'aria-expanded' => $state === 'open' ? 'true' : 'false',
        'data-orientation' => $orientation,
        'data-state' => $state,
        'data-disabled' => $disabled ? '' : null,
        'hidden' => $hidden ? '' : null,
    ])
    ->class([
        'overflow-hidden transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down',
        'text-sm' => $theme === 'New York',
    ]);
@endphp

<div {{ $attributes }}>
    @if ($asChild)
        {{ $slot }}
    @else
        <div class="pb-4 pt-0">{{ $slot }}</div>
    @endif
</div>
