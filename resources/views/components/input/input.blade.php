@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->class([
        'flex w-full rounded-md border border-input px-3 text-base file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
        'h-10 bg-background py-2 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2' => $theme === 'default',
        'h-9 bg-transparent py-1 shadow-sm transition-colors focus-visible:ring-1' => $theme === 'New York',
    ]);
@endphp

<input {{ $attributes }}>

