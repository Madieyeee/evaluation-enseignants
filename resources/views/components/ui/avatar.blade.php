{{-- resources/views/components/ui/avatar.blade.php --}}
@props([
    'src' => null,
    'name' => 'User',
    'size' => 'md', // sm | md | lg | xl
])

@php
    $sizeClasses = [
        'sm' => 'h-6 w-6 text-[10px]',
        'md' => 'h-8 w-8 text-xs',
        'lg' => 'h-10 w-10 text-sm',
        'xl' => 'h-12 w-12 text-base',
    ];

    $initials = strtoupper(mb_substr($name, 0, 2));
@endphp

<div
    {{ $attributes->class([
        'inline-flex items-center justify-center rounded-full bg-surface-muted font-medium text-foreground',
        $sizeClasses[$size] ?? $sizeClasses['md'],
    ]) }}
>
    @if($src)
        <img src="{{ $src }}" alt="{{ $name }}" class="h-full w-full rounded-full object-cover" />
    @else
        {{ $initials }}
    @endif
</div>
