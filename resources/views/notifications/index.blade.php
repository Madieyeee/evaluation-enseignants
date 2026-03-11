<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm font-medium text-muted">
            Centre de notifications
        </h2>
    </x-slot>

    <div class="mx-auto max-w-3xl">
        {{-- Header avec actions --}}
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-foreground">Notifications</h1>
                <p class="mt-1 text-sm text-muted">
                    {{ $notifications->total() }} notification(s), dont {{ $notifications->where('read_at', null)->count() }} non lue(s)
                </p>
            </div>

            @if($notifications->where('read_at', null)->count() > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <x-ui.button variant="secondary" size="sm" icon="check-check">
                        Tout marquer comme lu
                    </x-ui.button>
                </form>
            @endif
        </div>

        {{-- Liste des notifications --}}
        <div class="space-y-3">
            @forelse($notifications as $notification)
                @php
                    $data = $notification->data;
                    $isRead = $notification->read_at !== null;
                @endphp

                <div class="card {{ $isRead ? '' : 'bg-accent-soft/20' }} p-4 transition-all hover:shadow-subtle">
                    <div class="flex gap-4">
                        {{-- Icône --}}
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-surface-muted">
                            @if(($data['icon'] ?? ''))
                                <x-ui.icon :name="$data['icon']" class="h-5 w-5 text-accent" />
                            @else
                                <x-ui.icon name="bell" class="h-5 w-5 text-accent" />
                            @endif
                        </div>

                        {{-- Contenu --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-foreground">
                                        {{ $data['title'] ?? 'Notification' }}
                                    </h3>
                                    <p class="mt-1 text-sm text-muted">
                                        {{ $data['message'] ?? '' }}
                                    </p>
                                </div>

                                @if(!$isRead)
                                    <div class="mt-1 h-2 w-2 shrink-0 rounded-full bg-accent"></div>
                                @endif
                            </div>

                            <div class="mt-3 flex items-center gap-4">
                                <span class="text-xs text-muted">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>

                                @if(!$isRead)
                                    <form action="{{ route('notifications.mark-read', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-medium text-accent hover:text-accent/80">
                                            Marquer comme lu
                                        </button>
                                    </form>
                                @endif

                                @if(isset($data['url']))
                                    <a href="{{ $data['url'] }}" class="text-xs font-medium text-muted hover:text-foreground">
                                        Voir les détails →
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card p-12 text-center">
                    <x-ui.icon name="bell-off" class="mx-auto h-12 w-12 text-muted" />
                    <h3 class="mt-4 text-lg font-semibold text-foreground">Aucune notification</h3>
                    <p class="mt-2 text-sm text-muted">
                        Vous n'avez pas encore de notifications. Elles apparaîtront ici lorsque vous recevrez des évaluations ou des feedbacks.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())
            <div class="mt-8">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
