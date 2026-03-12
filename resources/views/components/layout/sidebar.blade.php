@props([
    'items' => [],
])

<aside
    x-data="sidebar()"
    x-init="init()"
    @resize.window="handleResize()"
    @toggle-sidebar.window="toggleMobile()"
    class="flex flex-col border-r border-borderColor/70 bg-surface/95 backdrop-blur-sm transition-all duration-300 ease-out
        fixed inset-y-0 left-0 z-40 lg:relative"
    :class="{
        'w-64': !collapsed,
        'w-20': collapsed,
        '-translate-x-full lg:translate-x-0': !mobileOpen,
        'translate-x-0': mobileOpen
    }"
    x-cloak
>
    {{-- Header logo --}}
    <div class="flex h-14 items-center justify-between border-b border-borderColor/60 px-4">
        <div class="flex items-center gap-2 overflow-hidden" x-show="!collapsed || mobileOpen">
            <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-accent text-white text-xs font-bold">
                E
            </div>
            <span class="truncate text-sm font-semibold text-foreground" x-transition.opacity.duration.150ms>
                EvalEnseignants
            </span>
        </div>
        {{-- Toggle collapse button (desktop) --}}
        <button
            type="button"
            class="hidden lg:inline-flex h-7 w-7 items-center justify-center rounded-md text-muted hover:bg-surface-muted/80 transition-colors"
            @click="collapsed = !collapsed; localStorage.setItem('sidebar_collapsed', collapsed)"
            :title="collapsed ? 'Agrandir' : 'Reduire'"
        >
            <x-ui.icon name="panel-left-close" class="h-3.5 w-3.5" x-show="!collapsed" />
            <x-ui.icon name="panel-left-open" class="h-3.5 w-3.5" x-show="collapsed" />
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 space-y-0.5 px-2 py-4 overflow-y-auto">
        @foreach ($items as $item)
            @php $isActive = $item['active'] ?? false; @endphp
            <a
                href="{{ isset($item['route']) ? route($item['route']) : ($item['href'] ?? '#') }}"
                class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200
                    {{ $isActive ? 'bg-accent/10 text-accent' : 'text-muted hover:bg-surface-muted/80 hover:text-foreground' }}"
                @click="if (window.innerWidth < 1024) mobileOpen = false"
            >
                @if (!empty($item['icon']))
                    <x-ui.icon :name="$item['icon']" class="h-4 w-4 shrink-0 {{ $isActive ? 'text-accent' : '' }}" />
                @endif
                <span class="truncate" x-show="!collapsed || mobileOpen" x-transition.opacity.duration.150ms>
                    {{ $item['label'] }}
                </span>
                @if ($isActive)
                    <span class="ml-auto h-1.5 w-1.5 shrink-0 rounded-full bg-accent" x-show="!collapsed || mobileOpen"></span>
                @endif
            </a>
        @endforeach
    </nav>

    {{-- Footer: infos user + deconnexion --}}
    <div class="border-t border-borderColor/60 p-3">
        @auth
            <div class="flex items-center gap-3 rounded-lg px-2 py-2 mb-1" x-show="!collapsed || mobileOpen" x-transition.opacity.duration.150ms>
                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-accent/10 text-xs font-semibold text-accent">
                    {{ strtoupper(mb_substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-xs font-medium text-foreground">{{ auth()->user()->name }}</p>
                    <p class="truncate text-xs text-muted">{{ ucfirst(auth()->user()->role ?? 'user') }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-muted hover:bg-danger/10 hover:text-danger transition-colors"
                >
                    <x-ui.icon name="log-out" class="h-4 w-4 shrink-0" />
                    <span x-show="!collapsed || mobileOpen" x-transition.opacity.duration.150ms>
                        Deconnexion
                    </span>
                </button>
            </form>
        @endauth
    </div>
</aside>

{{-- Overlay mobile --}}
<div
    x-data
    x-show="$store && false"
    class="fixed inset-0 z-30 bg-black/50 lg:hidden"
    @click="$dispatch('toggle-sidebar')"
    x-cloak
></div>
