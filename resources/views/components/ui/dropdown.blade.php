{{-- resources/views/components/ui/dropdown.blade.php --}}
@props([
    'align' => 'right', // left | right | center
    'width' => 'auto', // auto | sm | md | lg
])

@php
    $widthClasses = [
        'auto' => 'w-auto min-w-[8rem]',
        'sm' => 'w-48',
        'md' => 'w-56',
        'lg' => 'w-72',
    ];

    $alignClasses = [
        'left' => 'left-0 origin-top-left',
        'right' => 'right-0 origin-top-right',
        'center' => 'left-1/2 -translate-x-1/2 origin-top',
    ];
@endphp

<div
    x-data="{ open: false }"
    @click.away="open = false"
    class="relative inline-block"
>
    {{-- Trigger --}}
    <div @click="open = !open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    {{-- Content --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-cloak
        class="absolute z-50 mt-2 {{ $widthClasses[$width] }} {{ $alignClasses[$align] }} rounded-xl border border-borderColor/60 bg-surface p-1 shadow-lg backdrop-blur-sm"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
