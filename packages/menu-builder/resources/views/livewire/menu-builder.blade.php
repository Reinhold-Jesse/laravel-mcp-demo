<div class="font-[Fira_Sans]">
    <div class="grid gap-4 xl:grid-cols-[minmax(360px,460px)_1fr]">
        <section class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-gray-950 dark:ring-white/10">
            <div class="flex items-start justify-between gap-4 border-b border-slate-200 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/[0.03]">
                <div>
                    <p class="font-[Fira_Code] text-[11px] font-semibold uppercase tracking-[0.2em] text-primary-700 dark:text-primary-300">Page Tree</p>
                    <h3 class="mt-1 text-base font-semibold text-slate-950 dark:text-white">Struktur</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                        Griff ziehen, Zeile klicken, Werte rechts setzen.
                    </p>
                </div>

                <button
                    type="button"
                    wire:click="createRootItem"
                    class="inline-flex cursor-pointer items-center gap-2 rounded-xl bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm shadow-primary-600/20 transition-colors duration-200 hover:bg-primary-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 data-loading:pointer-events-none data-loading:opacity-60 motion-reduce:transition-none dark:focus-visible:ring-offset-gray-950"
                >
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    Neue Seite
                </button>
            </div>

            <div class="max-h-[calc(100vh-22rem)] overflow-auto p-4">
                @include('menu-builder::livewire.menu-builder-tree', [
                    'items' => $menuTree,
                    'parentId' => null,
                    'selectedMenuItemId' => $selectedMenuItemId,
                    'isRoot' => true,
                ])
            </div>
        </section>

        <section class="overflow-hidden dark:bg-gray-950 dark:ring-white/10">
            <div class="border-b border-slate-200 bg-slate-50/80 p-4 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="space-y-1">
                        <p class="font-[Fira_Code] text-[11px] font-semibold uppercase tracking-[0.2em] text-primary-700 dark:text-primary-300">Inspector</p>
                        <h3 class="text-base font-semibold text-slate-950 dark:text-white">Seiteneinstellungen</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Änderungen bleiben bewusst explizit und werden erst mit Speichern persistiert.
                        </p>
                    </div>

                    @if ($selectedMenuItem !== null)
                        <div class="flex flex-col items-end gap-2">
                            <span @class([
                                'inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold ring-1',
                                'bg-emerald-50 text-emerald-700 ring-emerald-600/20 dark:bg-emerald-400/10 dark:text-emerald-300 dark:ring-emerald-400/20' => $selectedMenuItem->is_active,
                                'bg-slate-100 text-slate-600 ring-slate-300 dark:bg-white/10 dark:text-slate-300 dark:ring-white/10' => ! $selectedMenuItem->is_active,
                            ])>
                                <span @class([
                                    'size-2 rounded-full',
                                    'bg-emerald-500' => $selectedMenuItem->is_active,
                                    'bg-slate-400' => ! $selectedMenuItem->is_active,
                                ])></span>
                                {{ $selectedMenuItem->is_active ? 'Aktiv' : 'Inaktiv' }}
                            </span>

                            @if ($selectedMenuItem->is_active)
                                <a
                                    href="{{ $this->urlFor($selectedMenuItem) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    title="Seite in neuem Fenster öffnen"
                                    aria-label="Seite in neuem Fenster öffnen"
                                    class="inline-flex size-7 items-center justify-center rounded-lg text-primary-600 ring-1 ring-primary-600/20 transition duration-200 hover:bg-primary-50 hover:text-primary-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 motion-reduce:transition-none dark:text-primary-300 dark:ring-primary-400/30 dark:hover:bg-primary-400/10 dark:hover:text-primary-200"
                                >
                                    <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M11.25 3a.75.75 0 0 0 0 1.5h2.19l-5.22 5.22a.75.75 0 0 0 1.06 1.06l5.22-5.22v2.19a.75.75 0 0 0 1.5 0v-4A.75.75 0 0 0 15.25 3h-4Z" />
                                        <path d="M5.5 5A2.5 2.5 0 0 0 3 7.5v7A2.5 2.5 0 0 0 5.5 17h7a2.5 2.5 0 0 0 2.5-2.5v-3a.75.75 0 0 0-1.5 0v3a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a.75.75 0 0 0 0-1.5h-3Z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            @if ($selectedMenuItem === null)
                <div class="grid min-h-80 place-items-center p-4 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <div class="mx-auto grid size-12 place-items-center rounded-2xl bg-primary-50 text-primary-600 ring-1 ring-primary-600/10 dark:bg-primary-400/10 dark:text-primary-300 dark:ring-primary-400/20">
                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-semibold text-slate-950 dark:text-white">Keine Seite ausgewählt</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Erstelle links den ersten Menüpunkt, um Einstellungen zu bearbeiten.</p>
                        </div>
                    </div>
                </div>
            @else
                <form wire:submit="saveSelectedMenuItem" class="p-4 grid grid-cols-1 gap-4">
                    <div class="grid gap-4 lg:grid-cols-2">
                        <label for="menu-item-label" class="space-y-2">
                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-1">Titel</span>
                            <x-filament::input.wrapper
                                :valid="! $errors->has('form.label')"
                                x-on:focus-input.stop="$el.querySelector('input')?.focus()"
                            >
                                <x-filament::input
                                    id="menu-item-label"
                                    type="text"
                                    wire:model.live.debounce.400ms="form.label"
                                />
                            </x-filament::input.wrapper>
                            @error('form.label')
                                <span class="text-sm text-danger-600 dark:text-danger-400">{{ $message }}</span>
                            @enderror
                        </label>

                        <label for="menu-item-parent-id" class="space-y-2">
                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-1">Elternseite</span>
                            <x-filament::input.wrapper
                                :valid="! $errors->has('form.parent_id')"
                                class="fi-fo-select fi-fo-select-native"
                                x-on:focus-input.stop="$el.querySelector('select')?.focus()"
                            >
                                <x-filament::input.select
                                    id="menu-item-parent-id"
                                    wire:model="form.parent_id"
                                >
                                    <option value="">Root-Ebene</option>
                                    @foreach ($parentOptions as $parentOptionId => $parentOptionLabel)
                                        <option value="{{ $parentOptionId }}">{{ $parentOptionLabel }}</option>
                                    @endforeach
                                </x-filament::input.select>
                            </x-filament::input.wrapper>
                            @error('form.parent_id')
                                <span class="text-sm text-danger-600 dark:text-danger-400">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="grid gap-4 lg:grid-cols-[1fr_auto] lg:items-end">
                        <label for="menu-item-slug" class="space-y-2">
                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-1">Slug</span>
                            <x-filament::input.wrapper
                                :valid="! $errors->has('form.slug')"
                                x-on:focus-input.stop="$el.querySelector('input')?.focus()"
                            >
                                <x-filament::input
                                    id="menu-item-slug"
                                    type="text"
                                    wire:model.blur="form.slug"
                                    class="font-[Fira_Code]"
                                />
                            </x-filament::input.wrapper>
                            @error('form.slug')
                                <span class="text-sm text-danger-600 dark:text-danger-400">{{ $message }}</span>
                            @enderror
                        </label>

                        <button
                            type="button"
                            wire:click="regenerateSlug"
                            class="inline-flex cursor-pointer items-center justify-center rounded-xl px-3 py-2 text-sm font-semibold text-primary-700 ring-1 ring-primary-600/20 transition-colors duration-200 hover:bg-primary-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 data-loading:pointer-events-none data-loading:opacity-60 motion-reduce:transition-none dark:text-primary-300 dark:ring-primary-400/30 dark:hover:bg-primary-400/10 dark:focus-visible:ring-offset-gray-950"
                        >
                            Slug neu
                        </button>
                    </div>

                    <div class="grid gap-4 lg:grid-cols-[1fr_auto] lg:items-end">
                        <label for="menu-item-route-name" class="space-y-2">
                            <span class="mb-1 flex items-center gap-2 text-sm font-semibold text-slate-800 dark:text-slate-100">
                                Route-Name
                                <span class="group relative inline-flex items-center">
                                    <button
                                        type="button"
                                        class="grid size-5 cursor-help place-items-center text-primary-600 transition duration-200 hover:scale-110 hover:text-primary-500 focus-visible:outline-none focus-visible:text-primary-500 motion-reduce:transition-none dark:text-primary-300 dark:hover:text-primary-200 dark:focus-visible:text-primary-200"
                                        aria-describedby="menu-item-route-name-help"
                                    >
                                        <svg class="size-4.5 drop-shadow-sm" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0ZM9 8a1 1 0 1 0 2 0 1 1 0 0 0-2 0Zm.25 3.25a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <span
                                        id="menu-item-route-name-help"
                                        role="tooltip"
                                        class="pointer-events-none absolute left-full top-1/2 z-50 ml-2 w-max max-w-64 -translate-y-1/2 rounded-lg bg-slate-950 px-3 py-2 text-xs font-normal leading-5 text-white opacity-0 shadow-lg ring-1 ring-white/10 transition-opacity duration-200 group-hover:opacity-100 group-focus-within:opacity-100 motion-reduce:transition-none dark:bg-white dark:text-slate-950 dark:ring-slate-950/10"
                                    >
                                        Leer lassen, um den Namen aus dem Titel zu erzeugen.
                                    </span>
                                </span>
                            </span>
                            <x-filament::input.wrapper
                                :valid="! $errors->has('form.route_name')"
                                x-on:focus-input.stop="$el.querySelector('input')?.focus()"
                            >
                                <x-filament::input
                                    id="menu-item-route-name"
                                    type="text"
                                    wire:model.blur="form.route_name"
                                    placeholder="pages.about"
                                    class="font-[Fira_Code]"
                                />
                            </x-filament::input.wrapper>
                            @error('form.route_name')
                                <span class="text-sm text-danger-600 dark:text-danger-400">{{ $message }}</span>
                            @enderror
                        </label>

                        <button
                            type="button"
                            wire:click="regenerateRouteName"
                            class="inline-flex cursor-pointer items-center justify-center rounded-xl px-3 py-2 text-sm font-semibold text-primary-700 ring-1 ring-primary-600/20 transition-colors duration-200 hover:bg-primary-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 data-loading:pointer-events-none data-loading:opacity-60 motion-reduce:transition-none dark:text-primary-300 dark:ring-primary-400/30 dark:hover:bg-primary-400/10 dark:focus-visible:ring-offset-gray-950"
                        >
                            Route neu
                        </button>
                    </div>

                    <label for="menu-item-view" class="space-y-2">
                        <span class="text-sm font-semibold text-slate-800 dark:text-slate-100 mb-1">Blade View</span>
                        <x-filament::input.wrapper
                            :valid="! $errors->has('form.view')"
                            x-on:focus-input.stop="$el.querySelector('input')?.focus()"
                        >
                            <x-filament::input
                                id="menu-item-view"
                                type="text"
                                wire:model.blur="form.view"
                                placeholder="pages.about oder blog::pages.index"
                                class="font-[Fira_Code]"
                            />
                        </x-filament::input.wrapper>
                        <span class="block text-xs text-slate-500 dark:text-slate-400">Der gespeicherte Wert muss auf eine vorhandene Blade View zeigen.</span>
                        @error('form.view')
                            <span class="text-sm text-danger-600 dark:text-danger-400">{{ $message }}</span>
                        @enderror
                    </label>

                    <label for="menu-item-is-active" class="flex cursor-pointer items-center justify-between gap-4 rounded-xl bg-white p-4 ring-1 ring-slate-200 transition-colors duration-200 hover:bg-slate-100 dark:bg-white/[0.03] dark:ring-white/10 dark:hover:bg-white/[0.06] motion-reduce:transition-none">
                        <span class="space-y-1">
                            <span class="block text-sm font-semibold text-slate-800 dark:text-slate-100">Aktiv im Menü anzeigen</span>
                            <span class="block text-xs text-slate-500 dark:text-slate-400">Inaktive Seiten bleiben im Baum sichtbar, aber markiert.</span>
                        </span>
                        <x-filament::input.checkbox
                            id="menu-item-is-active"
                            wire:model="form.is_active"
                        />
                    </label>

                    <div class="flex flex-wrap items-center justify-between gap-4 pt-4 dark:border-white/10">
                        <div class="flex flex-wrap gap-4">
                            <button
                                type="submit"
                                class="inline-flex cursor-pointer items-center gap-2 rounded-xl bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm shadow-primary-600/20 transition-colors duration-200 hover:bg-primary-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 data-loading:pointer-events-none data-loading:opacity-60 motion-reduce:transition-none dark:focus-visible:ring-offset-gray-950"
                            >
                                <span wire:loading.remove wire:target="saveSelectedMenuItem">Speichern</span>
                                <span wire:loading wire:target="saveSelectedMenuItem">Speichert...</span>
                            </button>

                            <button
                                type="button"
                                wire:click="createChildItem"
                                class="inline-flex cursor-pointer items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 transition-colors duration-200 hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 data-loading:pointer-events-none data-loading:opacity-60 motion-reduce:transition-none dark:text-slate-200 dark:ring-white/10 dark:hover:bg-white/5 dark:focus-visible:ring-offset-gray-950"
                            >
                                Unterseite hinzufügen
                            </button>
                        </div>

                        <button
                            type="button"
                            wire:click="deleteSelectedMenuItem"
                            wire:confirm="Diesen Menüpunkt inklusive Unterseiten löschen?"
                            class="inline-flex cursor-pointer items-center rounded-xl px-3 py-2 text-sm font-semibold text-danger-700 ring-1 ring-danger-600/20 transition-colors duration-200 hover:bg-danger-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-danger-500 focus-visible:ring-offset-2 data-loading:pointer-events-none data-loading:opacity-60 motion-reduce:transition-none dark:text-danger-300 dark:ring-danger-400/30 dark:hover:bg-danger-400/10 dark:focus-visible:ring-offset-gray-950"
                        >
                            Löschen
                        </button>
                    </div>
                </form>
            @endif
        </section>
    </div>
</div>
