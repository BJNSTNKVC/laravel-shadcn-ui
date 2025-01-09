@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class([
        'flex flex-wrap items-center gap-1.5 break-words text-muted-foreground sm:gap-2.5',
        'text-sm' => $theme === 'New York',
    ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <ol {{ $attributes }}>
        {{ $slot }}
    </ol>
@endif
