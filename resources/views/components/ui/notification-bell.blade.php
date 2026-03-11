{{-- resources/views/components/ui/notification-bell.blade.php --}}
@props([
    'pollInterval' => 30000, // 30 secondes par défaut
])

<div
    x-data="notificationBell({{ $pollInterval }})"
    class="relative"
    @click.away="open = false"
>
    {{-- Bouton cloche --}}
    <button
        type="button"
        class="relative inline-flex h-8 w-8 items-center justify-center rounded-lg text-muted transition-colors hover:bg-surface-muted/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent"
        @click="toggle()"
        :aria-expanded="open"
        aria-haspopup="true"
        aria-label="Notifications"
    >
        <x-ui.icon name="bell" class="h-4 w-4" />

        {{-- Badge compteur --}}
        <span
            x-show="unreadCount > 0"
            x-text="unreadCount"
            class="absolute -right-1 -top-1 flex min-h-4 min-w-4 items-center justify-center rounded-full bg-danger px-1 text-[10px] font-medium text-white"
            style="display: none;"
        ></span>
    </button>

    {{-- Dropdown notifications --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        x-cloak
        class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-xl border border-borderColor/60 bg-surface p-0 shadow-lg backdrop-blur-sm"
        style="display: none;"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-borderColor/60 px-4 py-3">
            <span class="text-sm font-semibold text-foreground">Notifications</span>
            <button
                type="button"
                x-show="unreadCount > 0"
                @click.prevent="markAllAsRead()"
                class="text-xs font-medium text-accent hover:text-accent/80"
            >
                Tout marquer comme lu
            </button>
        </div>

        {{-- Liste --}}
        <div class="max-h-80 overflow-y-auto">
            <template x-if="notifications.length === 0">
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <x-ui.icon name="bell-off" class="h-8 w-8 text-muted" />
                    <p class="mt-2 text-sm text-muted">Aucune notification</p>
                </div>
            </template>

            <template x-for="notification in notifications" :key="notification.id">
                <a
                    :href="notification.url || '#'"
                    @click="markAsRead(notification.id)"
                    class="flex gap-3 border-b border-borderColor/40 px-4 py-3 transition-colors hover:bg-surface-muted/50 last:border-b-0"
                    :class="{ 'bg-accent-soft/30': !notification.read_at }"
                >
                    {{-- Icône --}}
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-surface-muted">
                        <svg x-bind:class="'h-4 w-4 text-accent'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <template x-if="notification.icon === 'clipboard-check'">
                                <g>
                                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                                    <path d="m9 14 2 2 4-4"/>
                                </g>
                            </template>
                            <template x-if="notification.icon === 'message-square'">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </template>
                            <template x-if="notification.icon === 'file-text'">
                                <g>
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                                    <path d="M10 9H8"/>
                                    <path d="M16 13H8"/>
                                    <path d="M16 17H8"/>
                                </g>
                            </template>
                            <template x-if="!notification.icon || (notification.icon !== 'clipboard-check' && notification.icon !== 'message-square' && notification.icon !== 'file-text')">
                                <g>
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                </g>
                            </template>
                        </svg>
                    </div>

                    {{-- Contenu --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-foreground truncate" x-text="notification.title"></p>
                        <p class="mt-0.5 text-xs text-muted line-clamp-2" x-text="notification.message"></p>
                        <p class="mt-1 text-xs text-muted/70" x-text="formatTime(notification.created_at)"></p>
                    </div>

                    {{-- Indicateur non-lu --}}
                    <div x-show="!notification.read_at" class="mt-1 h-2 w-2 shrink-0 rounded-full bg-accent"></div>
                </a>
            </template>
        </div>

        {{-- Footer --}}
        <div class="border-t border-borderColor/60 px-4 py-2">
            <a
                href="{{ route('notifications.index') }}"
                class="block text-center text-xs font-medium text-muted hover:text-foreground"
            >
                Voir toutes les notifications
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function notificationBell(pollInterval) {
        return {
            notifications: [],
            unreadCount: 0,
            open: false,
            pollInterval: pollInterval,

            async init() {
                await this.fetchNotifications();
                this.startPolling();
            },

            async fetchNotifications() {
                try {
                    const response = await fetch('/api/notifications', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    if (response.ok) {
                        const data = await response.json();
                        this.notifications = data.notifications || [];
                        this.unreadCount = data.unread_count || 0;
                    }
                } catch (e) {
                    console.error('Erreur chargement notifications:', e);
                }
            },

            startPolling() {
                setInterval(() => {
                    this.fetchNotifications();
                }, this.pollInterval);
            },

            toggle() {
                this.open = !this.open;
            },

            async markAsRead(id) {
                try {
                    await fetch(`/api/notifications/${id}/read`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    await this.fetchNotifications();
                } catch (e) {
                    console.error('Erreur marquage notification:', e);
                }
            },

            async markAllAsRead() {
                try {
                    await fetch('/api/notifications/read-all', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    await this.fetchNotifications();
                } catch (e) {
                    console.error('Erreur marquage toutes notifications:', e);
                }
            },

            formatTime(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diff = Math.floor((now - date) / 1000);

                if (diff < 60) return 'À l\'instant';
                if (diff < 3600) return `Il y a ${Math.floor(diff / 60)} min`;
                if (diff < 86400) return `Il y a ${Math.floor(diff / 3600)} h`;
                if (diff < 604800) return `Il y a ${Math.floor(diff / 86400)} j`;

                return date.toLocaleDateString('fr-FR', {
                    day: 'numeric',
                    month: 'short'
                });
            }
        }
    }
</script>
@endpush
