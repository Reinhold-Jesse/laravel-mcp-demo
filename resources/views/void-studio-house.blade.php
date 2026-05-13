<!DOCTYPE html>
<html lang="de" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="Void Studio entwickelt individuelle Webplattformen, Unternehmenswebseiten, KI-Agenten und skalierbare Software für ambitionierte Teams."
        >
        <meta property="og:title" content="Void Studio – Software, Web & KI">
        <meta property="og:description" content="Premium Digital Engineering aus einer Hand: Plattformen, Websites und intelligente Agenten.">
        <meta property="og:type" content="website">
        <title>Void Studio – Software, Web &amp; KI für ambitionierte Unternehmen</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
            href="https://fonts.bunny.net/css?family=dm-sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=syne:wght@500;600;700;800"
            rel="stylesheet"
        >
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </head>
    <body
        class="relative min-h-screen overflow-x-hidden bg-zinc-950 font-[family-name:var(--font-dm-sans),ui-sans-serif,system-ui,sans-serif] text-zinc-100 antialiased selection:bg-violet-500/40 selection:text-white"
        style="--font-dm-sans: 'DM Sans'; --font-syne: 'Syne'"
    >
        <div class="pointer-events-none fixed inset-0 -z-10">
            <div
                class="absolute -left-1/4 top-0 h-[42rem] w-[42rem] rounded-full bg-cyan-500/15 blur-[120px] motion-safe:animate-pulse motion-reduce:animate-none"
                style="animation-duration: 8s"
            ></div>
            <div
                class="absolute -right-1/4 top-1/3 h-[36rem] w-[36rem] rounded-full bg-violet-600/20 blur-[100px] motion-safe:animate-pulse motion-reduce:animate-none"
                style="animation-duration: 11s"
            ></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(120,119,198,0.22),transparent)]"></div>
        </div>

        <header
            class="fixed inset-x-0 top-0 z-50 border-b border-white/5 bg-zinc-950/70 backdrop-blur-xl backdrop-saturate-150"
            x-data="{ mobile: false }"
            @keydown.escape.window="mobile = false"
        >
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-4 sm:px-6 lg:px-8">
                <a href="#hero" class="group flex items-center gap-2">
                    <span
                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-sm font-bold tracking-tight text-white shadow-[0_0_24px_-4px_rgba(139,92,246,0.55)] transition group-hover:border-violet-400/40 group-hover:shadow-[0_0_32px_-2px_rgba(34,211,238,0.35)]"
                        style="font-family: Syne, sans-serif"
                    >V</span>
                    <span class="text-sm font-semibold tracking-tight text-white" style="font-family: Syne, sans-serif">Void Studio</span>
                </a>
                <nav class="hidden items-center gap-8 text-sm font-medium text-zinc-400 md:flex" aria-label="Hauptnavigation">
                    <a href="#leistungen" class="transition hover:text-white">Leistungen</a>
                    <a href="#ki" class="transition hover:text-white">KI-Agenten</a>
                    <a href="#portfolio" class="transition hover:text-white">Projekte</a>
                    <a href="#warum" class="transition hover:text-white">Warum wir</a>
                    <a href="#stimmen" class="transition hover:text-white">Referenzen</a>
                    <a href="#kontakt" class="transition hover:text-white">Kontakt</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a
                        href="#kontakt"
                        class="hidden rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:border-cyan-400/30 hover:bg-white/10 md:inline-flex"
                    >
                        Projekt starten
                    </a>
                    <button
                        type="button"
                        class="inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 p-2 text-zinc-300 md:hidden"
                        @click="mobile = !mobile"
                        :aria-expanded="mobile"
                        aria-controls="mobile-nav"
                    >
                        <span class="sr-only">Menü</span>
                        <svg x-show="!mobile" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-cloak x-show="mobile" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div
                id="mobile-nav"
                x-cloak
                x-show="mobile"
                x-transition.opacity.duration.200ms
                class="border-t border-white/5 bg-zinc-950/95 px-4 py-4 md:hidden"
            >
                <div class="flex flex-col gap-3 text-sm font-medium text-zinc-300">
                    <a href="#leistungen" @click="mobile = false" class="py-2">Leistungen</a>
                    <a href="#ki" @click="mobile = false" class="py-2">KI-Agenten</a>
                    <a href="#portfolio" @click="mobile = false" class="py-2">Projekte</a>
                    <a href="#warum" @click="mobile = false" class="py-2">Warum wir</a>
                    <a href="#stimmen" @click="mobile = false" class="py-2">Referenzen</a>
                    <a href="#kontakt" @click="mobile = false" class="py-2 text-cyan-300">Kontakt</a>
                </div>
            </div>
        </header>

        <main>
            {{-- Hero --}}
            <section id="hero" class="relative px-4 pb-24 pt-32 sm:px-6 sm:pt-40 lg:px-8 lg:pb-32">
                <div class="mx-auto max-w-7xl">
                    <div class="max-w-3xl">
                        <p
                            class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium uppercase tracking-widest text-zinc-400 backdrop-blur-md"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-400 shadow-[0_0_12px_2px_rgba(34,211,238,0.6)]"></span>
                            Digital Engineering · München
                        </p>
                        <h1
                            class="text-4xl font-semibold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl"
                            style="font-family: Syne, sans-serif"
                        >
                            Software, die
                            <span class="bg-gradient-to-r from-cyan-300 via-violet-300 to-fuchsia-400 bg-clip-text text-transparent">mitdenkt.</span>
                        </h1>
                        <p class="mt-6 max-w-xl text-lg leading-relaxed text-zinc-400">
                            Void Studio baut individuelle Webplattformen, markenstarke Unternehmenswebseiten und KI-Agenten, die echte Arbeit abnehmen – skalierbar,
                            sicher und ready für Wachstum.
                        </p>
                        <div class="mt-10 flex flex-wrap items-center gap-4">
                            <a
                                href="#kontakt"
                                class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-violet-600 px-8 py-3.5 text-sm font-semibold text-white shadow-[0_0_40px_-8px_rgba(139,92,246,0.65)] transition hover:scale-[1.02] hover:shadow-[0_0_48px_-4px_rgba(34,211,238,0.45)] active:scale-[0.98]"
                            >
                                Beratungstermin
                                <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a
                                href="#portfolio"
                                class="inline-flex items-center justify-center rounded-full border border-white/15 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white backdrop-blur-md transition hover:border-white/25 hover:bg-white/10"
                            >
                                Case Studies
                            </a>
                        </div>
                        <dl class="mt-16 grid grid-cols-2 gap-6 border-t border-white/10 pt-10 sm:grid-cols-4">
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-zinc-500">Delivery</dt>
                                <dd class="mt-1 text-2xl font-semibold text-white" style="font-family: Syne, sans-serif">14–90</dd>
                                <dd class="text-xs text-zinc-500">Tage bis MVP</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-zinc-500">Uptime</dt>
                                <dd class="mt-1 text-2xl font-semibold text-white" style="font-family: Syne, sans-serif">99.99%</dd>
                                <dd class="text-xs text-zinc-500">SLA-fähig</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-zinc-500">Teams</dt>
                                <dd class="mt-1 text-2xl font-semibold text-white" style="font-family: Syne, sans-serif">24+</dd>
                                <dd class="text-xs text-zinc-500">aktive Mandate</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-zinc-500">Stack</dt>
                                <dd class="mt-1 text-2xl font-semibold text-white" style="font-family: Syne, sans-serif">Edge</dd>
                                <dd class="text-xs text-zinc-500">ready</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>

            {{-- Services --}}
            <section
                id="leistungen"
                x-data="reveal"
                x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                class="border-t border-white/5 px-4 py-24 transition duration-700 ease-out motion-reduce:translate-y-0 motion-reduce:opacity-100 sm:px-6 lg:px-8"
            >
                <div class="mx-auto max-w-7xl">
                    <div class="max-w-2xl">
                        <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">Leistungen</h2>
                        <p class="mt-4 text-lg text-zinc-400">
                            Von der ersten Architektur-Skizze bis zum Go-Live – modular aufgebaut, damit Sie heute starten und morgen skalieren können.
                        </p>
                    </div>
                    <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ([
                            ['title' => 'Webplattformen', 'body' => 'Multi-Tenant SaaS, Portale und interne Tools mit rollenbasierter Logik, APIs und Observability.', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                            ['title' => 'Corporate Web', 'body' => 'Story-driven Sites mit Performance-Budget, Design System und redaktioneller Freiheit im CMS.', 'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'],
                            ['title' => 'KI & Agenten', 'body' => 'RAG-Pipelines, Tool-Calling, Guardrails und Human-in-the-Loop – produktionsreif statt Demo.', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ['title' => 'Skalierung', 'body' => 'Queues, Events, Caching und Cloud-Native Deployments – damit Traffic kein Drama wird.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ] as $card)
                            <article
                                class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 shadow-xl backdrop-blur-md transition hover:border-cyan-400/25 hover:bg-white/[0.06]"
                            >
                                <div
                                    class="mb-4 inline-flex rounded-lg border border-white/10 bg-gradient-to-br from-cyan-500/20 to-violet-600/20 p-2.5 text-cyan-200 transition group-hover:from-cyan-400/30 group-hover:to-violet-500/30"
                                >
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-white" style="font-family: Syne, sans-serif">{{ $card['title'] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-zinc-400">{{ $card['body'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- KI-Agenten --}}
            <section
                id="ki"
                x-data="reveal"
                x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                class="border-t border-white/5 px-4 py-24 transition duration-700 ease-out motion-reduce:translate-y-0 motion-reduce:opacity-100 sm:px-6 lg:px-8"
            >
                <div class="mx-auto max-w-7xl">
                    <div class="flex flex-col gap-10 lg:flex-row lg:items-end lg:justify-between">
                        <div class="max-w-2xl">
                            <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">KI-Agenten Showcase</h2>
                            <p class="mt-4 text-lg text-zinc-400">
                                Agentische Workflows mit klaren Policies: Ihre Daten bleiben in Ihrer Kontrolle – von Retrieval über Aktionen bis zur Nachvollziehbarkeit im Audit-Log.
                            </p>
                        </div>
                        <p class="text-sm text-zinc-500">Model-agnostic · EU-Hosting · DSGVO-konforme Defaults</p>
                    </div>
                    <div class="mt-14 grid gap-6 lg:grid-cols-3">
                        <article
                            class="relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/[0.07] to-transparent p-8 backdrop-blur-xl"
                        >
                            <div class="text-xs font-semibold uppercase tracking-widest text-cyan-300/90">Support Copilot</div>
                            <h3 class="mt-3 text-xl font-semibold text-white" style="font-family: Syne, sans-serif">L1 → L2 in Sekunden</h3>
                            <p class="mt-3 text-sm leading-relaxed text-zinc-400">
                                Versteht Tickets, schlägt Antworten vor und führt definierte Tools aus – nur mit Freigabe Ihres Teams.
                            </p>
                            <ul class="mt-6 space-y-2 text-sm text-zinc-300">
                                <li class="flex gap-2"><span class="text-cyan-400">▹</span> Zendesk / Linear / Custom API</li>
                                <li class="flex gap-2"><span class="text-cyan-400">▹</span> Zitierte Quellen pro Antwort</li>
                            </ul>
                        </article>
                        <article
                            class="relative overflow-hidden rounded-2xl border border-violet-500/30 bg-violet-950/20 p-8 shadow-[0_0_60px_-20px_rgba(139,92,246,0.45)] backdrop-blur-xl"
                        >
                            <div class="text-xs font-semibold uppercase tracking-widest text-violet-300/90">Research Agent</div>
                            <h3 class="mt-3 text-xl font-semibold text-white" style="font-family: Syne, sans-serif">Due Diligence on demand</h3>
                            <p class="mt-3 text-sm leading-relaxed text-zinc-400">
                                Crawlt erlaubte Quellen, strukturiert Fakten und liefert Executive Summaries – ideal für M&amp;A und Produktteams.
                            </p>
                            <ul class="mt-6 space-y-2 text-sm text-zinc-300">
                                <li class="flex gap-2"><span class="text-violet-400">▹</span> Chunking + Vektorsuche</li>
                                <li class="flex gap-2"><span class="text-violet-400">▹</span> Export als PDF / Notion</li>
                            </ul>
                        </article>
                        <article
                            class="relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-8 backdrop-blur-xl"
                        >
                            <div class="text-xs font-semibold uppercase tracking-widest text-fuchsia-300/90">Ops Orchestrator</div>
                            <h3 class="mt-3 text-xl font-semibold text-white" style="font-family: Syne, sans-serif">Runbooks, automatisiert</h3>
                            <p class="mt-3 text-sm leading-relaxed text-zinc-400">
                                Überwacht Deployments, öffnet Incidents und koordiniert Eskalationen – mit menschlichem Kill-Switch.
                            </p>
                            <ul class="mt-6 space-y-2 text-sm text-zinc-300">
                                <li class="flex gap-2"><span class="text-fuchsia-400">▹</span> PagerDuty / Slack / Teams</li>
                                <li class="flex gap-2"><span class="text-fuchsia-400">▹</span> Rollback-Playbooks</li>
                            </ul>
                        </article>
                    </div>
                </div>
            </section>

            {{-- Portfolio --}}
            <section
                id="portfolio"
                x-data="reveal"
                x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                class="border-t border-white/5 px-4 py-24 transition duration-700 ease-out motion-reduce:translate-y-0 motion-reduce:opacity-100 sm:px-6 lg:px-8"
            >
                <div class="mx-auto max-w-7xl">
                    <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">Ausgewählte Projekte</h2>
                    <p class="mt-4 max-w-2xl text-lg text-zinc-400">
                        Ein Querschnitt durch B2B-Plattformen und High-Performance Marketing Sites – anonymisiert, wo es sein muss.
                    </p>
                    <div class="mt-14 grid gap-6 lg:grid-cols-3">
                        @foreach ([
                            ['k' => 'FinCloud One', 't' => 'Multi-Mandanten-Portal für Vermögensverwalter', 's' => 'Laravel · Livewire · Postgres', 'y' => '2025'],
                            ['k' => 'Nordlicht Health', 't' => 'Patienten-Onboarding &amp; Terminlogik unter strengen Compliance-Vorgaben', 's' => 'API-first · Audit Trail', 'y' => '2024'],
                            ['k' => 'Atlas Robotics', 't' => 'Marketing Site mit 3D-Storytelling und Lead-Routing in HubSpot', 's' => 'Edge CDN · A/B', 'y' => '2024'],
                        ] as $p)
                            <article
                                class="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] backdrop-blur-md transition hover:border-cyan-400/20"
                            >
                                <div class="aspect-[16/10] bg-gradient-to-br from-zinc-800 to-zinc-950 p-6">
                                    <span class="text-xs font-medium text-cyan-300/80">{{ $p['y'] }}</span>
                                    <p class="mt-4 text-lg font-semibold text-white" style="font-family: Syne, sans-serif">{{ $p['k'] }}</p>
                                </div>
                                <div class="flex flex-1 flex-col p-6">
                                    <p class="text-sm leading-relaxed text-zinc-400">{!! $p['t'] !!}</p>
                                    <p class="mt-4 text-xs font-medium uppercase tracking-wider text-zinc-500">{{ $p['s'] }}</p>
                                    <span
                                        class="mt-6 inline-flex items-center text-sm font-medium text-cyan-300 transition group-hover:gap-2"
                                    >
                                        Ansehen
                                        <svg class="ml-1 h-4 w-4 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Warum Void Studio --}}
            <section
                id="warum"
                x-data="reveal"
                x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                class="border-t border-white/5 px-4 py-24 transition duration-700 ease-out motion-reduce:translate-y-0 motion-reduce:opacity-100 sm:px-6 lg:px-8"
            >
                <div class="mx-auto max-w-7xl">
                    <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">
                        <div>
                            <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">Warum Void Studio</h2>
                            <p class="mt-4 text-lg text-zinc-400">
                                Wir kombinieren Produkt-Denken mit Engineering-Disziplin. Weniger Slides, mehr lauffähige Software – in Iterationen, die Ihr Budget respektieren.
                            </p>
                            <ul class="mt-10 space-y-4 text-zinc-300">
                                <li class="flex gap-3">
                                    <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-cyan-500/20 text-cyan-300">✓</span>
                                    <span><strong class="text-white">Senior-only Teams</strong> – keine Junior-Besetzung hinter verschlossenen Türen.</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-violet-500/20 text-violet-300">✓</span>
                                    <span><strong class="text-white">Messbare UX</strong> – Core Web Vitals, Konversion und Task-Completion als KPIs.</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-fuchsia-500/20 text-fuchsia-300">✓</span>
                                    <span><strong class="text-white">Langfristige Betreuung</strong> – Release-Train, Security-Patches und Feature-Roadmap.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-md">
                                <p class="text-4xl font-semibold text-white" style="font-family: Syne, sans-serif">+38%</p>
                                <p class="mt-2 text-sm text-zinc-400">Ø Steigerung qualifizierter Leads nach Relaunch (B2B SaaS, n=6)</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-md">
                                <p class="text-4xl font-semibold text-white" style="font-family: Syne, sans-serif">&lt;200ms</p>
                                <p class="mt-2 text-sm text-zinc-400">p95 API-Latenz nach Caching- &amp; Query-Tuning</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-md sm:col-span-2">
                                <p class="text-4xl font-semibold text-white" style="font-family: Syne, sans-serif">100%</p>
                                <p class="mt-2 text-sm text-zinc-400">Code-Review &amp; automatisierte Tests auf jedem Merge – ohne Ausreden.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Testimonials --}}
            <section
                id="stimmen"
                class="border-t border-white/5 px-4 py-24 sm:px-6 lg:px-8"
                x-data="{
                    i: 0,
                    items: [
                        { q: 'Void Studio hat unser Legacy-Portal in zwölf Wochen ersetzt – inklusive SSO und Mandantenfähigkeit. Die Kommunikation war auf CTO-Niveau.', a: 'Dr. Elena Vogt', r: 'CTO, Logistik-Scale-up' },
                        { q: 'Die KI-Agenten-Pipeline spart unserem Support-Team rund 120 Stunden pro Monat. Besonders wichtig: nachvollziehbare Quellen.', a: 'Marcus Weiß', r: 'Head of CX, Fintech' },
                        { q: 'Design und Performance fühlen sich an wie ein großes Produkt – nicht wie eine Agentur-Landingpage. Genau das wollten wir.', a: 'Sofia Araya', r: 'CMO, Healthtech' },
                    ],
                    next() { this.i = (this.i + 1) % this.items.length },
                    prev() { this.i = (this.i - 1 + this.items.length) % this.items.length },
                }"
            >
                <div class="mx-auto max-w-7xl">
                    <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">Kundenstimmen</h2>
                    <p class="mt-4 max-w-2xl text-lg text-zinc-400">Was Teams sagen, die mit uns skalieren – von Pilot bis Produktion.</p>
                    <div class="relative mx-auto mt-14 max-w-3xl">
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.04] p-8 backdrop-blur-xl sm:p-10">
                            <template x-for="(item, idx) in items" :key="idx">
                                <blockquote
                                    x-show="i === idx"
                                    x-transition.opacity.duration.300ms
                                    class="text-center"
                                >
                                    <p class="text-lg leading-relaxed text-zinc-200 sm:text-xl" x-text="item.q"></p>
                                    <footer class="mt-8">
                                        <cite class="not-italic">
                                            <span class="block font-semibold text-white" x-text="item.a"></span>
                                            <span class="mt-1 block text-sm text-zinc-500" x-text="item.r"></span>
                                        </cite>
                                    </footer>
                                </blockquote>
                            </template>
                        </div>
                        <div class="mt-6 flex items-center justify-center gap-4">
                            <button
                                type="button"
                                class="rounded-full border border-white/10 bg-white/5 p-2 text-zinc-300 transition hover:border-cyan-400/30 hover:text-white"
                                @click="prev()"
                                aria-label="Vorheriges Zitat"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                            <div class="flex gap-1.5">
                                <template x-for="(item, idx) in items" :key="'dot'+idx">
                                    <button
                                        type="button"
                                        class="h-2 rounded-full transition-all"
                                        :class="i === idx ? 'w-8 bg-cyan-400' : 'w-2 bg-zinc-600 hover:bg-zinc-500'"
                                        @click="i = idx"
                                        :aria-label="'Zitat ' + (idx+1)"
                                    ></button>
                                </template>
                            </div>
                            <button
                                type="button"
                                class="rounded-full border border-white/10 bg-white/5 p-2 text-zinc-300 transition hover:border-cyan-400/30 hover:text-white"
                                @click="next()"
                                aria-label="Nächstes Zitat"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CTA --}}
            <section id="cta" class="border-t border-white/5 px-4 py-20 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-5xl overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-cyan-600/25 via-violet-600/20 to-fuchsia-600/15 p-px shadow-[0_0_80px_-24px_rgba(34,211,238,0.35)]">
                    <div class="rounded-[calc(1.5rem-1px)] bg-zinc-950/90 px-8 py-14 text-center backdrop-blur-xl sm:px-14">
                        <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">Bereit für die nächste Version Ihres Produkts?</h2>
                        <p class="mx-auto mt-4 max-w-xl text-zinc-400">
                            In einem 30-minütigen Discovery-Call klären wir Scope, Risiken und Timeline – transparent und ohne Verkaufsdruck.
                        </p>
                        <a
                            href="#kontakt"
                            class="mt-10 inline-flex items-center justify-center rounded-full bg-white px-8 py-3.5 text-sm font-semibold text-zinc-950 shadow-lg transition hover:bg-zinc-100"
                        >
                            Slot sichern
                        </a>
                    </div>
                </div>
            </section>

            {{-- Kontakt --}}
            <section id="kontakt" class="border-t border-white/5 px-4 py-24 sm:px-6 lg:px-8">
                <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-2 lg:gap-20">
                    <div>
                        <h2 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl" style="font-family: Syne, sans-serif">Kontakt</h2>
                        <p class="mt-4 text-lg text-zinc-400">
                            Schreiben Sie uns Ihr Vorhaben – wir melden uns werktags innerhalb von 24 Stunden.
                        </p>
                        <address class="mt-10 not-italic text-zinc-400">
                            <p class="font-medium text-white">Void Studio GmbH</p>
                            <p class="mt-2">Sendlinger Straße 12<br>80331 München</p>
                            <p class="mt-4">
                                <a href="mailto:hello@void.studio" class="text-cyan-300 transition hover:text-cyan-200">hello@void.studio</a>
                            </p>
                            <p class="mt-1">
                                <a href="tel:+4989123456789" class="transition hover:text-white">+49 89 123 456 789</a>
                            </p>
                        </address>
                    </div>
                    <div
                        class="rounded-2xl border border-white/10 bg-white/[0.03] p-6 backdrop-blur-md sm:p-8"
                        x-data="{ sent: false, loading: false }"
                    >
                        <form
                            class="space-y-5"
                            @submit.prevent="loading = true; setTimeout(() => { sent = true; loading = false; $el.reset() }, 900)"
                        >
                            <div x-show="sent" x-transition class="rounded-xl border border-cyan-500/30 bg-cyan-500/10 px-4 py-3 text-sm text-cyan-100">
                                Danke – wir haben Ihre Nachricht erhalten und melden uns zeitnah.
                            </div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="vs-name" class="block text-xs font-medium uppercase tracking-wider text-zinc-500">Name</label>
                                    <input
                                        id="vs-name"
                                        name="name"
                                        type="text"
                                        required
                                        autocomplete="name"
                                        class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/80 px-4 py-3 text-sm text-white outline-none ring-cyan-500/40 transition placeholder:text-zinc-600 focus:border-cyan-400/40 focus:ring-2"
                                        placeholder="Alex Muster"
                                    >
                                </div>
                                <div>
                                    <label for="vs-email" class="block text-xs font-medium uppercase tracking-wider text-zinc-500">E-Mail</label>
                                    <input
                                        id="vs-email"
                                        name="email"
                                        type="email"
                                        required
                                        autocomplete="email"
                                        class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/80 px-4 py-3 text-sm text-white outline-none ring-cyan-500/40 transition placeholder:text-zinc-600 focus:border-cyan-400/40 focus:ring-2"
                                        placeholder="alex@unternehmen.de"
                                    >
                                </div>
                            </div>
                            <div>
                                <label for="vs-company" class="block text-xs font-medium uppercase tracking-wider text-zinc-500">Unternehmen</label>
                                <input
                                    id="vs-company"
                                    name="company"
                                    type="text"
                                    autocomplete="organization"
                                    class="mt-2 w-full rounded-xl border border-white/10 bg-zinc-900/80 px-4 py-3 text-sm text-white outline-none ring-cyan-500/40 transition placeholder:text-zinc-600 focus:border-cyan-400/40 focus:ring-2"
                                    placeholder="Muster GmbH"
                                >
                            </div>
                            <div>
                                <label for="vs-msg" class="block text-xs font-medium uppercase tracking-wider text-zinc-500">Nachricht</label>
                                <textarea
                                    id="vs-msg"
                                    name="message"
                                    rows="4"
                                    required
                                    class="mt-2 w-full resize-y rounded-xl border border-white/10 bg-zinc-900/80 px-4 py-3 text-sm text-white outline-none ring-cyan-500/40 transition placeholder:text-zinc-600 focus:border-cyan-400/40 focus:ring-2"
                                    placeholder="Kurz zu Ziel, Zeitrahmen und Tech-Stack …"
                                ></textarea>
                            </div>
                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-violet-600 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:opacity-95 disabled:cursor-wait disabled:opacity-70 sm:w-auto sm:px-10"
                                :disabled="loading"
                            >
                                <span x-show="!loading">Anfrage senden</span>
                                <span x-show="loading" x-cloak>Wird gesendet …</span>
                            </button>
                            <p class="text-xs text-zinc-600">Mit Absenden stimmen Sie der kontextbezogenen Verarbeitung Ihrer Angaben zu (Demo-Formular ohne Backend).</p>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-white/5 bg-zinc-950/80 px-4 py-14 sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-10 md:flex-row md:items-start md:justify-between">
                <div>
                    <p class="text-sm font-semibold text-white" style="font-family: Syne, sans-serif">Void Studio</p>
                    <p class="mt-3 max-w-xs text-sm text-zinc-500">Premium Software Engineering für Teams, die Tempo und Qualität gleichzeitig brauchen.</p>
                </div>
                <div class="grid grid-cols-2 gap-10 sm:grid-cols-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Studio</p>
                        <ul class="mt-3 space-y-2 text-sm text-zinc-400">
                            <li><a href="#leistungen" class="transition hover:text-white">Leistungen</a></li>
                            <li><a href="#portfolio" class="transition hover:text-white">Projekte</a></li>
                            <li><a href="#kontakt" class="transition hover:text-white">Kontakt</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Legal</p>
                        <ul class="mt-3 space-y-2 text-sm text-zinc-400">
                            <li><a href="#" class="transition hover:text-white">Impressum</a></li>
                            <li><a href="#" class="transition hover:text-white">Datenschutz</a></li>
                            <li><a href="#" class="transition hover:text-white">AGB</a></li>
                        </ul>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Social</p>
                        <ul class="mt-3 flex gap-4 text-sm text-zinc-400">
                            <li><a href="#" class="transition hover:text-white" aria-label="LinkedIn">in</a></li>
                            <li><a href="#" class="transition hover:text-white" aria-label="GitHub">gh</a></li>
                            <li><a href="#" class="transition hover:text-white" aria-label="X">X</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="mx-auto mt-12 max-w-7xl border-t border-white/5 pt-8 text-center text-xs text-zinc-600">
                © {{ date('Y') }} Void Studio GmbH · Crafted with Präzision in München
            </p>
        </footer>
    </body>
</html>
