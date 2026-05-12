<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Menu Navigation Demo - {{ config('app.name') }}</title>

        @if (filled(config('menu-builder.assets.vite')))
            @vite(config('menu-builder.assets.vite'))
        @endif
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-950 antialiased dark:bg-gray-950 dark:text-white">
        <main class="mx-auto flex min-h-screen w-[calc(100%_-_2rem)] max-w-7xl flex-col gap-10 py-8">
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-gray-900 dark:ring-white/10">
                <p class="font-mono text-xs font-semibold uppercase tracking-[0.2em] text-primary-700 dark:text-primary-300">
                    Livewire Demo
                </p>

                <h1 class="mt-3 text-3xl font-semibold tracking-tight">
                    Dynamische Menü-Navigation
                </h1>

                <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-600 dark:text-slate-300">
                    Diese Seite rendert die Navigation direkt über die Package-Komponente
                    <code class="rounded bg-slate-100 px-1.5 py-0.5 font-mono text-xs dark:bg-white/10">&lt;livewire:menu-builder.navigation /&gt;</code>.
                </p>
            </section>

            <livewire:menu-builder.navigation />

            <section class="rounded-3xl border border-dashed border-slate-300 p-6 text-sm text-slate-600 dark:border-white/10 dark:text-slate-300">
                Lege oder ändere Menüpunkte im Filament Menü Builder. Nach dem Speichern wird diese Navigation aus den aktiven Einträgen der Tabelle <code class="font-mono">menu_items</code> aufgebaut.
            </section>
        </main>
    </body>
</html>
