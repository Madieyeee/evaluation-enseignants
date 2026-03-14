@props([
    'items' => [],
])

<aside class="flex w-64 flex-col border-r border-borderColor/70 bg-surface/95 backdrop-blur-sm">
    <div class="flex h-14 items-center justify-between border-b border-borderColor/60 px-4">
        <div class="flex items-center gap-2 overflow-hidden">
            <div
                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-accent text-xs font-bold text-accent-foreground"
            >
                E
            </div>
            <span class="truncate text-sm font-semibold text-foreground">
                EvalEnseignants
            </span>
        </div>
    </div>

    <nav class="flex-1 space-y-0.5 overflow-y-auto px-2 py-4">
        @foreach ($items as $item)
            @php
                $isActive = $item['active'] ?? false;
            @endphp
            <a
                href="{{ isset($item['route']) ? route($item['route']) : ($item['href'] ?? '#') }}"
                class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ $isActive ? 'bg-accent/10 text-accent' : 'text-muted hover:bg-surface-muted/80 hover:text-foreground' }}"
            >
                @if (!empty($item['icon']))
                    <x-ui.icon :name="$item['icon']" class="h-4 w-4 shrink-0 {{ $isActive ? 'text-accent' : '' }}" />
                @endif
                <span class="truncate">
                    {{ $item['label'] }}
                </span>
                @if ($isActive)
                    <span class="ml-auto h-1.5 w-1.5 shrink-0 rounded-full bg-accent"></span>
                @endif
            </a>
        @endforeach
    </nav>

    @auth
        <div class="border-t border-borderColor/60 p-3">
            <div class="mb-1 flex items-center gap-3 rounded-lg px-2 py-2">
                <div
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-accent/10 text-xs font-semibold text-accent"
                >
                    {{ strtoupper(mb_substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-xs font-medium text-foreground">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="truncate text-xs text-muted">
                        {{ ucfirst(auth()->user()->role ?? 'user') }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-muted transition-colors hover:bg-danger/10 hover:text-danger"
                >
                    <x-ui.icon name="log-out" class="h-4 w-4 shrink-0" />
                    <span>Deconnexion</span>
                </button>
            </form>
        </div>
    @endauth
</aside>

