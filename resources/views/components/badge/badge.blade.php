@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class([
        'inline-flex items-center border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2',
        'rounded-full' => $theme === 'default',
        'rounded-md shadow' => $theme === 'New York',
        'border-transparent bg-primary text-primary-foreground hover:bg-primary/80' => $variant === 'default',
        'border-transparent bg-destructive text-destructive-foreground hover:bg-destructive/80' => $variant === 'destructive',
        'text-foreground' => $variant === 'outline',
        'border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80' => $variant === 'secondary',
    ])
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif

