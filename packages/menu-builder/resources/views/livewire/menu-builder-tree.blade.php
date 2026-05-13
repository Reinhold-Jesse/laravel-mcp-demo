<ul
    wire:sort="moveMenuItem"
    wire:sort:group="menu-items"
    wire:sort:group-id="{{ $parentId ?? 'root' }}"
    @class([
        'flex flex-col gap-4',
        'min-h-10' => $isRoot ?? false,
        'mt-4 min-h-4 border-s border-slate-200 ps-4 dark:border-white/10' => ! ($isRoot ?? false),
    ])
>
    @forelse ($items as $item)
        @php
            $hasTreeChildren = $item['children'] !== [];
        @endphp
        <li wire:key="menu-builder-item-{{ $item['id'] }}" wire:sort:item="{{ $item['id'] }}">
            <div
                @class([
                    'group flex min-w-0 items-center gap-2 rounded-xl px-2 py-2 ring-1 transition-colors duration-200 motion-reduce:transition-none',
                    'bg-primary-50 text-primary-900 ring-primary-600/25 shadow-sm dark:bg-primary-400/10 dark:text-primary-100 dark:ring-primary-400/30' => $selectedMenuItemId === $item['id'],
                    'bg-white text-slate-700 ring-slate-200 hover:bg-primary-50 hover:ring-slate-300 dark:bg-white/[0.03] dark:text-slate-200 dark:ring-white/10 dark:hover:bg-white/[0.06]' => $selectedMenuItemId !== $item['id'],
                ])
            >
                <button
                    type="button"
                    wire:sort:handle
                    class="grid size-8 shrink-0 cursor-grab place-items-center rounded-lg text-slate-400 transition-colors duration-200 hover:bg-white hover:text-slate-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 active:cursor-grabbing motion-reduce:transition-none dark:hover:bg-white/10 dark:hover:text-slate-100"
                    aria-label="Menüpunkt verschieben"
                >
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M7 4.25a1.25 1.25 0 1 1-2.5 0A1.25 1.25 0 0 1 7 4.25ZM7 10a1.25 1.25 0 1 1-2.5 0A1.25 1.25 0 0 1 7 10ZM5.75 17a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5ZM15.5 4.25a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0ZM14.25 11.25a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5ZM15.5 15.75a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0Z" />
                    </svg>
                </button>

                <div class="flex min-w-0 flex-1 items-center gap-2">
                    <button
                        type="button"
                        wire:click="selectMenuItem({{ $item['id'] }})"
                        wire:sort:ignore
                        class="min-w-0 flex-1 cursor-pointer rounded-lg px-1 text-left focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                    >
                        <span class="flex min-w-0 items-center gap-2">
                            <span class="block truncate text-sm font-semibold">{{ $item['label'] }}</span>
                        </span>
                        {{-- <span class="mt-0.5 block truncate font-[Fira_Code] text-[11px] text-slate-500 dark:text-slate-400">{{ $item['slug'] }}</span>
                        <span class="mt-0.5 block truncate font-[Fira_Code] text-[11px] text-slate-400 dark:text-slate-500">{{ $item['route_name'] }}</span> --}}
                    </button>

                    @if (! $item['is_active'])
                        <span class="shrink-0 rounded-full bg-slate-100 px-2 py-1 font-[Fira_Code] text-[10px] font-semibold uppercase tracking-wide text-slate-500 ring-1 ring-slate-200 dark:bg-white/10 dark:text-slate-300 dark:ring-white/10">
                            inaktiv
                        </span>
                    @endif
                </div>

                @if ($hasTreeChildren)
                    <button
                        type="button"
                        @click.stop="$store.menuBuilderPageTree.toggle({{ $item['id'] }})"
                        wire:sort:ignore
                        class="grid size-8 shrink-0 place-items-center rounded-lg text-slate-500 transition-colors duration-200 hover:bg-white hover:text-slate-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 motion-reduce:transition-none dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-slate-100"
                        x-bind:aria-expanded="$store.menuBuilderPageTree.open[{{ $item['id'] }}] ? 'true' : 'false'"
                        x-bind:aria-label="$store.menuBuilderPageTree.open[{{ $item['id'] }}] ? 'Unterseiten einklappen' : 'Unterseiten aufklappen'"
                    >
                        <svg
                            class="size-4 transition-transform duration-200 motion-reduce:transition-none"
                            x-bind:class="{ 'rotate-90': $store.menuBuilderPageTree.open[{{ $item['id'] }}] }"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @else
                    <span class="size-8 shrink-0" aria-hidden="true"></span>
                @endif
            </div>

            @if ($hasTreeChildren)
                <template x-if="$store.menuBuilderPageTree.open[{{ $item['id'] }}]">
                    @include('menu-builder::livewire.menu-builder-tree', [
                        'items' => $item['children'],
                        'parentId' => $item['id'],
                        'selectedMenuItemId' => $selectedMenuItemId,
                        'isRoot' => false,
                    ])
                </template>
            @endif
        </li>
    @empty
        @if ($isRoot ?? false)
            <li class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4 text-sm text-slate-500 dark:border-white/10 dark:bg-white/[0.03] dark:text-slate-400">
                Noch keine Menüpunkte vorhanden. Erstelle eine Root-Seite, um den Baum zu starten.
            </li>
        @endif
    @endforelse
</ul>
