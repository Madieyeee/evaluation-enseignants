{{-- resources/views/components/ui/card.blade.php --}}
@props([
    'as' => 'div',
    'interactive' => false,
    'padding' => 'p-6',
])

<{{ $as }}
    {{ $attributes->class([
        'card',
        'card-interactive' => $interactive,
        $padding,
    ]) }}
>
    {{ $slot }}
</{{ $as }}>

