<nav class="rounded-2xl border border-slate-200 bg-white/90 p-3 shadow-sm backdrop-blur dark:border-white/10 dark:bg-gray-950/90" aria-label="Hauptnavigation">
    <ul class="flex flex-wrap items-center gap-2">
        @foreach ($menuTree as $item)
            <li wire:key="menu-navigation-item-{{ $item['id'] }}" class="group relative">
                <a
                    href="{{ $this->urlFor($item['slug'], $item['route_name']) }}"
                    class="inline-flex min-h-10 cursor-pointer items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 motion-reduce:transition-none dark:text-slate-200 dark:hover:bg-primary-400/10 dark:hover:text-primary-200"
                >
                    {{ $item['label'] }}

                    @if ($item['children'] !== [])
                        <svg class="size-4 text-slate-400 transition-transform duration-200 group-hover:rotate-180 motion-reduce:transition-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 7.22a.75.75 0 0 1 1.06 0L10 10.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 8.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </a>

                @if ($item['children'] !== [])
                    <div class="invisible absolute left-0 top-full z-20 min-w-64 translate-y-2 pt-2 opacity-0 transition duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100 motion-reduce:transition-none">
                        <ul class="rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-950/10 dark:border-white/10 dark:bg-gray-950">
                            @foreach ($item['children'] as $child)
                                <li wire:key="menu-navigation-child-{{ $child['id'] }}">
                                    <a
                                        href="{{ $this->urlFor($child['slug'], $child['route_name']) }}"
                                        class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 motion-reduce:transition-none dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-200"
                                    >
                                        <span class="block">{{ $child['label'] }}</span>
                                        <span class="mt-0.5 block truncate font-mono text-xs text-slate-400">{{ $child['route_name'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
