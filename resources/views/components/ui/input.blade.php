{{-- resources/views/components/ui/input.blade.php --}}
@props([
    'type' => 'text',
    'label' => null,
    'error' => null,
    'hint' => null,
    'icon' => null,
])

@php
    $inputClasses = 'w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground placeholder:text-muted/60 focus:border-accent focus:ring-1 focus:ring-accent transition-colors';
    if ($icon) {
        $inputClasses .= ' pl-10';
    }
    if ($error) {
        $inputClasses .= ' border-danger focus:border-danger focus:ring-danger/50';
    }
    $extraClass = $attributes->get('class', '');
    if (is_array($extraClass)) {
        $extraClass = implode(' ', $extraClass);
    }
    $inputClasses = trim($inputClasses . ' ' . $extraClass);
@endphp

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $attributes->get('id', $attributes->get('name')) }}" class="text-sm font-medium text-foreground">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-muted">
                <x-ui.icon :name="$icon" class="h-4 w-4" />
            </div>
        @endif

        <input
            type="{{ $type }}"
            {{ $attributes->except(['class'])->merge(['class' => $inputClasses]) }}
        />
    </div>

    @if($error)
        <p class="text-xs text-danger">{{ $error }}</p>
    @elseif($hint)
        <p class="text-xs text-muted">{{ $hint }}</p>
    @endif
</div>
