{{-- resources/views/components/ui/dropdown-item.blade.php --}}
@props([
    'icon' => null,
    'danger' => false,
])

<a
    {{ $attributes->merge(['class' => [
        'flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition-colors',
        $danger
            ? 'text-danger hover:bg-red-50 dark:hover:bg-red-900/20'
            : 'text-muted hover:bg-surface-muted/80 hover:text-foreground',
    ]]) }}
>
    @if($icon)
        <x-ui.icon :name="$icon" class="h-4 w-4" />
    @endif
    {{ $slot }}
</a>
