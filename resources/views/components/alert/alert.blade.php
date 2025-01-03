@php
    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'role' => 'alert',
    ])
    ->class([
        'relative w-full rounded-lg border [&>svg~*]:pl-7 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground',
        'p-4' => $theme === 'default',
        'px-4 py-3 text-sm' => $theme === 'New York',
        'bg-background text-foreground' => $variant === 'default',
        'border-destructive/50 text-destructive [&>svg]:text-destructive' => $variant === 'destructive',
    ]);
@endphp

@if($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif


