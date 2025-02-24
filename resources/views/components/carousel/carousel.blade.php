@php
    $config = json_encode($options);
    $plugins = json_encode($plugins);

    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes
        ->merge([
            'role' => 'region',
            'aria-roledescription' => 'carousel',
            'x-data' => "carousel($config, $plugins)",
        ])
        ->class('relative')
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif
