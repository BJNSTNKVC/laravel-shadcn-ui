@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class([
        'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0',
        'ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2 h-10' => $theme === 'default',
        'focus-visible:ring-1 shadow h-9' => $theme === 'New York',
        'bg-primary text-primary-foreground hover:bg-primary/90' => $variant === 'default',
        'bg-destructive text-destructive-foreground hover:bg-destructive/90' => $variant === 'destructive',
        'border border-input bg-background hover:bg-accent hover:text-accent-foreground' => $variant === 'outline',
        'bg-secondary text-secondary-foreground hover:bg-secondary/80' => $variant === 'secondary',
        'hover:bg-accent hover:text-accent-foreground' => $variant === 'ghost',
        'text-primary underline-offset-4 hover:underline' => $variant === 'link',
        'h-10 px-4 py-2' => $size === 'default',
        'h-9 rounded-md px-3' => $size === 'sm',
        'h-11 rounded-md px-8' => $size === 'lg',
        'h-10 w-10' => $size === 'icon',
    ]);
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <button {{ $attributes }}>
        {{ $slot }}
    </button>
@endif

