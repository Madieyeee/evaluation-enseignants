{{-- resources/views/components/layout/sidebar.blade.php --}}
@props([
    'items' => [], // [['label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'dashboard', 'active' => true], ...]
])

<aside
    x-data="sidebar()"
    x-init="init()"
    @resize.window="handleResize"
    @toggle-sidebar.window="toggleMobile()"
    class="flex flex-col border-r border-borderColor/70 bg-surface/95 backdrop-blur-sm transition-all duration-300 ease-soft-out
        fixed inset-y-0 left-0 z-40 lg:relative
        {{ isset($attributes['class']) ? $attributes['class'] : '' }}"
    :class="{
        'lg:w-64': open && !collapsed,
        'lg:w-20': collapsed,
        '-translate-x-full lg:translate-x-0': !mobileOpen && !open,
        'translate-x-0': mobileOpen
    }"
    x-show="mobileOpen || window.innerWidth >= 1024"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    x-cloak
>
    {{-- Overlay mobile --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm lg:hidden"
        @click="mobileOpen = false"
        x-cloak
    ></div>

    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-4 border-b border-borderColor/40">
        <div class="flex items-center gap-2" x-show="!collapsed || mobileOpen">
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-accent-soft text-accent">
                <span class="text-sm font-semibold">EV</span>
            </span>
            <span class="text-sm font-semibold tracking-tight text-foreground" x-show="!collapsed || mobileOpen" x-transition.opacity>
                Évaluation
            </span>
        </div>

        {{-- Bouton collapse desktop --}}
        <button
            type="button"
            class="hidden rounded-lg p-1.5 text-muted hover:bg-surface-muted/80 hover:text-foreground transition-colors lg:inline-flex"
            @click="toggleCollapse()"
            :aria-label="collapsed ? 'Étendre la sidebar' : 'Réduire la sidebar'"
            aria-expanded="true"
        >
            <x-ui.icon name="panel-left-close" class="h-4 w-4 transition-transform duration-200" x-bind:class="{ 'rotate-180': collapsed }" />
        </button>

        {{-- Bouton fermer mobile --}}
        <button
            type="button"
            class="rounded-lg p-1.5 text-muted hover:bg-surface-muted/80 hover:text-foreground transition-colors lg:hidden"
            @click="mobileOpen = false"
            aria-label="Fermer le menu"
        >
            <x-ui.icon name="x" class="h-4 w-4" />
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 space-y-1 px-2 py-4 overflow-y-auto">
        @foreach ($items as $item)
            @php
                $isActive = $item['active'] ?? false;
            @endphp
            <a
                href="{{ isset($item['route']) ? route($item['route']) : ($item['href'] ?? '#') }}"
                class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 ease-soft-out
                    {{ $isActive ? 'bg-accent-soft text-accent' : 'text-muted hover:bg-surface-muted/80 hover:text-foreground' }}"
                :title="collapsed && !mobileOpen ? '{{ $item['label'] }}' : ''"
                @click="if (window.innerWidth < 1024) mobileOpen = false"
            >
                @if (!empty($item['icon']))
                    <x-ui.icon :name="$item['icon']" class="h-4 w-4 shrink-0" />
                @endif
                <span
                    class="truncate"
                    x-show="!collapsed || mobileOpen"
                    x-transition.opacity.duration.150ms
                >
                    {{ $item['label'] }}
                </span>
            </a>
        @endforeach
    </nav>

    {{-- Footer avec info utilisateur --}}
    <div class="border-t border-borderColor/40 p-4">
        <div class="flex items-center gap-3" x-show="!collapsed || mobileOpen">
            <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-surface-muted text-xs font-medium text-foreground">
                {{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="truncate text-sm font-medium text-foreground">{{ auth()->user()->name ?? 'Utilisateur' }}</p>
                <p class="truncate text-xs text-muted">{{ ucfirst(auth()->user()->role ?? 'user') }}</p>
            </div>
        </div>
    </div>
</aside>

@push('scripts')
<script>
    function sidebar() {
        return {
            open: true,
            collapsed: false,
            mobileOpen: false,

            init() {
                const stored = localStorage.getItem('sidebar_collapsed');
                if (stored === 'true') {
                    this.collapsed = true;
                }
            },

            handleResize() {
                if (window.innerWidth >= 1024) {
                    this.mobileOpen = false;
                }
            },

            toggleCollapse() {
                this.collapsed = !this.collapsed;
                localStorage.setItem('sidebar_collapsed', this.collapsed);
            },

            toggleMobile() {
                this.mobileOpen = !this.mobileOpen;
            }
        }
    }
</script>
@endpush

