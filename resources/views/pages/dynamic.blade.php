<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $pageTitle }} - {{ config('app.name') }}</title>

        @if (filled(config('menu-builder.assets.vite')))
            @vite(config('menu-builder.assets.vite'))
        @endif
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-950 antialiased dark:bg-gray-950 dark:text-white">
        <div class="mx-auto flex min-h-screen w-[calc(100%_-_2rem)] max-w-7xl flex-col py-4">
            <livewire:menu-builder.navigation />

            <main class="grid flex-1 place-items-center py-12">
                <article class="w-full max-w-3xl rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-white/10">
                    <p class="font-mono text-xs font-semibold uppercase tracking-[0.2em] text-primary-700 dark:text-primary-300">
                        Dynamische Menüseite
                    </p>

                    <h1 class="mt-4 text-4xl font-semibold tracking-tight text-slate-950 dark:text-white">
                        {{ $menuItem->label }}
                    </h1>

                    <dl class="mt-8 grid gap-4 text-sm sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200 dark:bg-white/[0.03] dark:ring-white/10">
                            <dt class="font-semibold text-slate-500 dark:text-slate-400">Slug</dt>
                            <dd class="mt-1 font-mono text-slate-950 dark:text-white">{{ $menuItem->slug }}</dd>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200 dark:bg-white/[0.03] dark:ring-white/10">
                            <dt class="font-semibold text-slate-500 dark:text-slate-400">Blade View</dt>
                            <dd class="mt-1 font-mono text-slate-950 dark:text-white">{{ $menuItem->view }}</dd>
                        </div>
                    </dl>

                    <p class="mt-8 text-sm leading-6 text-slate-600 dark:text-slate-300">
                        Diese Seite wird direkt ueber den im Menüpunkt gespeicherten Blade View gerendert.
                    </p>
                </article>
            </main>
        </div>
    </body>
</html>
