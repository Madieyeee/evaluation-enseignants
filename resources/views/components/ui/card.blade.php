{{-- resources/views/components/ui/card.blade.php --}}
@props([
    'as' => 'div',
    'interactive' => false,
    'padding' => 'p-6',
])

@php
    $cardClasses = 'rounded-xl border border-borderColor/60 bg-surface shadow-subtle';
    if ($interactive) {
        $cardClasses .= ' hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer';
    }
    $cardClasses .= ' ' . $padding;
    $extraClass = $attributes->get('class', '');
    if (is_array($extraClass)) {
        $extraClass = implode(' ', $extraClass);
    }
    $cardClasses = trim($cardClasses . ' ' . $extraClass);
@endphp

<{{ $as }} {{ $attributes->except(['class', 'as', 'interactive', 'padding'])->merge(['class' => $cardClasses]) }}>
    {{ $slot }}
</{{ $as }}>

