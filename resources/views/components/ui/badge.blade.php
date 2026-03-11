{{-- resources/views/components/ui/badge.blade.php --}}
@props([
    'variant' => 'default', // default | soft | outline
    'color' => 'accent', // accent | success | danger | warning | muted
    'size' => 'md', // sm | md
])

@php
    $baseClasses = 'inline-flex items-center gap-1 font-medium rounded-full transition-colors';

    $sizeClasses = [
        'sm' => 'px-2 py-0.5 text-[10px]',
        'md' => 'px-2.5 py-0.5 text-xs',
    ];

    $variantClasses = [
        'default' => [
            'accent' => 'bg-accent text-accent-foreground',
            'success' => 'bg-success text-white',
            'danger' => 'bg-danger text-white',
            'warning' => 'bg-warning text-white',
            'muted' => 'bg-muted text-white',
        ],
        'soft' => [
            'accent' => 'bg-accent-soft text-accent',
            'success' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
            'danger' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            'warning' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'muted' => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400',
        ],
        'outline' => [
            'accent' => 'border border-accent text-accent',
            'success' => 'border border-success text-success',
            'danger' => 'border border-danger text-danger',
            'warning' => 'border border-warning text-warning',
            'muted' => 'border border-muted text-muted',
        ],
    ];
@endphp

<span {{ $attributes->class([
    $baseClasses,
    $sizeClasses[$size] ?? $sizeClasses['md'],
    $variantClasses[$variant][$color] ?? $variantClasses['default']['accent'],
]) }}>
    {{ $slot }}
</span>
