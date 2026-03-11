{{-- resources/views/components/ui/table-row.blade.php --}}
@props([
    'clickable' => false,
])

<tr
    {{ $attributes->merge(['class' => [
        'transition-colors',
        $clickable ? 'cursor-pointer hover:bg-surface-muted/50' : 'hover:bg-surface-muted/30',
    ]]) }}
>
    {{ $slot }}
</tr>
