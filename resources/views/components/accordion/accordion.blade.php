@php
    $config = json_encode(['type' => $type, 'collapsible' => $collapsible, 'direction' => $direction]);

    /* @var Illuminate\View\ComponentAttributeBag $attributes */
    $attributes = $attributes->merge([
        'data-orientation' => $orientation,
        'x-data' => "accordion($config)",
    ])
@endphp

@if ($asChild)
    <x-compile-as-child :$slot :$attributes />
@else
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@endif

