<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#050505">
        <meta name="description" content="Void Studio entwickelt individuelle Webplattformen, maßgeschneiderte AI-Agenten und skalierbare Softwarelösungen für moderne Unternehmen.">
        <meta property="og:title" content="Void Studio — Software, AI & moderne Webplattformen">
        <meta property="og:description" content="Wir entwickeln individuelle Webplattformen, AI-Agenten und skalierbare SaaS-Lösungen für ambitionierte Unternehmen.">
        <meta property="og:type" content="website">

        <title>Void Studio — Software, AI & moderne Webplattformen</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900|jetbrains-mono:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{
            navOpen: false,
            scrolled: false,
            mouseX: 50,
            mouseY: 30,
            reduceMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        }"
        x-on:scroll.window="scrolled = window.scrollY > 24"
        x-on:mousemove.window="if (! reduceMotion) { mouseX = Math.round(($event.clientX / window.innerWidth) * 100); mouseY = Math.round(($event.clientY / window.innerHeight) * 100) }"
        class="relative min-h-screen overflow-x-hidden bg-[#050505] font-['Inter',ui-sans-serif,system-ui,sans-serif] text-zinc-100 antialiased selection:bg-violet-500/40 selection:text-white"
    >
        {{-- Ambient background layers --}}
        <div class="pointer-events-none fixed inset-0 -z-30 bg-[radial-gradient(80rem_60rem_at_12%_-10%,rgba(59,130,246,0.18),transparent_60%),radial-gradient(70rem_55rem_at_88%_10%,rgba(168,85,247,0.20),transparent_60%),radial-gradient(60rem_50rem_at_50%_120%,rgba(56,189,248,0.10),transparent_60%)]"></div>
        <div class="pointer-events-none fixed inset-0 -z-20 [background-image:linear-gradient(rgba(255,255,255,0.05)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.05)_1px,transparent_1px)] [background-size:64px_64px] [mask-image:radial-gradient(ellipse_at_center,#000_30%,transparent_75%)]"></div>
        <div class="pointer-events-none fixed inset-0 -z-10 opacity-[0.04] mix-blend-soft-light [background-image:radial-gradient(circle_at_center,#fff_1px,transparent_1px)] [background-size:3px_3px]"></div>
        <div x-bind:style="`background: radial-gradient(50rem 40rem at ${mouseX}% ${mouseY}%, rgba(99,102,241,0.18), transparent 60%)`" class="pointer-events-none fixed inset-0 -z-10 transition-[background] duration-300 motion-reduce:hidden"></div>

        {{-- ============ NAVIGATION ============ --}}
        <header
            x-bind:class="scrolled ? 'border-white/10 bg-[#050505]/80 shadow-[0_8px_40px_rgba(0,0,0,0.4)]' : 'border-transparent bg-transparent'"
            class="fixed inset-x-0 top-0 z-50 border-b backdrop-blur-xl transition-all duration-300"
            aria-label="Hauptnavigation"
            x-on:keydown.escape.window="navOpen = false"
        >
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-4 lg:px-8">
                <a href="#top" class="group flex items-center gap-2.5 outline-none" aria-label="Void Studio Startseite">
                    <span class="relative grid size-9 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 shadow-[0_0_24px_-4px_rgba(139,92,246,0.6)] ring-1 ring-white/20" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5 text-white">
                            <path d="M4 4l8 16 8-16" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="absolute inset-0 rounded-xl bg-gradient-to-br from-blue-400/40 to-violet-500/40 blur-md opacity-0 transition group-hover:opacity-100" aria-hidden="true"></span>
                    </span>
                    <span class="text-[15px] font-semibold tracking-tight">Void Studio</span>
                </a>

                <nav class="hidden items-center gap-1 rounded-full border border-white/10 bg-white/[0.03] px-1.5 py-1.5 text-[13.5px] font-medium text-zinc-300 backdrop-blur-md lg:flex" aria-label="Hauptmenü">
                    <a href="#services" class="rounded-full px-3.5 py-1.5 transition hover:bg-white/10 hover:text-white">Services</a>
                    <a href="#ai" class="rounded-full px-3.5 py-1.5 transition hover:bg-white/10 hover:text-white">AI Agents</a>
                    <a href="#work" class="rounded-full px-3.5 py-1.5 transition hover:bg-white/10 hover:text-white">Projekte</a>
                    <a href="#process" class="rounded-full px-3.5 py-1.5 transition hover:bg-white/10 hover:text-white">Prozess</a>
                    <a href="#testimonials" class="rounded-full px-3.5 py-1.5 transition hover:bg-white/10 hover:text-white">Stimmen</a>
                    <a href="#contact" class="rounded-full px-3.5 py-1.5 transition hover:bg-white/10 hover:text-white">Kontakt</a>
                </nav>

                <div class="flex items-center gap-2">
                    <a href="#contact" class="hidden items-center gap-1.5 rounded-full bg-gradient-to-r from-blue-500 to-violet-600 px-4 py-2 text-[13.5px] font-semibold text-white shadow-[0_10px_30px_-10px_rgba(139,92,246,0.8)] ring-1 ring-white/20 transition hover:from-blue-400 hover:to-violet-500 hover:shadow-[0_15px_40px_-10px_rgba(139,92,246,0.9)] lg:inline-flex">
                        Projekt starten
                        <svg viewBox="0 0 20 20" fill="none" class="size-4"><path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>

                    <button
                        type="button"
                        x-on:click="navOpen = !navOpen"
                        x-bind:aria-expanded="navOpen.toString()"
                        aria-controls="mobile-nav"
                        class="grid size-10 place-items-center rounded-full border border-white/10 bg-white/[0.04] text-zinc-200 transition hover:border-white/30 lg:hidden"
                    >
                        <span class="sr-only">Menü öffnen</span>
                        <span class="relative block h-3.5 w-5" aria-hidden="true">
                            <span class="absolute left-0 top-0 h-px w-5 bg-current transition" x-bind:class="navOpen ? 'translate-y-[7px] rotate-45' : ''"></span>
                            <span class="absolute left-0 top-1.5 h-px w-5 bg-current transition" x-bind:class="navOpen ? 'opacity-0' : 'opacity-100'"></span>
                            <span class="absolute bottom-0 left-0 h-px w-5 bg-current transition" x-bind:class="navOpen ? '-translate-y-[7px] -rotate-45' : ''"></span>
                        </span>
                    </button>
                </div>
            </div>

            {{-- Mobile nav --}}
            <div
                id="mobile-nav"
                x-show="navOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                x-cloak
                class="mx-5 mb-4 rounded-2xl border border-white/10 bg-[#0a0a0a]/95 p-3 backdrop-blur-xl lg:hidden"
            >
                <nav class="grid gap-1 text-sm font-medium text-zinc-300">
                    <a x-on:click="navOpen = false" href="#services" class="rounded-xl px-4 py-3 transition hover:bg-white/5 hover:text-white">Services</a>
                    <a x-on:click="navOpen = false" href="#ai" class="rounded-xl px-4 py-3 transition hover:bg-white/5 hover:text-white">AI Agents</a>
                    <a x-on:click="navOpen = false" href="#work" class="rounded-xl px-4 py-3 transition hover:bg-white/5 hover:text-white">Projekte</a>
                    <a x-on:click="navOpen = false" href="#process" class="rounded-xl px-4 py-3 transition hover:bg-white/5 hover:text-white">Prozess</a>
                    <a x-on:click="navOpen = false" href="#testimonials" class="rounded-xl px-4 py-3 transition hover:bg-white/5 hover:text-white">Stimmen</a>
                    <a x-on:click="navOpen = false" href="#contact" class="rounded-xl bg-gradient-to-r from-blue-500 to-violet-600 px-4 py-3 text-center font-semibold text-white">Projekt starten</a>
                </nav>
            </div>
        </header>

        <main id="top" class="relative pt-28 lg:pt-32">

            {{-- ============ HERO ============ --}}
            <section class="relative mx-auto max-w-7xl px-5 pb-24 lg:px-8 lg:pb-32" aria-labelledby="hero-title">
                {{-- Floating orbs --}}
                <div class="pointer-events-none absolute -top-10 left-1/4 h-72 w-72 rounded-full bg-blue-500/30 blur-[120px] motion-safe:animate-pulse" aria-hidden="true"></div>
                <div class="pointer-events-none absolute right-1/4 top-20 h-72 w-72 rounded-full bg-violet-500/30 blur-[140px] motion-safe:animate-pulse [animation-duration:6s] [animation-delay:-2s]" aria-hidden="true"></div>

                <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="relative grid items-center gap-12 transition duration-700 ease-out motion-reduce:transition-none lg:grid-cols-[1.05fr_1fr] lg:gap-16">
                    <div>
                        <a href="#ai" class="group inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] py-1.5 pl-1.5 pr-4 text-[12.5px] font-medium text-zinc-300 backdrop-blur-md transition hover:border-white/20 hover:text-white">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-blue-500/90 to-violet-600/90 px-2.5 py-0.5 text-[11px] font-semibold uppercase tracking-wider text-white">
                                <span class="relative flex size-1.5">
                                    <span class="absolute inline-flex size-full animate-ping rounded-full bg-white opacity-75"></span>
                                    <span class="relative inline-flex size-1.5 rounded-full bg-white"></span>
                                </span>
                                Neu
                            </span>
                            <span>AI-Agents v2 ist live — jetzt entdecken</span>
                            <svg viewBox="0 0 20 20" fill="none" class="size-3.5 transition group-hover:translate-x-0.5"><path d="M7 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>

                        <h1 id="hero-title" class="mt-8 text-balance text-[clamp(2.6rem,6.4vw,5.5rem)] font-bold leading-[1.02] tracking-tight">
                            Wir bauen die Software,<br class="hidden sm:block"> die deine
                            <span class="relative inline-block">
                                <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-violet-400 bg-clip-text text-transparent">Konkurrenz</span>
                                <svg class="absolute -bottom-1 left-0 w-full text-violet-500/60" viewBox="0 0 300 12" preserveAspectRatio="none" aria-hidden="true">
                                    <path d="M2 9 C 80 2, 220 2, 298 9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                                </svg>
                            </span>
                            nie haben wird.
                        </h1>

                        <p class="mt-7 max-w-xl text-pretty text-[clamp(1rem,1.25vw,1.18rem)] leading-relaxed text-zinc-400">
                            Void Studio entwickelt individuelle Webplattformen, maßgeschneiderte AI-Agenten und skalierbare SaaS-Systeme für Teams, die nicht nur mitspielen — sondern gewinnen wollen.
                        </p>

                        <div class="mt-9 flex flex-wrap items-center gap-3">
                            <a href="#contact" class="group inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-blue-500 to-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-[0_20px_50px_-12px_rgba(139,92,246,0.7)] ring-1 ring-white/20 transition hover:scale-[1.02] hover:shadow-[0_25px_60px_-12px_rgba(139,92,246,0.9)]">
                                Projekt starten
                                <svg viewBox="0 0 20 20" fill="none" class="size-4 transition group-hover:translate-x-0.5"><path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="#work" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-6 py-3 text-sm font-semibold text-zinc-200 backdrop-blur-md transition hover:border-white/30 hover:bg-white/[0.07] hover:text-white">
                                <svg viewBox="0 0 20 20" fill="none" class="size-4"><circle cx="10" cy="10" r="7.5" stroke="currentColor" stroke-width="1.5"/><path d="M8 7l5 3-5 3V7z" fill="currentColor"/></svg>
                                Cases ansehen
                            </a>
                        </div>

                        {{-- Stats --}}
                        <dl class="mt-14 grid max-w-xl grid-cols-3 gap-2 sm:gap-6">
                            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-4 backdrop-blur-md">
                                <dt class="text-[11px] font-medium uppercase tracking-wider text-zinc-500">Projekte</dt>
                                <dd class="mt-1.5 text-2xl font-bold tracking-tight text-white sm:text-3xl"
                                    x-data="counter({ to: 120, step: 4, delay: 20, suffix: '+' })"
                                    x-text="value + suffix">120+</dd>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-4 backdrop-blur-md">
                                <dt class="text-[11px] font-medium uppercase tracking-wider text-zinc-500">Kunden</dt>
                                <dd class="mt-1.5 text-2xl font-bold tracking-tight text-white sm:text-3xl"
                                    x-data="counter({ to: 60, step: 2, delay: 25, suffix: '+' })"
                                    x-text="value + suffix">60+</dd>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-4 backdrop-blur-md">
                                <dt class="text-[11px] font-medium uppercase tracking-wider text-zinc-500">Uptime</dt>
                                <dd class="mt-1.5 text-2xl font-bold tracking-tight text-white sm:text-3xl">99.99<span class="text-zinc-500">%</span></dd>
                            </div>
                        </dl>
                    </div>

                    {{-- Hero visual: glassmorphic dashboard mock --}}
                    <div class="relative" x-bind:style="reduceMotion ? '' : `transform: perspective(1400px) rotateX(${(mouseY - 50) * -0.015}deg) rotateY(${(mouseX - 50) * 0.025}deg)`">
                        <div class="absolute inset-0 -z-10 rounded-[2rem] bg-gradient-to-br from-blue-500/30 via-violet-500/20 to-fuchsia-500/30 blur-3xl" aria-hidden="true"></div>

                        <div class="relative overflow-hidden rounded-[1.75rem] border border-white/10 bg-[#0a0a0a]/80 shadow-[0_40px_120px_-20px_rgba(0,0,0,0.7)] backdrop-blur-2xl">
                            <img src="https://picsum.photos/seed/voidstudio-hero/1200/800" alt="" loading="lazy" class="absolute inset-0 size-full object-cover opacity-25 mix-blend-luminosity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gradient-to-tr from-[#0a0a0a]/95 via-[#0a0a0a]/70 to-transparent" aria-hidden="true"></div>

                            <div class="relative grid gap-4 p-5 sm:p-6">
                                {{-- Mock app bar --}}
                                <div class="flex items-center justify-between gap-3 border-b border-white/5 pb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="size-2.5 rounded-full bg-rose-500/80"></span>
                                        <span class="size-2.5 rounded-full bg-amber-400/80"></span>
                                        <span class="size-2.5 rounded-full bg-emerald-400/80"></span>
                                    </div>
                                    <span class="rounded-md border border-white/10 bg-white/[0.04] px-3 py-1 font-['JetBrains_Mono',ui-monospace,monospace] text-[11px] text-zinc-400">void-studio.app/dashboard</span>
                                    <span class="hidden text-[11px] font-medium text-zinc-500 sm:inline">Live</span>
                                </div>

                                {{-- Mock KPIs --}}
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-3">
                                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-500">Revenue</p>
                                        <p class="mt-1 text-lg font-bold text-white">€482k</p>
                                        <p class="text-[10px] font-medium text-emerald-400">+12.4%</p>
                                    </div>
                                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-3">
                                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-500">Agents</p>
                                        <p class="mt-1 text-lg font-bold text-white">37</p>
                                        <p class="text-[10px] font-medium text-blue-400">3 aktiv</p>
                                    </div>
                                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-3">
                                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-500">Latency</p>
                                        <p class="mt-1 text-lg font-bold text-white">42<span class="text-sm text-zinc-500">ms</span></p>
                                        <p class="text-[10px] font-medium text-violet-400">P95</p>
                                    </div>
                                </div>

                                {{-- Mock chart --}}
                                <div class="relative h-40 overflow-hidden rounded-xl border border-white/10 bg-gradient-to-b from-white/[0.04] to-transparent p-4">
                                    <div class="flex items-center justify-between">
                                        <p class="text-xs font-semibold text-zinc-300">Inference / s</p>
                                        <p class="font-['JetBrains_Mono',ui-monospace,monospace] text-[11px] text-zinc-500">last 24h</p>
                                    </div>
                                    <svg class="absolute inset-x-0 bottom-0 h-28 w-full" viewBox="0 0 400 100" preserveAspectRatio="none" aria-hidden="true">
                                        <defs>
                                            <linearGradient id="hero-grad" x1="0" x2="0" y1="0" y2="1">
                                                <stop offset="0%" stop-color="#8b5cf6" stop-opacity="0.5"/>
                                                <stop offset="100%" stop-color="#8b5cf6" stop-opacity="0"/>
                                            </linearGradient>
                                        </defs>
                                        <path d="M0 78 L30 70 L60 76 L90 56 L120 62 L150 40 L180 48 L210 30 L240 38 L270 22 L300 32 L330 18 L360 26 L400 12 L400 100 L0 100 Z" fill="url(#hero-grad)"/>
                                        <path d="M0 78 L30 70 L60 76 L90 56 L120 62 L150 40 L180 48 L210 30 L240 38 L270 22 L300 32 L330 18 L360 26 L400 12" stroke="#a78bfa" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                {{-- Mock AI message --}}
                                <div class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/[0.03] p-3.5">
                                    <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-blue-500 to-violet-600 ring-1 ring-white/20">
                                        <svg viewBox="0 0 24 24" fill="none" class="size-4 text-white"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[11px] font-semibold text-zinc-300">Atlas · Sales Agent</p>
                                        <p class="mt-0.5 text-[12.5px] leading-relaxed text-zinc-400">
                                            Lead qualifiziert. CRM aktualisiert, Slack-Channel informiert, Demo-Call für Donnerstag 14:00 vorbereitet.
                                        </p>
                                    </div>
                                    <span class="rounded-md bg-emerald-500/10 px-2 py-0.5 text-[10px] font-semibold text-emerald-400 ring-1 ring-emerald-500/20">DONE</span>
                                </div>
                            </div>
                        </div>

                        {{-- Floating side card --}}
                        <div class="absolute -left-4 bottom-10 hidden w-52 rotate-[-6deg] rounded-2xl border border-white/10 bg-[#0a0a0a]/90 p-4 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.6)] backdrop-blur-xl md:block">
                            <div class="flex items-center gap-2">
                                <span class="grid size-7 place-items-center rounded-lg bg-blue-500/20 ring-1 ring-blue-400/40">
                                    <svg viewBox="0 0 20 20" fill="none" class="size-4 text-blue-300"><path d="M3 17l4-8 4 4 6-10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <p class="text-xs font-semibold text-white">Deploy success</p>
                            </div>
                            <p class="mt-2 font-['JetBrains_Mono',ui-monospace,monospace] text-[10.5px] text-zinc-400">
                                <span class="text-emerald-400">✓</span> Built in 18.4s<br>
                                <span class="text-emerald-400">✓</span> Pushed to edge<br>
                                <span class="text-blue-400">↗</span> 12 regions
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Trust strip --}}
                <div class="mt-20 lg:mt-28">
                    <p class="text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-zinc-500">Vertrauen von Teams bei</p>
                    <div class="mt-6 grid grid-cols-2 items-center gap-x-8 gap-y-6 opacity-70 sm:grid-cols-3 lg:grid-cols-6">
                        @foreach (['Lumen', 'Northwind', 'Helix', 'Quanta', 'Orbit', 'Stratos'] as $brand)
                            <div class="flex items-center justify-center gap-2 text-zinc-400 transition hover:text-white">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5"><path d="M12 2L4 7v10l8 5 8-5V7l-8-5z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
                                <span class="text-base font-semibold tracking-tight">{{ $brand }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- ============ SERVICES ============ --}}
            <section id="services" class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32" aria-labelledby="services-title">
                <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="mx-auto max-w-2xl text-center transition duration-700 ease-out motion-reduce:transition-none">
                    <p class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-zinc-300 backdrop-blur-md">
                        <span class="size-1.5 rounded-full bg-violet-400"></span> Services
                    </p>
                    <h2 id="services-title" class="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl">
                        Ein Studio.<br>
                        <span class="bg-gradient-to-r from-zinc-100 to-zinc-400 bg-clip-text text-transparent">Eine durchdachte Produktwelt.</span>
                    </h2>
                    <p class="mt-5 text-pretty text-zinc-400">
                        Vom ersten Wireframe bis zur produktiven AI-Pipeline — wir liefern die gesamte technische Tiefe in einem Team.
                    </p>
                </div>

                {{-- Bento grid --}}
                <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="mt-16 grid auto-rows-[minmax(0,1fr)] gap-4 transition delay-100 duration-700 ease-out motion-reduce:transition-none sm:grid-cols-2 lg:grid-cols-6">

                    {{-- Card 1: Webentwicklung (wide) --}}
                    <article class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/[0.04] to-white/[0.01] p-6 transition hover:border-white/20 hover:bg-white/[0.05] sm:col-span-2 lg:col-span-3 lg:p-8">
                        <div class="pointer-events-none absolute -right-16 -top-16 size-64 rounded-full bg-blue-500/15 blur-3xl transition group-hover:bg-blue-500/25"></div>
                        <div class="relative">
                            <div class="inline-grid size-12 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-blue-500/30 to-blue-700/20 ring-1 ring-blue-400/30">
                                <svg viewBox="0 0 24 24" fill="none" class="size-6 text-blue-300"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="6" cy="6" r="1.5" fill="currentColor"/><circle cx="6" cy="12" r="1.5" fill="currentColor"/><circle cx="6" cy="18" r="1.5" fill="currentColor"/></svg>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold tracking-tight text-white">Webentwicklung</h3>
                            <p class="mt-2 max-w-md text-[14.5px] leading-relaxed text-zinc-400">Performante, SEO-optimierte Webplattformen mit Laravel, Livewire & Next.js — ausgelegt auf Skalierung und Conversion.</p>
                            <ul class="mt-5 grid grid-cols-2 gap-2 text-[12.5px] text-zinc-400">
                                <li class="flex items-center gap-1.5"><svg viewBox="0 0 20 20" fill="none" class="size-3.5 text-blue-400"><path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Headless CMS</li>
                                <li class="flex items-center gap-1.5"><svg viewBox="0 0 20 20" fill="none" class="size-3.5 text-blue-400"><path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Edge-Deployments</li>
                                <li class="flex items-center gap-1.5"><svg viewBox="0 0 20 20" fill="none" class="size-3.5 text-blue-400"><path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Core Web Vitals</li>
                                <li class="flex items-center gap-1.5"><svg viewBox="0 0 20 20" fill="none" class="size-3.5 text-blue-400"><path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Internationalisierung</li>
                            </ul>
                        </div>
                    </article>

                    {{-- Card 2: SaaS --}}
                    <article class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/[0.04] to-white/[0.01] p-6 transition hover:border-white/20 hover:bg-white/[0.05] sm:col-span-2 lg:col-span-3 lg:p-8">
                        <div class="pointer-events-none absolute -left-16 -bottom-16 size-64 rounded-full bg-violet-500/15 blur-3xl transition group-hover:bg-violet-500/25"></div>
                        <div class="relative">
                            <div class="inline-grid size-12 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-violet-500/30 to-violet-700/20 ring-1 ring-violet-400/30">
                                <svg viewBox="0 0 24 24" fill="none" class="size-6 text-violet-300"><path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><rect x="4" y="4" width="16" height="16" rx="3" stroke="currentColor" stroke-width="1.8"/></svg>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold tracking-tight text-white">SaaS Plattformen</h3>
                            <p class="mt-2 max-w-md text-[14.5px] leading-relaxed text-zinc-400">Von der Idee zum profitablen Multi-Tenant-Produkt: Architektur, Billing, Auth, Admin & alles dazwischen.</p>
                            <div class="mt-5 flex flex-wrap gap-1.5">
                                <span class="rounded-full border border-white/10 bg-white/[0.04] px-2.5 py-1 text-[11px] font-medium text-zinc-300">Stripe Billing</span>
                                <span class="rounded-full border border-white/10 bg-white/[0.04] px-2.5 py-1 text-[11px] font-medium text-zinc-300">Multi-Tenant</span>
                                <span class="rounded-full border border-white/10 bg-white/[0.04] px-2.5 py-1 text-[11px] font-medium text-zinc-300">RBAC</span>
                                <span class="rounded-full border border-white/10 bg-white/[0.04] px-2.5 py-1 text-[11px] font-medium text-zinc-300">Analytics</span>
                            </div>
                        </div>
                    </article>

                    {{-- Card 3: AI Agents (big featured) --}}
                    <article class="group relative col-span-1 overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-violet-600/20 via-fuchsia-600/10 to-blue-600/20 p-6 transition hover:border-white/20 sm:col-span-2 lg:col-span-2 lg:p-8">
                        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_120%,rgba(139,92,246,0.35),transparent_60%)]"></div>
                        <div class="relative">
                            <div class="inline-grid size-12 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-fuchsia-500/40 to-violet-700/30 ring-1 ring-fuchsia-400/30">
                                <svg viewBox="0 0 24 24" fill="none" class="size-6 text-fuchsia-200"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.5" stroke-dasharray="2 3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold tracking-tight text-white">AI-Agenten</h3>
                            <p class="mt-2 text-[14.5px] leading-relaxed text-zinc-300">Maßgeschneiderte AI-Workflows, die wirklich arbeiten — angebunden an dein CRM, deine Daten, deine Prozesse.</p>
                        </div>
                    </article>

                    {{-- Card 4: Automatisierungen --}}
                    <article class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/[0.04] to-white/[0.01] p-6 transition hover:border-white/20 hover:bg-white/[0.05] sm:col-span-1 lg:col-span-2 lg:p-8">
                        <div class="pointer-events-none absolute -right-10 top-1/2 size-48 -translate-y-1/2 rounded-full bg-sky-500/15 blur-3xl transition group-hover:bg-sky-500/25"></div>
                        <div class="relative">
                            <div class="inline-grid size-12 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-sky-500/30 to-blue-700/20 ring-1 ring-sky-400/30">
                                <svg viewBox="0 0 24 24" fill="none" class="size-6 text-sky-300"><path d="M14 3l-4 7h6l-4 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold tracking-tight text-white">Automatisierungen</h3>
                            <p class="mt-2 text-[14.5px] leading-relaxed text-zinc-400">Workflows, die nie schlafen. n8n, custom Pipelines & deeply-integrated Logic.</p>
                        </div>
                    </article>

                    {{-- Card 5: UI/UX --}}
                    <article class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/[0.04] to-white/[0.01] p-6 transition hover:border-white/20 hover:bg-white/[0.05] sm:col-span-1 lg:col-span-2 lg:p-8">
                        <div class="pointer-events-none absolute -left-10 -top-10 size-48 rounded-full bg-pink-500/15 blur-3xl transition group-hover:bg-pink-500/25"></div>
                        <div class="relative">
                            <div class="inline-grid size-12 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-pink-500/30 to-fuchsia-700/20 ring-1 ring-pink-400/30">
                                <svg viewBox="0 0 24 24" fill="none" class="size-6 text-pink-300"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="1" fill="currentColor"/></svg>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold tracking-tight text-white">UI/UX Design</h3>
                            <p class="mt-2 text-[14.5px] leading-relaxed text-zinc-400">Interfaces, die intuitiv funktionieren und premium aussehen. Design-Systeme inklusive.</p>
                        </div>
                    </article>

                    {{-- Card 6: API --}}
                    <article class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/[0.04] to-white/[0.01] p-6 transition hover:border-white/20 hover:bg-white/[0.05] sm:col-span-2 lg:col-span-2 lg:p-8">
                        <div class="pointer-events-none absolute -right-10 -bottom-10 size-48 rounded-full bg-emerald-500/15 blur-3xl transition group-hover:bg-emerald-500/25"></div>
                        <div class="relative">
                            <div class="inline-grid size-12 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-emerald-500/30 to-teal-700/20 ring-1 ring-emerald-400/30">
                                <svg viewBox="0 0 24 24" fill="none" class="size-6 text-emerald-300"><path d="M8 5l-5 7 5 7M16 5l5 7-5 7M14 4l-4 16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold tracking-tight text-white">API-Entwicklung</h3>
                            <p class="mt-2 text-[14.5px] leading-relaxed text-zinc-400">REST & GraphQL APIs, die skalieren. Mit Docs, Auth & SDKs ab Tag eins.</p>
                        </div>
                    </article>
                </div>
            </section>

            {{-- ============ AI AGENTS SHOWCASE ============ --}}
            <section id="ai" class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32" aria-labelledby="ai-title">
                <div class="grid items-center gap-12 lg:grid-cols-[1fr_1.1fr] lg:gap-16">
                    <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="transition duration-700 ease-out motion-reduce:transition-none">
                        <p class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-zinc-300 backdrop-blur-md">
                            <span class="size-1.5 rounded-full bg-fuchsia-400"></span> AI-Agents
                        </p>
                        <h2 id="ai-title" class="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl">
                            Agenten, die <span class="bg-gradient-to-r from-fuchsia-400 to-violet-400 bg-clip-text text-transparent">arbeiten</span> —<br>
                            nicht nur reden.
                        </h2>
                        <p class="mt-5 text-pretty leading-relaxed text-zinc-400">
                            Wir bauen produktive AI-Agenten direkt in deine Plattform. Mit Zugriff auf deine Datenbanken, Tools und APIs — und mit klaren Guardrails, Audits und Observability.
                        </p>

                        <ul class="mt-8 space-y-3.5">
                            @foreach ([
                                ['Custom-Tools & Function-Calling', 'Eigene Skills für jede Aufgabe — vom CRM-Update bis zur Code-Generierung.'],
                                ['Retrieval Augmented Generation', 'Antworten auf Basis deiner echten Daten. Keine Halluzinationen.'],
                                ['Multi-Agent Orchestrierung', 'Spezialisierte Agenten arbeiten Hand in Hand. Mit Memory & Handoffs.'],
                                ['Production-grade Monitoring', 'Tracing, Cost-Tracking & Fallbacks — wie es Software 2026 braucht.'],
                            ] as [$title, $desc])
                                <li class="flex items-start gap-3.5">
                                    <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-md bg-gradient-to-br from-violet-500/30 to-fuchsia-500/30 ring-1 ring-violet-400/40">
                                        <svg viewBox="0 0 20 20" fill="none" class="size-3.5 text-violet-200"><path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                    <div>
                                        <p class="text-[15px] font-semibold text-white">{{ $title }}</p>
                                        <p class="mt-0.5 text-[13.5px] leading-relaxed text-zinc-400">{{ $desc }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <a href="#contact" class="mt-9 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/[0.04] px-5 py-2.5 text-sm font-semibold text-white backdrop-blur-md transition hover:border-white/30 hover:bg-white/[0.07]">
                            Use-Case besprechen
                            <svg viewBox="0 0 20 20" fill="none" class="size-4"><path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    {{-- AI Dashboard mockup --}}
                    <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="relative transition delay-150 duration-700 ease-out motion-reduce:transition-none">
                        <div class="absolute -inset-6 -z-10 rounded-[2.5rem] bg-gradient-to-br from-fuchsia-500/30 via-violet-500/20 to-blue-500/30 opacity-60 blur-3xl"></div>

                        <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-[#0a0a0a]/85 p-5 shadow-[0_40px_120px_-20px_rgba(0,0,0,0.7)] backdrop-blur-2xl sm:p-7">
                            <div class="flex items-center justify-between gap-3 border-b border-white/5 pb-4">
                                <div class="flex items-center gap-2.5">
                                    <span class="relative grid size-9 place-items-center rounded-xl bg-gradient-to-br from-fuchsia-500 to-violet-600 ring-1 ring-white/20">
                                        <svg viewBox="0 0 20 20" fill="none" class="size-4 text-white"><circle cx="10" cy="10" r="3" fill="currentColor"/><circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="1.5" stroke-dasharray="2 2"/></svg>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-white">Atlas Agent</p>
                                        <p class="font-['JetBrains_Mono',ui-monospace,monospace] text-[10.5px] text-zinc-500">model: void-large · v2.4</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2.5 py-1 text-[10.5px] font-semibold text-emerald-400 ring-1 ring-emerald-500/20">
                                    <span class="size-1.5 rounded-full bg-emerald-400 motion-safe:animate-pulse"></span> Online
                                </span>
                            </div>

                            {{-- Conversation --}}
                            <div class="mt-5 space-y-3.5">
                                <div class="flex items-start gap-3">
                                    <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-white/[0.06] text-[10.5px] font-semibold text-zinc-300 ring-1 ring-white/10">JS</span>
                                    <div class="rounded-2xl rounded-tl-md border border-white/10 bg-white/[0.03] px-3.5 py-2.5 text-[13.5px] text-zinc-200">
                                        Recherchiere die letzten Quartalsberichte unserer Top-5-Kunden und schreibe eine Zusammenfassung.
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-fuchsia-500 to-violet-600 ring-1 ring-white/20">
                                        <svg viewBox="0 0 20 20" fill="none" class="size-3.5 text-white"><path d="M10 2v3M10 15v3M3 10h3M14 10h3M5 5l2 2M13 13l2 2M5 15l2-2M13 7l2-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                                    </span>
                                    <div class="flex-1 rounded-2xl rounded-tl-md border border-white/10 bg-gradient-to-br from-violet-500/10 to-fuchsia-500/5 px-3.5 py-3 text-[13.5px] text-zinc-200">
                                        <p>Verstanden. Ich starte 3 Tools parallel:</p>
                                        <ul class="mt-2 space-y-1.5 font-['JetBrains_Mono',ui-monospace,monospace] text-[12px]">
                                            <li class="flex items-center gap-2 text-blue-300"><span class="grid size-4 place-items-center rounded bg-blue-500/20"><svg viewBox="0 0 12 12" fill="none" class="size-2.5"><path d="M2 6l3 3 5-7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span> crm.fetch_customers({ limit: 5 })</li>
                                            <li class="flex items-center gap-2 text-violet-300"><span class="grid size-4 place-items-center rounded bg-violet-500/20"><svg viewBox="0 0 12 12" fill="none" class="size-2.5"><path d="M2 6l3 3 5-7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span> docs.search("q4 report 2025")</li>
                                            <li class="flex items-center gap-2 text-fuchsia-300"><span class="grid size-4 place-items-center rounded bg-fuchsia-500/20 ring-1 ring-fuchsia-400/30"><span class="size-1.5 animate-ping rounded-full bg-fuchsia-300"></span></span> web.research(...) <span class="text-zinc-500">· läuft</span></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="ml-10 flex items-center gap-2 text-[11px] text-zinc-500">
                                    <span class="inline-flex size-1 rounded-full bg-fuchsia-400 motion-safe:animate-pulse"></span>
                                    Atlas schreibt
                                    <span class="inline-flex gap-0.5">
                                        <span class="size-1 rounded-full bg-zinc-500 motion-safe:animate-bounce" style="animation-delay:-0.32s"></span>
                                        <span class="size-1 rounded-full bg-zinc-500 motion-safe:animate-bounce" style="animation-delay:-0.16s"></span>
                                        <span class="size-1 rounded-full bg-zinc-500 motion-safe:animate-bounce"></span>
                                    </span>
                                </div>
                            </div>

                            {{-- Input --}}
                            <div class="mt-5 flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.03] p-2">
                                <input type="text" placeholder="Nachricht an Atlas…" class="flex-1 border-0 bg-transparent px-3 py-1.5 text-[13.5px] text-white placeholder:text-zinc-500 focus:outline-none" aria-label="Nachricht an Atlas">
                                <button type="button" class="grid size-8 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 text-white ring-1 ring-white/20 transition hover:scale-105">
                                    <svg viewBox="0 0 20 20" fill="none" class="size-4"><path d="M3 10l14-7-5 17-2-7-7-3z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Tool callout --}}
                        <div class="absolute -right-4 top-12 hidden w-56 rotate-[5deg] rounded-2xl border border-white/10 bg-[#0a0a0a]/95 p-4 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.6)] backdrop-blur-xl md:block">
                            <p class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">Tools verbunden</p>
                            <div class="mt-2.5 grid grid-cols-4 gap-1.5">
                                @foreach (['CRM', 'API', 'DB', 'S3', 'Git', 'Mail', '+12', '+'] as $tool)
                                    <span class="grid aspect-square place-items-center rounded-lg border border-white/10 bg-white/[0.04] text-[10px] font-semibold text-zinc-300">{{ $tool }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ============ PORTFOLIO ============ --}}
            <section id="work" class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32" aria-labelledby="work-title">
                <div class="flex flex-wrap items-end justify-between gap-6">
                    <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="max-w-2xl transition duration-700 ease-out motion-reduce:transition-none">
                        <p class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-zinc-300 backdrop-blur-md">
                            <span class="size-1.5 rounded-full bg-blue-400"></span> Selected work
                        </p>
                        <h2 id="work-title" class="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl">
                            Produkte, die <span class="bg-gradient-to-r from-blue-400 to-violet-400 bg-clip-text text-transparent">Märkte verschoben</span> haben.
                        </h2>
                    </div>
                    <a href="#contact" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-300 transition hover:text-white">
                        Alle Cases ansehen
                        <svg viewBox="0 0 20 20" fill="none" class="size-4"><path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-12">
                    @php
                        $projects = [
                            ['title' => 'Nebula CRM', 'cat' => 'SaaS · AI', 'desc' => 'AI-natives CRM mit Auto-Pipeline und Smart-Inboxes.', 'img' => 'voidstudio-nebula', 'span' => 'lg:col-span-7'],
                            ['title' => 'Helix Health', 'cat' => 'Platform · API', 'desc' => 'Patient-Plattform mit HL7-Integration & DSGVO.', 'img' => 'voidstudio-helix', 'span' => 'lg:col-span-5'],
                            ['title' => 'Quanta Finance', 'cat' => 'FinTech', 'desc' => 'Realtime Portfolio Dashboard & Reporting.', 'img' => 'voidstudio-quanta', 'span' => 'lg:col-span-5'],
                            ['title' => 'Orbit Logistics', 'cat' => 'Operations · Automation', 'desc' => 'Multi-Hub Logistik mit AI-Routing & ETA-Modellen.', 'img' => 'voidstudio-orbit', 'span' => 'lg:col-span-7'],
                        ];
                    @endphp

                    @foreach ($projects as $p)
                        <article x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="group relative col-span-1 sm:col-span-1 {{ $p['span'] }} overflow-hidden rounded-3xl border border-white/10 bg-white/[0.02] transition duration-700 ease-out hover:border-white/20 motion-reduce:transition-none">
                            <div class="relative aspect-[16/10] overflow-hidden">
                                <img src="https://picsum.photos/seed/{{ $p['img'] }}/1200/750" alt="{{ $p['title'] }} Case Study" loading="lazy" class="size-full object-cover transition duration-700 ease-out group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                                <div class="absolute inset-x-0 bottom-0 p-5 sm:p-7">
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-violet-300">{{ $p['cat'] }}</p>
                                    <h3 class="mt-1.5 text-2xl font-bold tracking-tight text-white sm:text-3xl">{{ $p['title'] }}</h3>
                                    <p class="mt-1.5 max-w-sm text-[13.5px] leading-relaxed text-zinc-300">{{ $p['desc'] }}</p>
                                </div>
                                <span class="absolute right-5 top-5 grid size-10 place-items-center rounded-full border border-white/20 bg-black/40 text-white opacity-0 backdrop-blur-md transition group-hover:opacity-100">
                                    <svg viewBox="0 0 20 20" fill="none" class="size-4"><path d="M5 15L15 5m0 0H7m8 0v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- ============ WHY VOID + PROCESS ============ --}}
            <section id="process" class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32" aria-labelledby="why-title">
                <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="mx-auto max-w-2xl text-center transition duration-700 ease-out motion-reduce:transition-none">
                    <p class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-zinc-300 backdrop-blur-md">
                        <span class="size-1.5 rounded-full bg-emerald-400"></span> Warum Void Studio
                    </p>
                    <h2 id="why-title" class="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl">
                        Schnell. Präzise.<br>
                        <span class="bg-gradient-to-r from-zinc-100 to-zinc-400 bg-clip-text text-transparent">Production-ready.</span>
                    </h2>
                </div>

                {{-- Feature grid --}}
                <div class="mt-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @php
                        $features = [
                            ['Senior-Team', 'Keine Junior-Falle. Nur Engineers mit Production-Erfahrung.', 'M12 2L4 7v10l8 5 8-5V7l-8-5z'],
                            ['Velocity', 'Erste Releases in Wochen — nicht Quartalen.', 'M13 2L3 14h7l-1 8 10-12h-7l1-8z'],
                            ['Ownership', 'Du bekommst Code, Docs & Infrastruktur — alles.', 'M5 8a3 3 0 016 0v3H5V8zm-1 3h8v8H4v-8z'],
                            ['Skalierbarkeit', 'Architektur, die mit deinem Wachstum mitwächst.', 'M3 17l6-6 4 4 8-8M14 7h7v7'],
                        ];
                    @endphp
                    @foreach ($features as [$title, $desc, $path])
                        <div class="group rounded-3xl border border-white/10 bg-white/[0.02] p-6 transition hover:-translate-y-1 hover:border-white/20 hover:bg-white/[0.05]">
                            <div class="inline-grid size-11 place-items-center rounded-xl border border-white/10 bg-gradient-to-br from-blue-500/20 to-violet-500/20 ring-1 ring-white/10">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5 text-zinc-100"><path d="{{ $path }}" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <h3 class="mt-4 text-base font-semibold text-white">{{ $title }}</h3>
                            <p class="mt-1.5 text-[13.5px] leading-relaxed text-zinc-400">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Process timeline --}}
                <div class="mt-20">
                    <h3 class="text-center text-2xl font-semibold tracking-tight text-white sm:text-3xl">Wie wir arbeiten</h3>

                    <ol class="relative mx-auto mt-12 grid max-w-5xl gap-6 lg:grid-cols-4">
                        <div class="pointer-events-none absolute left-0 right-0 top-7 hidden h-px bg-gradient-to-r from-transparent via-white/15 to-transparent lg:block" aria-hidden="true"></div>

                        @foreach ([
                            ['01', 'Discovery', 'Strategy-Sprint mit Workshops, Goals & Roadmap.'],
                            ['02', 'Design', 'High-fidelity Prototypes & Design-System.'],
                            ['03', 'Build', 'Iterative Engineering mit wöchentlichen Demos.'],
                            ['04', 'Launch', 'Production-Deployment, Monitoring & Support.'],
                        ] as [$step, $title, $desc])
                            <li class="relative">
                                <div class="relative z-10 grid size-14 place-items-center rounded-2xl border border-white/10 bg-[#0a0a0a] font-['JetBrains_Mono',ui-monospace,monospace] text-sm font-semibold text-violet-300 ring-1 ring-violet-500/20">
                                    {{ $step }}
                                </div>
                                <h4 class="mt-5 text-base font-semibold text-white">{{ $title }}</h4>
                                <p class="mt-1 text-[13.5px] leading-relaxed text-zinc-400">{{ $desc }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            {{-- ============ TESTIMONIALS ============ --}}
            <section id="testimonials" class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32" aria-labelledby="testimonials-title">
                <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="mx-auto max-w-2xl text-center transition duration-700 ease-out motion-reduce:transition-none">
                    <p class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-zinc-300 backdrop-blur-md">
                        <span class="size-1.5 rounded-full bg-yellow-400"></span> Stimmen
                    </p>
                    <h2 id="testimonials-title" class="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl">
                        Geliebt von <span class="bg-gradient-to-r from-blue-400 to-violet-400 bg-clip-text text-transparent">Teams</span>,<br>
                        die anspruchsvoll sind.
                    </h2>
                </div>

                <div class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @php
                        $testimonials = [
                            ['Void Studio hat unser AI-Sales-System in 6 Wochen ausgeliefert. Jetzt qualifiziert es 70% unserer Leads automatisch.', 'Sarah Kraus', 'VP Growth · Nebula', 'voidstudio-t1'],
                            ['Das Team versteht Engineering UND Business. Sehr selten in dieser Kombination — und unbezahlbar wertvoll.', 'Marc Henning', 'CTO · Quanta Finance', 'voidstudio-t2'],
                            ['Wir haben mit Void Studio unser Legacy-System in eine moderne SaaS-Plattform transformiert. Beste Entscheidung des Jahres.', 'Linda Park', 'Founder · Helix Health', 'voidstudio-t3'],
                            ['Die AI-Agenten von Void Studio laufen seit 8 Monaten in Produktion. Null Ausfall, klare Cost-Reports — Premium.', 'Daniel Roth', 'Head of Engineering · Orbit', 'voidstudio-t4'],
                            ['Premium Design, präziser Code, schnelle Iterationen. Wir bauen jetzt unser Produkt 2 mit Void Studio.', 'Yara Müller', 'Product Lead · Stratos', 'voidstudio-t5'],
                            ['Endlich ein Studio, das nicht nur schöne Pitches macht — sondern auch liefert. Klare Empfehlung.', 'Jonas Becker', 'Founder · Lumen Labs', 'voidstudio-t6'],
                        ];
                    @endphp

                    @foreach ($testimonials as [$quote, $name, $role, $img])
                        <figure class="group relative overflow-hidden rounded-3xl border border-white/10 bg-white/[0.02] p-6 transition hover:border-white/20 hover:bg-white/[0.04]">
                            <div class="pointer-events-none absolute -right-12 -top-12 size-44 rounded-full bg-violet-500/10 opacity-0 blur-3xl transition group-hover:opacity-100"></div>
                            <div class="relative flex items-center gap-1.5">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-3.5 text-amber-400"><path d="M10 1.5l2.6 5.4 6 .9-4.3 4.2 1 5.9L10 15.1l-5.3 2.8 1-5.9L1.4 7.8l6-.9L10 1.5z"/></svg>
                                @endfor
                            </div>
                            <blockquote class="relative mt-4 text-[14.5px] leading-relaxed text-zinc-200">"{{ $quote }}"</blockquote>
                            <figcaption class="relative mt-5 flex items-center gap-3 border-t border-white/5 pt-4">
                                <img src="https://picsum.photos/seed/{{ $img }}/80/80" alt="" loading="lazy" class="size-9 rounded-full object-cover ring-2 ring-white/10">
                                <div>
                                    <p class="text-[13px] font-semibold text-white">{{ $name }}</p>
                                    <p class="text-[11.5px] text-zinc-500">{{ $role }}</p>
                                </div>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </section>

            {{-- ============ BIG CTA ============ --}}
            <section class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32">
                <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-blue-600/20 via-violet-600/20 to-fuchsia-600/20 p-10 transition duration-700 ease-out motion-reduce:transition-none sm:p-16 lg:p-24">
                    <div class="pointer-events-none absolute inset-0 [background-image:linear-gradient(rgba(255,255,255,0.06)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.06)_1px,transparent_1px)] [background-size:48px_48px] [mask-image:radial-gradient(ellipse_at_center,#000_30%,transparent_70%)]"></div>
                    <div class="pointer-events-none absolute -top-32 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-violet-500/40 blur-3xl"></div>

                    <div class="relative mx-auto max-w-3xl text-center">
                        <h2 class="text-balance text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                            Bereit, das Produkt zu bauen,<br>
                            das deine <span class="bg-gradient-to-r from-blue-300 via-violet-300 to-fuchsia-300 bg-clip-text text-transparent">Kategorie definiert</span>?
                        </h2>
                        <p class="mt-6 text-pretty text-lg text-zinc-300">
                            Lass uns 30 Minuten reden. Kein Pitch — nur ehrliche Antworten auf deine Fragen.
                        </p>
                        <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
                            <a href="#contact" class="group inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-[#050505] shadow-[0_20px_50px_-12px_rgba(255,255,255,0.4)] transition hover:scale-[1.02] hover:shadow-[0_25px_60px_-12px_rgba(255,255,255,0.6)]">
                                Kostenloses Discovery-Call buchen
                                <svg viewBox="0 0 20 20" fill="none" class="size-4 transition group-hover:translate-x-0.5"><path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="#work" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-3.5 text-sm font-semibold text-white backdrop-blur-md transition hover:border-white/40 hover:bg-white/10">
                                Cases ansehen
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ============ CONTACT FORM ============ --}}
            <section id="contact" class="relative mx-auto max-w-7xl px-5 py-24 lg:px-8 lg:py-32" aria-labelledby="contact-title">
                <div class="grid gap-12 lg:grid-cols-[1fr_1.2fr] lg:gap-20">
                    <div x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'" class="transition duration-700 ease-out motion-reduce:transition-none">
                        <p class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-zinc-300 backdrop-blur-md">
                            <span class="size-1.5 rounded-full bg-blue-400"></span> Kontakt
                        </p>
                        <h2 id="contact-title" class="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl">
                            Lass uns etwas <span class="bg-gradient-to-r from-blue-400 to-violet-400 bg-clip-text text-transparent">Großes bauen</span>.
                        </h2>
                        <p class="mt-5 leading-relaxed text-zinc-400">
                            Erzähle uns von deinem Vorhaben. Wir melden uns innerhalb von 24 Stunden mit konkretem Feedback.
                        </p>

                        <dl class="mt-10 space-y-5">
                            <div class="flex items-start gap-4">
                                <span class="grid size-10 shrink-0 place-items-center rounded-xl border border-white/10 bg-white/[0.04]">
                                    <svg viewBox="0 0 20 20" fill="none" class="size-4 text-violet-300"><path d="M2.5 5l7.5 5 7.5-5M2.5 5v10h15V5M2.5 5h15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <div>
                                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">E-Mail</dt>
                                    <dd class="mt-0.5 text-sm font-medium text-zinc-100"><a href="mailto:hi@voidstudio.dev" class="transition hover:text-violet-300">hi@voidstudio.dev</a></dd>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <span class="grid size-10 shrink-0 place-items-center rounded-xl border border-white/10 bg-white/[0.04]">
                                    <svg viewBox="0 0 20 20" fill="none" class="size-4 text-blue-300"><path d="M3 4h4l1 4-2 1c.8 2 2 3.2 4 4l1-2 4 1v4c0 .5-.5 1-1 1-7 0-12-5-12-12 0-.5.5-1 1-1z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <div>
                                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">Telefon</dt>
                                    <dd class="mt-0.5 text-sm font-medium text-zinc-100">+49 30 1234 5678</dd>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <span class="grid size-10 shrink-0 place-items-center rounded-xl border border-white/10 bg-white/[0.04]">
                                    <svg viewBox="0 0 20 20" fill="none" class="size-4 text-fuchsia-300"><path d="M10 2c3.5 0 6 2.5 6 6 0 4.5-6 10-6 10S4 12.5 4 8c0-3.5 2.5-6 6-6z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="10" cy="8" r="2" stroke="currentColor" stroke-width="1.6"/></svg>
                                </span>
                                <div>
                                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">Studio</dt>
                                    <dd class="mt-0.5 text-sm font-medium text-zinc-100">Berlin · Remote-first</dd>
                                </div>
                            </div>
                        </dl>
                    </div>

                    <form
                        x-data="contactForm()"
                        x-on:submit.prevent="submit()"
                        x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        class="relative transition delay-100 duration-700 ease-out motion-reduce:transition-none"
                        novalidate
                    >
                        <div class="absolute -inset-4 -z-10 rounded-[2rem] bg-gradient-to-br from-blue-500/20 via-violet-500/15 to-fuchsia-500/20 opacity-60 blur-3xl"></div>

                        <div class="relative rounded-3xl border border-white/10 bg-[#0a0a0a]/85 p-6 backdrop-blur-2xl sm:p-9">
                            <div x-show="!sent" x-cloak class="grid gap-5">
                                <div class="grid gap-5 sm:grid-cols-2">
                                    <label class="block">
                                        <span class="text-[11.5px] font-semibold uppercase tracking-wider text-zinc-400">Name</span>
                                        <input x-model="data.name" type="text" required autocomplete="name" class="peer mt-2 block w-full rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white placeholder:text-zinc-500 transition focus:border-violet-400/60 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-violet-500/30" placeholder="Maria Schmidt">
                                    </label>
                                    <label class="block">
                                        <span class="text-[11.5px] font-semibold uppercase tracking-wider text-zinc-400">E-Mail</span>
                                        <input x-model="data.email" type="email" required autocomplete="email" class="peer mt-2 block w-full rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white placeholder:text-zinc-500 transition focus:border-violet-400/60 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-violet-500/30" placeholder="maria@firma.com">
                                    </label>
                                </div>

                                <label class="block">
                                    <span class="text-[11.5px] font-semibold uppercase tracking-wider text-zinc-400">Unternehmen</span>
                                    <input x-model="data.company" type="text" autocomplete="organization" class="mt-2 block w-full rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white placeholder:text-zinc-500 transition focus:border-violet-400/60 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-violet-500/30" placeholder="Acme GmbH">
                                </label>

                                <div>
                                    <span class="text-[11.5px] font-semibold uppercase tracking-wider text-zinc-400">Budget</span>
                                    <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-4">
                                        @foreach (['< 10k', '10–30k', '30–80k', '80k+'] as $budget)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="budget" value="{{ $budget }}" x-model="data.budget" class="peer sr-only">
                                                <span class="block rounded-xl border border-white/10 bg-white/[0.03] px-3 py-2.5 text-center text-[12.5px] font-medium text-zinc-300 transition hover:border-white/25 peer-checked:border-violet-400/60 peer-checked:bg-violet-500/15 peer-checked:text-white">€ {{ $budget }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <label class="block">
                                    <span class="text-[11.5px] font-semibold uppercase tracking-wider text-zinc-400">Projekt</span>
                                    <textarea x-model="data.message" required rows="4" class="mt-2 block w-full resize-none rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white placeholder:text-zinc-500 transition focus:border-violet-400/60 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-violet-500/30" placeholder="Erzähle uns kurz, woran du arbeitest…"></textarea>
                                </label>

                                <button type="submit" x-bind:disabled="sending" class="group mt-2 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-500 to-violet-600 px-6 py-3.5 text-sm font-semibold text-white shadow-[0_20px_40px_-12px_rgba(139,92,246,0.7)] ring-1 ring-white/20 transition hover:from-blue-400 hover:to-violet-500 hover:shadow-[0_25px_50px_-12px_rgba(139,92,246,0.9)] disabled:opacity-60">
                                    <span x-show="!sending">Anfrage senden</span>
                                    <span x-show="sending" x-cloak class="inline-flex items-center gap-2">
                                        <svg viewBox="0 0 20 20" fill="none" class="size-4 animate-spin"><circle cx="10" cy="10" r="7" stroke="currentColor" stroke-opacity=".25" stroke-width="2"/><path d="M17 10a7 7 0 00-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                        Wird gesendet…
                                    </span>
                                    <svg x-show="!sending" viewBox="0 0 20 20" fill="none" class="size-4 transition group-hover:translate-x-0.5"><path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>

                                <p class="text-[11.5px] text-zinc-500">Mit dem Absenden stimmst du unserer Datenschutzerklärung zu.</p>
                            </div>

                            <div x-show="sent" x-cloak x-transition.opacity.duration.300ms class="grid place-items-center gap-3 py-10 text-center">
                                <span class="grid size-14 place-items-center rounded-full bg-gradient-to-br from-emerald-500/30 to-emerald-700/20 ring-1 ring-emerald-400/30">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-7 text-emerald-300"><path d="M5 12l5 5L20 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <h3 class="text-xl font-bold text-white">Danke, <span x-text="data.name || 'Hi'"></span> — Nachricht ist drüben.</h3>
                                <p class="max-w-sm text-[14px] text-zinc-400">Wir melden uns innerhalb von 24 Stunden mit konkretem Feedback und Next Steps.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        {{-- ============ FOOTER ============ --}}
        <footer class="relative border-t border-white/10 bg-[#050505]/60 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
                    <div>
                        <a href="#top" class="inline-flex items-center gap-2.5">
                            <span class="grid size-9 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 ring-1 ring-white/20" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5 text-white"><path d="M4 4l8 16 8-16" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="text-[15px] font-semibold tracking-tight">Void Studio</span>
                        </a>
                        <p class="mt-5 max-w-xs text-[13.5px] leading-relaxed text-zinc-400">Wir entwickeln Webplattformen, AI-Agenten und SaaS-Systeme für ambitionierte Teams.</p>

                        <div class="mt-6 flex items-center gap-2">
                            @foreach ([
                                ['X / Twitter', 'M4 4l16 16M20 4L4 20'],
                                ['LinkedIn', 'M4 8v12M4 4v0M9 20v-8M9 14a4 4 0 018 0v6'],
                                ['GitHub', 'M9 19c-4 1-4-2-6-2.5M15 22v-3.9c0-.9-.1-1.6-.5-2.1 3-.3 6-1.4 6-6.5 0-1.3-.4-2.3-1.3-3.2.1-.4.5-1.5-.1-3 0 0-1-.3-3.5 1.3a12 12 0 00-6.4 0c-2.5-1.6-3.5-1.3-3.5-1.3-.6 1.5-.2 2.6-.1 3-.9.9-1.3 1.9-1.3 3.2 0 5 3 6.2 6 6.5-.5.5-.6 1-.6 2v3'],
                                ['Dribbble', 'M3 12a9 9 0 1018 0 9 9 0 00-18 0zM3 12c5-1 13 0 18 5M5 5c4 4 9 8 15 11M16 3.5c-1 6-3 14-9 17'],
                            ] as [$name, $path])
                                <a href="#" aria-label="{{ $name }}" class="grid size-9 place-items-center rounded-xl border border-white/10 bg-white/[0.03] text-zinc-300 transition hover:border-white/30 hover:text-white">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-4"><path d="{{ $path }}" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">Studio</p>
                        <ul class="mt-4 space-y-2.5 text-[13.5px] text-zinc-300">
                            <li><a href="#services" class="transition hover:text-white">Services</a></li>
                            <li><a href="#ai" class="transition hover:text-white">AI Agents</a></li>
                            <li><a href="#work" class="transition hover:text-white">Projekte</a></li>
                            <li><a href="#process" class="transition hover:text-white">Prozess</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">Unternehmen</p>
                        <ul class="mt-4 space-y-2.5 text-[13.5px] text-zinc-300">
                            <li><a href="#" class="transition hover:text-white">Über uns</a></li>
                            <li><a href="#" class="transition hover:text-white">Karriere</a></li>
                            <li><a href="#" class="transition hover:text-white">Blog</a></li>
                            <li><a href="#contact" class="transition hover:text-white">Kontakt</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-zinc-500">Newsletter</p>
                        <p class="mt-4 text-[13.5px] text-zinc-400">Monatliche Insights aus der Welt von AI & Engineering.</p>
                        <form x-on:submit.prevent="" class="mt-4 flex items-center gap-2 rounded-xl border border-white/10 bg-white/[0.03] p-1.5">
                            <input type="email" required placeholder="deine@email.com" class="flex-1 border-0 bg-transparent px-2 py-1.5 text-[13.5px] text-white placeholder:text-zinc-500 focus:outline-none" aria-label="E-Mail">
                            <button type="submit" class="rounded-lg bg-gradient-to-r from-blue-500 to-violet-600 px-3 py-1.5 text-[12px] font-semibold text-white ring-1 ring-white/20 transition hover:from-blue-400 hover:to-violet-500">Abonnieren</button>
                        </form>
                    </div>
                </div>

                <div class="mt-12 flex flex-col items-start justify-between gap-3 border-t border-white/5 pt-6 text-[12px] text-zinc-500 sm:flex-row sm:items-center">
                    <p>© {{ now()->year }} Void Studio. Alle Rechte vorbehalten.</p>
                    <div class="flex items-center gap-5">
                        <a href="#" class="transition hover:text-zinc-300">Impressum</a>
                        <a href="#" class="transition hover:text-zinc-300">Datenschutz</a>
                        <a href="#" class="transition hover:text-zinc-300">AGB</a>
                    </div>
                </div>
            </div>

            <div class="pointer-events-none absolute inset-x-0 top-0 mx-auto h-px max-w-3xl bg-gradient-to-r from-transparent via-violet-500/60 to-transparent"></div>
        </footer>

        <style>[x-cloak]{display:none!important}</style>
    </body>
</html>
