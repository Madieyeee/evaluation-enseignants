{{-- resources/views/components/ui/table-cell.blade.php --}}
@props([
    'align' => 'left', // left | center | right
    'header' => false,
])

@php
    $alignClasses = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];
@endphp

<{{ $header ? 'th' : 'td' }}
    {{ $attributes->merge(['class' => [
        'px-4 py-3',
        $alignClasses[$align],
        $header ? 'font-semibold text-muted' : 'text-foreground',
    ]]) }}
>
    {{ $slot }}
</{{ $header ? 'th' : 'td' }}>
