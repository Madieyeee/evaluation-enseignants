{{-- resources/views/components/ui/button.blade.php --}}
@props([
    'variant' => 'primary', // primary | secondary | ghost | danger
    'size' => 'md', // sm | md | lg
    'icon' => null, // optionnel: nom icône Lucide
])

@php
    $base = 'btn';

    $variants = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'ghost' => 'btn-ghost',
        'danger' => 'btn bg-danger text-white hover:bg-danger/90 hover:-translate-y-0.5',
    ];

    $sizes = [
        'sm' => 'h-8 px-3 text-xs',
        'md' => 'h-9 px-4 text-sm',
        'lg' => 'h-10 px-5 text-sm',
    ];
@endphp

<button
    {{ $attributes->class([
        $base,
        $variants[$variant] ?? $variants['primary'],
        $sizes[$size] ?? $sizes['md'],
    ]) }}
>
    @if ($icon)
        <x-ui.icon :name="$icon" class="h-4 w-4" />
    @endif
    <span>{{ $slot }}</span>
</button>

