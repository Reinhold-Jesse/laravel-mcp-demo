<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Void Studio ist eine Designagentur für Logos, Websites und strategisches Branding für ambitionierte Firmen.">

        <title>Void Studio - Designagentur für Marken mit Tiefe</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cinzel:500,600,700|josefin-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{ navOpen: false, mouseX: 50, mouseY: 18, reduceMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches }"
        x-on:mousemove.window="if (! reduceMotion) { mouseX = Math.round(($event.clientX / window.innerWidth) * 100); mouseY = Math.round(($event.clientY / window.innerHeight) * 100) }"
        class="min-h-screen overflow-x-hidden bg-[#060606] bg-[radial-gradient(circle_at_12%_8%,rgba(217,164,65,0.18),transparent_26rem),radial-gradient(circle_at_86%_18%,rgba(255,255,255,0.08),transparent_24rem),linear-gradient(145deg,#060606_0%,#0e0d0c_48%,#050505_100%)] font-['Josefin_Sans',ui-sans-serif,system-ui,sans-serif] text-[#f7f2e8] antialiased selection:bg-[#d9a441] selection:text-[#12100d]"
    >
        <div class="pointer-events-none fixed inset-0 -z-20 bg-[linear-gradient(rgba(255,255,255,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.035)_1px,transparent_1px)] [background-size:64px_64px] [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.9),transparent_80%)]"></div>
        <div class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.16)_1px,transparent_1px)] opacity-[0.08] mix-blend-soft-light [background-size:18px_18px]"></div>
        <div x-bind:style="`background: radial-gradient(circle at ${mouseX}% ${mouseY}%, rgba(217,164,65,0.16), transparent 24rem)`" class="pointer-events-none fixed inset-0 -z-10 opacity-80 transition-[background] duration-300"></div>

        <header class="sticky top-4 z-50 mx-auto mt-4 flex w-[calc(100%_-_2rem)] max-w-[85rem] flex-col gap-3 rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#070707]/80 px-3 py-3 shadow-[0_14px_60px_rgba(0,0,0,0.28)] backdrop-blur-xl md:flex-row md:items-center md:justify-between md:gap-6 md:rounded-full md:py-3 md:pl-5" aria-label="Hauptnavigation" x-on:keydown.escape.window="navOpen = false">
            <div class="flex w-full items-center justify-between gap-4 md:w-auto">
                <a class="inline-flex items-center gap-3 text-sm font-bold uppercase tracking-[0.22em] outline-offset-4 transition-colors hover:text-[#d9a441] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441]" href="#top" aria-label="Void Studio Startseite" x-on:click="navOpen = false">
                    <span class="grid size-[38px] place-items-center rounded-full border border-[#d9a441]/45 font-['Cinzel',Georgia,serif] text-sm text-[#d9a441]" aria-hidden="true">V</span>
                    <span>Void Studio</span>
                </a>

                <button
                    type="button"
                    class="grid size-12 cursor-pointer place-items-center rounded-full border border-[#f7f2e8]/15 bg-[#11100f]/75 text-[#f7f2e8] outline-offset-4 transition hover:border-[#d9a441]/60 hover:text-[#d9a441] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441] md:hidden"
                    aria-controls="mobile-navigation"
                    x-bind:aria-expanded="navOpen.toString()"
                    x-on:click="navOpen = ! navOpen"
                >
                    <span class="sr-only">Navigation öffnen</span>
                    <span class="relative block h-4 w-5" aria-hidden="true">
                        <span class="absolute left-0 top-0 h-px w-5 bg-current transition duration-200" x-bind:class="navOpen ? 'translate-y-2 rotate-45' : ''"></span>
                        <span class="absolute left-0 top-2 h-px w-5 bg-current transition duration-200" x-bind:class="navOpen ? 'opacity-0' : 'opacity-100'"></span>
                        <span class="absolute bottom-0 left-0 h-px w-5 bg-current transition duration-200" x-bind:class="navOpen ? '-translate-y-2 -rotate-45' : ''"></span>
                    </span>
                </button>
            </div>

            <nav
                id="mobile-navigation"
                x-bind:class="navOpen ? 'grid opacity-100 translate-y-0' : 'hidden opacity-0 -translate-y-2'"
                class="hidden w-full grid-cols-1 gap-2 rounded-[1.25rem] border border-[#f7f2e8]/10 bg-[#11100f]/70 p-2 text-center text-[0.78rem] font-bold uppercase tracking-[0.16em] text-[#b8ac9b] shadow-[0_18px_50px_rgba(0,0,0,0.24)] transition duration-200 md:flex md:w-auto md:translate-y-0 md:items-center md:gap-7 md:border-0 md:bg-transparent md:p-0 md:text-[0.82rem] md:opacity-100 md:shadow-none"
                aria-label="Seitenbereiche"
            >
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#f7f2e8]/5 hover:text-[#f7f2e8] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441] md:px-2 md:py-2 md:hover:bg-transparent" href="#leistungen" x-on:click="navOpen = false">Leistungen</a>
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#f7f2e8]/5 hover:text-[#f7f2e8] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441] md:px-2 md:py-2 md:hover:bg-transparent" href="#arbeiten" x-on:click="navOpen = false">Arbeiten</a>
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#f7f2e8]/5 hover:text-[#f7f2e8] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441] md:px-2 md:py-2 md:hover:bg-transparent" href="#referenzen" x-on:click="navOpen = false">Referenzen</a>
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#f7f2e8]/5 hover:text-[#f7f2e8] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441] md:px-2 md:py-2 md:hover:bg-transparent" href="#prozess" x-on:click="navOpen = false">Prozess</a>
            </nav>

            <a x-bind:class="navOpen ? 'inline-flex' : 'hidden'" class="hidden min-h-12 w-full cursor-pointer items-center justify-center rounded-full border border-[#f7f2e8]/15 px-5 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#d9a441] hover:text-[#d9a441] focus-visible:-translate-y-0.5 focus-visible:border-[#d9a441] focus-visible:text-[#d9a441] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441] md:inline-flex md:w-auto" href="#kontakt" x-on:click="navOpen = false">Projekt starten</a>
        </header>

        <main id="top" class="mx-auto w-[calc(100%_-_2rem)] max-w-[85rem]">
            <section x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="grid min-h-[calc(100vh-6.5rem)] items-end gap-12 py-16 transition duration-700 ease-out lg:grid-cols-[minmax(0,1.08fr)_minmax(20rem,0.92fr)] lg:py-20" aria-labelledby="hero-title">
                <div>
                    <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#d9a441] before:h-px before:w-12 before:bg-[#d9a441]">Designagentur für Markenidentität</p>
                    <h1 id="hero-title" class="mt-7 max-w-[61rem] text-balance font-['Cinzel',Georgia,serif] text-[clamp(4.3rem,11vw,12.8rem)] font-semibold leading-[0.83] tracking-[-0.055em]">
                        We shape the <span class="text-transparent [-webkit-text-stroke:1px_rgba(247,242,232,0.72)]">void</span> into brands.
                    </h1>

                    <div class="mt-10 grid max-w-[51rem] items-end gap-7 md:grid-cols-[minmax(0,0.85fr)_auto]">
                        <p class="m-0 text-[clamp(1.15rem,2vw,1.55rem)] font-normal leading-[1.55] text-[#b8ac9b]">Void Studio entwickelt Logos, Websites und Branding-Systeme für Firmen, die nicht lauter, sondern präziser wahrgenommen werden wollen.</p>

                        <div class="flex flex-wrap gap-3">
                            <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#d9a441] bg-[#d9a441] px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] text-[#12100d] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#f0c46f] hover:bg-[#f0c46f] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441]" href="#kontakt">Brand Audit buchen</a>
                            <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#f7f2e8]/15 px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#d9a441] hover:text-[#d9a441] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441]" href="#arbeiten">Cases ansehen</a>
                        </div>
                    </div>
                </div>

                <aside x-bind:style="reduceMotion ? '' : `transform: perspective(1100px) rotateX(${(mouseY - 50) * -0.025}deg) rotateY(${(mouseX - 50) * 0.035}deg)`" class="relative min-h-[29rem] overflow-hidden rounded-[1.75rem] border border-[#f7f2e8]/15 bg-[linear-gradient(165deg,rgba(255,255,255,0.09),transparent_28%),linear-gradient(145deg,rgba(25,22,19,0.95),rgba(7,7,7,0.98))] shadow-[0_28px_90px_rgba(0,0,0,0.42)] transition-transform duration-300 before:absolute before:inset-7 before:rounded-[1.75rem] before:border before:border-[#d9a441]/30 lg:min-h-[38.75rem] lg:rounded-[2.25rem]" aria-label="Void Studio Markenvisual">
                    <div class="absolute left-1/2 top-1/2 aspect-square w-[min(78vw,32.5rem)] -translate-x-1/2 -translate-y-1/2 animate-spin rounded-full border border-[#d9a441]/30 [animation-duration:34s]" aria-hidden="true">
                        <div class="absolute inset-[5.125rem] rounded-full border border-dashed border-[#f7f2e8]/25"></div>
                        <div class="absolute left-1/2 top-7 size-3.5 -translate-x-1/2 rounded-full bg-[#d9a441] shadow-[0_0_42px_rgba(217,164,65,0.84)]"></div>
                    </div>
                    <div class="absolute inset-0 grid place-items-center font-['Cinzel',Georgia,serif] text-[clamp(8rem,18vw,15rem)] tracking-[-0.12em]" aria-hidden="true">
                        <span>V<span class="text-transparent [-webkit-text-stroke:1px_#d9a441]">S</span></span>
                    </div>

                    <div class="absolute inset-x-5 bottom-5 grid gap-4 rounded-3xl border border-[#f7f2e8]/15 bg-[#070707]/70 p-5 backdrop-blur-xl md:inset-x-7 md:bottom-7 md:p-6">
                        <div class="grid gap-3 md:grid-cols-3">
                            <div class="rounded-[1.125rem] border border-[#f7f2e8]/15 p-4">
                                <strong class="block font-['Cinzel',Georgia,serif] text-2xl leading-none text-[#d9a441]">01</strong>
                                <span class="mt-2 block text-[0.77rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Logo Systems</span>
                            </div>
                            <div class="rounded-[1.125rem] border border-[#f7f2e8]/15 p-4">
                                <strong class="block font-['Cinzel',Georgia,serif] text-2xl leading-none text-[#d9a441]">02</strong>
                                <span class="mt-2 block text-[0.77rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Websites</span>
                            </div>
                            <div class="rounded-[1.125rem] border border-[#f7f2e8]/15 p-4">
                                <strong class="block font-['Cinzel',Georgia,serif] text-2xl leading-none text-[#d9a441]">03</strong>
                                <span class="mt-2 block text-[0.77rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Branding</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>

            <section x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-10 transition duration-700 ease-out lg:py-14" aria-labelledby="client-logos-title">
                <div class="mb-5 flex flex-col gap-3 border-y border-[#f7f2e8]/15 py-5 md:flex-row md:items-center md:justify-between">
                    <h2 id="client-logos-title" class="font-['Cinzel',Georgia,serif] text-sm font-semibold uppercase tracking-[0.22em] text-[#d9a441]">Referenzen aus Markenarbeit, Web und Identität</h2>
                    <p class="max-w-2xl text-sm font-normal uppercase tracking-[0.18em] text-[#75695c]">Auswahl kuratierter Brand-Systeme für Startups, Mittelstand und spezialisierte B2B-Teams</p>
                </div>

                <div class="grid grid-cols-2 gap-3 md:grid-cols-4 xl:grid-cols-8" aria-label="Ausgewählte Kundenlogos">
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="font-['Cinzel',Georgia,serif] text-lg font-semibold tracking-[-0.04em] text-[#f7f2e8]">Nova<br><span class="text-[#d9a441]">Ledger</span></span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="text-sm font-bold uppercase tracking-[0.28em] text-[#b8ac9b]">Atlas<br>Works</span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="font-['Cinzel',Georgia,serif] text-2xl tracking-[-0.08em] text-[#f7f2e8]">LUMA</span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-[0.18em] text-[#b8ac9b]"><span class="size-3 rounded-full bg-[#d9a441]"></span>Orbit</span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="font-['Cinzel',Georgia,serif] text-xl text-[#f7f2e8]">KERNO</span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="text-xs font-bold uppercase tracking-[0.3em] text-[#b8ac9b]">Northline</span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="font-['Cinzel',Georgia,serif] text-lg text-[#f7f2e8]">Valeo<br><span class="text-sm tracking-[0.18em] text-[#d9a441]">Objects</span></span>
                    </div>
                    <div class="group grid min-h-28 place-items-center rounded-2xl border border-[#f7f2e8]/15 bg-[#11100f]/60 p-4 text-center transition hover:border-[#d9a441]/45 hover:bg-[#191613]/80">
                        <span class="text-sm font-bold uppercase tracking-[0.22em] text-[#b8ac9b]">Monolith<br>Law</span>
                    </div>
                </div>
            </section>

            <section id="leistungen" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out lg:py-20" aria-labelledby="services-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#d9a441] before:h-px before:w-12 before:bg-[#d9a441]">Was wir bauen</p>
                        <h2 id="services-title" class="mt-5 text-balance font-['Cinzel',Georgia,serif] text-[clamp(2.8rem,6vw,7rem)] font-semibold leading-[0.9] tracking-[-0.055em]">Design mit System. Auftritt mit Schwerkraft.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#b8ac9b]">Jede Marke bekommt eine klare visuelle Sprache: wiedererkennbar im Logo, konsistent auf der Website und belastbar in jedem Touchpoint.</p>
                </div>

                <div class="grid gap-5 lg:grid-cols-3">
                    <article class="group relative min-h-[22.5rem] overflow-hidden rounded-[1.875rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur transition hover:-translate-y-1.5 hover:border-[#d9a441]/45 hover:bg-[#191613]/90">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">/ 01</span>
                        <svg class="absolute right-7 top-7 size-16 text-[#d9a441]/75" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                            <path d="M32 7L55 20V44L32 57L9 44V20L32 7Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M32 18L45 25.5V39L32 46.5L19 39V25.5L32 18Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <h3 class="mt-20 font-['Cinzel',Georgia,serif] text-[clamp(1.8rem,3vw,3rem)] font-semibold leading-none tracking-[-0.04em]">Logo Systeme</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Prägnante Zeichen, Wortmarken und flexible Logo-Familien, die in kleinen Icons und großen Kampagnen gleich stark funktionieren.</p>
                    </article>

                    <article class="group relative min-h-[22.5rem] overflow-hidden rounded-[1.875rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur transition hover:-translate-y-1.5 hover:border-[#d9a441]/45 hover:bg-[#191613]/90">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">/ 02</span>
                        <svg class="absolute right-7 top-7 size-16 text-[#d9a441]/75" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                            <path d="M10 16H54V48H10V16Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M18 25H46M18 33H34M18 41H42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <h3 class="mt-20 font-['Cinzel',Georgia,serif] text-[clamp(1.8rem,3vw,3rem)] font-semibold leading-none tracking-[-0.04em]">Websites</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Editoriale Landingpages, Corporate Websites und digitale Markenräume mit klarer Informationsarchitektur und hochwertigen Details.</p>
                    </article>

                    <article class="group relative min-h-[22.5rem] overflow-hidden rounded-[1.875rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur transition hover:-translate-y-1.5 hover:border-[#d9a441]/45 hover:bg-[#191613]/90">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">/ 03</span>
                        <svg class="absolute right-7 top-7 size-16 text-[#d9a441]/75" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                            <path d="M14 14H30V30H14V14ZM34 14H50V30H34V14ZM14 34H30V50H14V34ZM34 34H50V50H34V34Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <h3 class="mt-20 font-['Cinzel',Georgia,serif] text-[clamp(1.8rem,3vw,3rem)] font-semibold leading-none tracking-[-0.04em]">Branding</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Farbwelten, Typografie, Bildsprache, Brand Guidelines und Templates, damit Teams ihre Marke sicher weiterführen können.</p>
                    </article>
                </div>

                <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    <article class="group relative overflow-hidden rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/70 p-6 shadow-[0_18px_60px_rgba(0,0,0,0.18)] backdrop-blur transition hover:-translate-y-1 hover:border-[#d9a441]/45">
                        <div class="mb-16 flex items-center justify-between">
                            <span class="rounded-full border border-[#d9a441]/35 px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.16em] text-[#d9a441]">Food Brand</span>
                            <span class="font-['Cinzel',Georgia,serif] text-4xl text-[#f7f2e8]/20">03</span>
                        </div>
                        <h3 class="font-['Cinzel',Georgia,serif] text-3xl font-semibold leading-none tracking-[-0.04em]">Luma Foods</h3>
                        <p class="mt-4 text-base font-normal leading-[1.65] text-[#b8ac9b]">Packaging-System, Wortmarke und Website für eine Premium-Food-Marke mit klarer Shelf-Präsenz.</p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/70 p-6 shadow-[0_18px_60px_rgba(0,0,0,0.18)] backdrop-blur transition hover:-translate-y-1 hover:border-[#d9a441]/45">
                        <div class="mb-16 flex items-center justify-between">
                            <span class="rounded-full border border-[#d9a441]/35 px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.16em] text-[#d9a441]">Health Tech</span>
                            <span class="font-['Cinzel',Georgia,serif] text-4xl text-[#f7f2e8]/20">04</span>
                        </div>
                        <h3 class="font-['Cinzel',Georgia,serif] text-3xl font-semibold leading-none tracking-[-0.04em]">Orbit Health</h3>
                        <p class="mt-4 text-base font-normal leading-[1.65] text-[#b8ac9b]">Vertrauenswürdige visuelle Identität, UI-System und Launch-Landingpage für digitale Diagnostik.</p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/70 p-6 shadow-[0_18px_60px_rgba(0,0,0,0.18)] backdrop-blur transition hover:-translate-y-1 hover:border-[#d9a441]/45">
                        <div class="mb-16 flex items-center justify-between">
                            <span class="rounded-full border border-[#d9a441]/35 px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.16em] text-[#d9a441]">AI SaaS</span>
                            <span class="font-['Cinzel',Georgia,serif] text-4xl text-[#f7f2e8]/20">05</span>
                        </div>
                        <h3 class="font-['Cinzel',Georgia,serif] text-3xl font-semibold leading-none tracking-[-0.04em]">Kerno AI</h3>
                        <p class="mt-4 text-base font-normal leading-[1.65] text-[#b8ac9b]">Markenarchitektur, Produktvisuals und Website für ein technisches Tool mit Enterprise-Fokus.</p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/70 p-6 shadow-[0_18px_60px_rgba(0,0,0,0.18)] backdrop-blur transition hover:-translate-y-1 hover:border-[#d9a441]/45">
                        <div class="mb-16 flex items-center justify-between">
                            <span class="rounded-full border border-[#d9a441]/35 px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.16em] text-[#d9a441]">Legal</span>
                            <span class="font-['Cinzel',Georgia,serif] text-4xl text-[#f7f2e8]/20">06</span>
                        </div>
                        <h3 class="font-['Cinzel',Georgia,serif] text-3xl font-semibold leading-none tracking-[-0.04em]">Monolith Law</h3>
                        <p class="mt-4 text-base font-normal leading-[1.65] text-[#b8ac9b]">Reduziertes Corporate Design, Editorial-Website und Vorlagen für eine spezialisierte Kanzlei.</p>
                    </article>
                </div>
            </section>

            <section id="arbeiten" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out lg:py-20" aria-labelledby="work-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#d9a441] before:h-px before:w-12 before:bg-[#d9a441]">Ausgewählte Richtungen</p>
                        <h2 id="work-title" class="mt-5 text-balance font-['Cinzel',Georgia,serif] text-[clamp(2.8rem,6vw,7rem)] font-semibold leading-[0.9] tracking-[-0.055em]">Strategie wird sichtbar, bevor sie erklärt werden muss.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#b8ac9b]">Void Studio arbeitet mit Gründern, B2B-Teams und etablierten Firmen, die visuelle Klarheit als Wachstumswerkzeug verstehen.</p>
                </div>

                <div class="grid gap-5 lg:grid-cols-[1.18fr_0.82fr]">
                    <article class="relative min-h-[29rem] overflow-hidden rounded-[2.125rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-7 pt-[18rem] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur md:min-h-[34.375rem] md:pt-[21rem]">
                        <div class="absolute inset-x-7 top-7 h-[48%] rounded-[1.625rem] border border-[#d9a441]/30 bg-[linear-gradient(135deg,rgba(217,164,65,0.2),transparent_38%),repeating-linear-gradient(90deg,rgba(247,242,232,0.08)_0_1px,transparent_1px_18px),#0a0a0a] before:absolute before:inset-8 before:rounded-full before:border before:border-[#f7f2e8]/20" aria-hidden="true"></div>
                        <h3 class="relative z-10 font-['Cinzel',Georgia,serif] text-[clamp(1.8rem,3vw,3rem)] font-semibold leading-none tracking-[-0.04em]">Nova Ledger</h3>
                        <p class="relative z-10 mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Rebranding für eine Finance-Plattform: präzise Wortmarke, dunkles Interface-System und ein Vertrauensauftritt für Enterprise-Kunden.</p>
                        <div class="relative z-10 mt-6 flex flex-wrap gap-2.5" aria-label="Projektleistungen">
                            <span class="rounded-full border border-[#f7f2e8]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Brand Strategy</span>
                            <span class="rounded-full border border-[#f7f2e8]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Logo</span>
                            <span class="rounded-full border border-[#f7f2e8]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Website</span>
                        </div>
                    </article>

                    <article class="relative min-h-[29rem] overflow-hidden rounded-[2.125rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-7 pt-[18rem] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <div class="absolute inset-x-7 top-7 h-[48%] rounded-[1.625rem] border border-[#d9a441]/30 bg-[linear-gradient(135deg,rgba(217,164,65,0.2),transparent_38%),repeating-linear-gradient(90deg,rgba(247,242,232,0.08)_0_1px,transparent_1px_18px),#0a0a0a] before:absolute before:inset-8 before:rounded-full before:border before:border-[#f7f2e8]/20" aria-hidden="true"></div>
                        <h3 class="relative z-10 font-['Cinzel',Georgia,serif] text-[clamp(1.8rem,3vw,3rem)] font-semibold leading-none tracking-[-0.04em]">Atlas Works</h3>
                        <p class="relative z-10 mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Markensystem für ein Architekturbüro mit reduzierter Typografie, modularen Layouts und einer Website, die Projekte groß wirken lässt.</p>
                        <div class="relative z-10 mt-6 flex flex-wrap gap-2.5" aria-label="Projektleistungen">
                            <span class="rounded-full border border-[#f7f2e8]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Identity</span>
                            <span class="rounded-full border border-[#f7f2e8]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#b8ac9b]">Editorial Web</span>
                        </div>
                    </article>
                </div>
            </section>

            <section id="referenzen" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out lg:py-20" aria-labelledby="references-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#d9a441] before:h-px before:w-12 before:bg-[#d9a441]">Referenzen</p>
                        <h2 id="references-title" class="mt-5 text-balance font-['Cinzel',Georgia,serif] text-[clamp(2.8rem,6vw,7rem)] font-semibold leading-[0.9] tracking-[-0.055em]">Marken, die nach dem Launch klarer verkaufen.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#b8ac9b]">Vom ersten Brand Audit bis zum finalen Designsystem liefert Void Studio die Assets, mit denen Teams konsistent auftreten und schneller entscheiden.</p>
                </div>

                <div class="grid gap-5 lg:grid-cols-3">
                    <figure class="flex min-h-[23rem] flex-col justify-between rounded-[1.875rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <blockquote class="text-2xl font-normal leading-[1.35] text-[#f7f2e8]">„Void Studio hat unsere Marke von technisch korrekt zu wirklich begehrenswert gehoben. Das neue System ist mutig, aber extrem einfach anzuwenden.“</blockquote>
                        <figcaption class="mt-10 border-t border-[#f7f2e8]/15 pt-5">
                            <strong class="block font-['Cinzel',Georgia,serif] text-xl font-semibold text-[#d9a441]">Mara Kessler</strong>
                            <span class="mt-1 block text-sm font-bold uppercase tracking-[0.16em] text-[#75695c]">Founder, Nova Ledger</span>
                        </figcaption>
                    </figure>

                    <figure class="flex min-h-[23rem] flex-col justify-between rounded-[1.875rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <blockquote class="text-2xl font-normal leading-[1.35] text-[#f7f2e8]">„Die Website fühlt sich an wie unser bestes Projektmeeting: reduziert, präzise und voller Atmosphäre. Kunden verstehen jetzt sofort, wofür wir stehen.“</blockquote>
                        <figcaption class="mt-10 border-t border-[#f7f2e8]/15 pt-5">
                            <strong class="block font-['Cinzel',Georgia,serif] text-xl font-semibold text-[#d9a441]">Jonas Arendt</strong>
                            <span class="mt-1 block text-sm font-bold uppercase tracking-[0.16em] text-[#75695c]">Partner, Atlas Works</span>
                        </figcaption>
                    </figure>

                    <div class="grid gap-5">
                        <div class="rounded-[1.875rem] border border-[#d9a441]/40 bg-[linear-gradient(135deg,rgba(217,164,65,0.15),rgba(17,16,15,0.78))] p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)]">
                            <span class="block font-['Cinzel',Georgia,serif] text-[clamp(3.5rem,7vw,6rem)] font-semibold leading-none tracking-[-0.06em] text-[#d9a441]">38%</span>
                            <p class="mt-4 text-base font-normal leading-[1.65] text-[#b8ac9b]">mehr qualifizierte Anfragen nach Relaunch und Markenklärung bei ausgewählten Projekten.</p>
                        </div>
                        <div class="rounded-[1.875rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)]">
                            <span class="block font-['Cinzel',Georgia,serif] text-[clamp(3.5rem,7vw,6rem)] font-semibold leading-none tracking-[-0.06em] text-[#f7f2e8]">24</span>
                            <p class="mt-4 text-base font-normal leading-[1.65] text-[#b8ac9b]">Brand Assets im durchschnittlichen Übergabepaket: Logo-Files, Guidelines, Templates und Web-Komponenten.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out lg:py-20" aria-label="Void Studio Manifest">
                <div class="grid gap-5 lg:grid-cols-[minmax(0,0.72fr)_minmax(20rem,0.28fr)]">
                    <p class="m-0 rounded-[1.75rem] border border-[#d9a441]/45 bg-[linear-gradient(135deg,rgba(217,164,65,0.13),rgba(17,16,15,0.78))] p-9 text-balance font-['Cinzel',Georgia,serif] text-[clamp(2.8rem,6.5vw,7.8rem)] font-semibold leading-[0.92] tracking-[-0.055em] md:rounded-[2.375rem] md:p-16">Less noise. More nerve.</p>
                    <div class="flex flex-col justify-between gap-8 rounded-[1.75rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-8 md:rounded-[2.125rem]">
                        <p class="m-0 text-lg font-normal leading-[1.65] text-[#b8ac9b]">Wir reduzieren Marken auf das, was sie unverwechselbar macht, und geben diesem Kern eine Form, die im Markt stehen bleibt.</p>
                        <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#f7f2e8]/15 px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#d9a441] hover:text-[#d9a441] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441]" href="#kontakt">Erstgespräch anfragen</a>
                    </div>
                </div>
            </section>

            <section id="prozess" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out lg:py-20" aria-labelledby="process-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#d9a441] before:h-px before:w-12 before:bg-[#d9a441]">Der Ablauf</p>
                        <h2 id="process-title" class="mt-5 text-balance font-['Cinzel',Georgia,serif] text-[clamp(2.8rem,6vw,7rem)] font-semibold leading-[0.9] tracking-[-0.055em]">Vom leeren Raum zur führenden Marke.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#b8ac9b]">Ein schlanker Prozess mit klaren Entscheidungen, schnellen Prototypen und finalen Assets, die direkt nutzbar sind.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <article class="min-h-64 rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">01</span>
                        <h3 class="mt-14 font-['Cinzel',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Audit</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Markt, Zielgruppen und bestehende Wahrnehmung werden verdichtet.</p>
                    </article>
                    <article class="min-h-64 rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">02</span>
                        <h3 class="mt-14 font-['Cinzel',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Concept</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Positionierung, Look Direction und erste visuelle Systeme entstehen.</p>
                    </article>
                    <article class="min-h-64 rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">03</span>
                        <h3 class="mt-14 font-['Cinzel',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Build</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Logo, Website und Brand Assets werden sauber ausgearbeitet.</p>
                    </article>
                    <article class="min-h-64 rounded-[1.625rem] border border-[#f7f2e8]/15 bg-[#11100f]/75 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Cinzel',Georgia,serif] text-sm tracking-[0.18em] text-[#d9a441]">04</span>
                        <h3 class="mt-14 font-['Cinzel',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Launch</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#b8ac9b]">Guidelines, Übergabe und Rollout bringen die Marke in Bewegung.</p>
                    </article>
                </div>
            </section>

            <section id="kontakt" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out lg:py-20" aria-labelledby="contact-title">
                <div class="grid items-center gap-8 rounded-[1.75rem] border border-[#d9a441]/45 bg-[radial-gradient(circle_at_88%_20%,rgba(217,164,65,0.18),transparent_22rem),rgba(17,16,15,0.86)] p-9 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur lg:grid-cols-[minmax(0,0.9fr)_auto] lg:rounded-[2.5rem] lg:p-16">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#d9a441] before:h-px before:w-12 before:bg-[#d9a441]">Neue Identität</p>
                        <h2 id="contact-title" class="mt-5 max-w-[52rem] text-balance font-['Cinzel',Georgia,serif] text-[clamp(2.8rem,7vw,8rem)] font-semibold leading-[0.9] tracking-[-0.055em]">Bereit für eine Marke, die nicht austauschbar wirkt?</h2>
                        <p class="mt-6 max-w-xl text-lg font-normal leading-[1.6] text-[#b8ac9b]">Schick uns eine kurze Projektbeschreibung. Wir melden uns mit einer klaren Einschätzung zu Scope, Timing und nächstem Schritt.</p>
                    </div>
                    <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#d9a441] bg-[#d9a441] px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] text-[#12100d] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#f0c46f] hover:bg-[#f0c46f] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#d9a441]" href="mailto:hello@void.studio?subject=Projektanfrage%20Void%20Studio">hello@void.studio</a>
                </div>
            </section>
        </main>

        <footer class="mx-auto flex w-[calc(100%_-_2rem)] max-w-[85rem] flex-col gap-3 py-9 text-[0.82rem] font-bold uppercase tracking-[0.14em] text-[#75695c] md:flex-row md:items-center md:justify-between">
            <span>Void Studio</span>
            <span>Logos / Websites / Branding</span>
            <span>{{ now()->year }}</span>
        </footer>
    </body>
</html>
