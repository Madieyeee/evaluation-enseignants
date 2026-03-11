<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="themeSwitcher()"
    x-init="init()"
    :class="{ dark: isDark }"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $title ?? config('app.name', 'Evaluation enseignants') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-app font-sans antialiased text-foreground">
        <div class="flex min-h-screen">
            <x-layout.sidebar :items="$sidebarItems ?? []" />

            <div class="flex min-h-screen flex-1 flex-col">
                <header
                    class="flex items-center justify-between border-b border-borderColor/60 bg-surface/80 px-6 py-3 backdrop-blur-sm"
                >
                    <div class="flex items-center gap-4">
                        {{-- Bouton menu mobile --}}
                        <button
                            type="button"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-muted hover:bg-surface-muted/80 lg:hidden"
                            @click="$dispatch('toggle-sidebar')"
                            aria-label="Ouvrir le menu"
                        >
                            <x-ui.icon name="menu" class="h-4 w-4" />
                        </button>

                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium uppercase tracking-[0.16em] text-muted">
                                {{ $section ?? 'Vue globale' }}
                            </span>
                            <span class="text-sm font-medium text-foreground">
                                {{ $pageTitle ?? ($header ?? 'Dashboard') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-muted hover:bg-surface-muted/80"
                            @click="toggle()"
                        >
                            <template x-if="!isDark">
                                <x-ui.icon name="moon" class="h-4 w-4" />
                            </template>
                            <template x-if="isDark">
                                <x-ui.icon name="sun-medium" class="h-4 w-4" />
                            </template>
                        </button>

                        {{-- Notifications --}}
                        <x-ui.notification-bell />

                        <div
                            class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-surface-muted text-xs font-medium text-foreground"
                        >
                            {{ strtoupper(mb_substr(auth()->user()->name ?? 'User', 0, 2)) }}
                        </div>
                    </div>
                </header>

                <main class="container py-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
