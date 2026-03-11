{{-- resources/views/components/ui/input.blade.php --}}
@props([
    'type' => 'text',
    'label' => null,
    'error' => null,
    'hint' => null,
    'icon' => null,
])

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $attributes->get('id', $attributes->get('name')) }}" class="text-sm font-medium text-foreground">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-muted">
                <x-lucide-{{ $icon }} class="h-4 w-4" />
            </div>
        @endif

        <input
            type="{{ $type }}"
            {{ $attributes->merge(['class' => [
                'input',
                $icon ? 'pl-10' : '',
                $error ? 'border-danger focus:border-danger focus:ring-danger/50' : '',
            ]]) }}
        />
    </div>

    @if($error)
        <p class="text-xs text-danger">{{ $error }}</p>
    @elseif($hint)
        <p class="text-xs text-muted">{{ $hint }}</p>
    @endif
</div>
