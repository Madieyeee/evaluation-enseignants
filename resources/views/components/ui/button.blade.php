{{-- resources/views/components/ui/button.blade.php --}}
@props([
    'variant' => 'primary', // primary | secondary | ghost | danger
    'size' => 'md', // xs | sm | md | lg
    'icon' => null, // optionnel: nom icône
    'as' => 'button', // button | a
])

@php
    $base = 'inline-flex items-center justify-center gap-1.5 font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent/50';

    $variants = [
        'primary' => 'bg-accent text-white hover:bg-accent/90 hover:-translate-y-0.5',
        'secondary' => 'bg-surface-muted text-foreground hover:bg-surface-muted/80',
        'ghost' => 'text-muted hover:bg-surface-muted/80 hover:text-foreground',
        'danger' => 'bg-danger text-white hover:bg-danger/90 hover:-translate-y-0.5',
    ];

    $sizes = [
        'xs' => 'h-7 px-2 text-xs',
        'sm' => 'h-8 px-3 text-xs',
        'md' => 'h-9 px-4 text-sm',
        'lg' => 'h-10 px-5 text-sm',
    ];

    $extraClass = $attributes->get('class', '');
    if (is_array($extraClass)) {
        $extraClass = implode(' ', $extraClass);
    }

    $classes = trim($base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . $extraClass);
@endphp

@if($as === 'a')
    <a {{ $attributes->except(['class', 'variant', 'size', 'icon', 'as'])->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" class="h-4 w-4" />
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <button {{ $attributes->except(['class', 'variant', 'size', 'icon', 'as'])->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" class="h-4 w-4" />
        @endif
        <span>{{ $slot }}</span>
    </button>
@endif

