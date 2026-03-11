{{-- resources/views/components/layout/sidebar.blade.php --}}
@props([
    'items' => [], // [['label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'dashboard', 'active' => true], ...]
])

<aside
    x-data="{ open: true }"
    class="flex flex-col border-r border-borderColor/70 bg-surface/95 backdrop-blur-sm"
>
    <div class="flex items-center justify-between px-4 py-4">
        <div class="flex items-center gap-2">
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-accent-soft text-accent">
                <span class="text-sm font-semibold">EV</span>
            </span>
            <span class="text-sm font-semibold tracking-tight text-foreground">
                Évaluation
            </span>
        </div>

        <button
            type="button"
            class="hidden rounded-lg p-1.5 text-muted hover:bg-surface-muted/80 lg:inline-flex"
            @click="open = !open"
        >
            <x-lucide-panel-left class="h-4 w-4" />
        </button>
    </div>

    <nav class="flex-1 space-y-1 px-2 pb-4" :class="open ? 'lg:w-64' : 'lg:w-20'">
        @foreach ($items as $item)
            @php
                $isActive = $item['active'] ?? false;
            @endphp
            <a
                href="{{ isset($item['route']) ? route($item['route']) : ($item['href'] ?? '#') }}"
                class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition duration-200 ease-soft-out
                    {{ $isActive ? 'bg-accent-soft text-accent' : 'text-muted hover:bg-surface-muted/80 hover:text-foreground' }}"
            >
                @if (!empty($item['icon']))
                    <x-lucide-{{ $item['icon'] }} class="h-4 w-4" />
                @endif
                <span class="truncate" x-show="open" x-transition.opacity.duration.150ms>
                    {{ $item['label'] }}
                </span>
            </a>
        @endforeach
    </nav>
</aside>

