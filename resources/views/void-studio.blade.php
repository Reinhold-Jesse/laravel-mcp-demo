<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Void Studio ist ein professioneller Design-Shop für Logos, Websites und Branding-Systeme für moderne Firmen.">

        <title>Void Studio - Logos, Websites und Branding</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=libre-bodoni:400,500,600,700|public-sans:300,400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{ navOpen: false, activePackage: 'brand', mouseX: 50, mouseY: 18, reduceMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches }"
        x-on:mousemove.window="if (! reduceMotion) { mouseX = Math.round(($event.clientX / window.innerWidth) * 100); mouseY = Math.round(($event.clientY / window.innerHeight) * 100) }"
        class="min-h-screen overflow-x-hidden bg-[#090806] bg-[radial-gradient(circle_at_12%_8%,rgba(202,138,4,0.18),transparent_28rem),radial-gradient(circle_at_88%_12%,rgba(250,250,249,0.08),transparent_26rem),linear-gradient(145deg,#090806_0%,#1c1917_48%,#050403_100%)] font-['Public_Sans',ui-sans-serif,system-ui,sans-serif] text-[#fafaf9] antialiased selection:bg-[#ca8a04] selection:text-[#0c0a09]"
    >
        <div class="pointer-events-none fixed inset-0 -z-20 bg-[linear-gradient(rgba(250,250,249,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(250,250,249,0.035)_1px,transparent_1px)] [background-size:72px_72px] [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.95),transparent_86%)]"></div>
        <div class="pointer-events-none fixed inset-0 -z-10 opacity-[0.07] mix-blend-soft-light [background-image:radial-gradient(circle_at_center,#fafaf9_1px,transparent_1px)] [background-size:17px_17px]"></div>
        <div x-bind:style="`background: radial-gradient(circle at ${mouseX}% ${mouseY}%, rgba(202,138,4,0.16), transparent 24rem)`" class="pointer-events-none fixed inset-0 -z-10 transition-[background] duration-300 motion-reduce:transition-none"></div>

        <header class="sticky top-4 z-50 mx-auto mt-4 flex w-[calc(100%_-_2rem)] max-w-7xl flex-col gap-3 rounded-[1.625rem] border border-[#fafaf9]/15 bg-[#090806]/80 px-3 py-3 shadow-[0_18px_70px_rgba(0,0,0,0.32)] backdrop-blur-xl md:flex-row md:items-center md:justify-between md:rounded-full md:pl-5" aria-label="Hauptnavigation" x-on:keydown.escape.window="navOpen = false">
            <div class="flex w-full items-center justify-between gap-4 md:w-auto">
                <a class="inline-flex items-center gap-3 text-sm font-bold uppercase tracking-[0.22em] outline-offset-4 transition-colors hover:text-[#ca8a04] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" href="#top" aria-label="Void Studio Startseite" x-on:click="navOpen = false">
                    <span class="grid size-10 place-items-center rounded-full border border-[#ca8a04]/55 font-['Libre_Bodoni',Georgia,serif] text-lg font-semibold text-[#ca8a04]" aria-hidden="true">V</span>
                    <span>Void Studio</span>
                </a>

                <button
                    type="button"
                    class="grid size-12 cursor-pointer place-items-center rounded-full border border-[#fafaf9]/15 bg-[#1c1917]/75 text-[#fafaf9] outline-offset-4 transition hover:border-[#ca8a04]/70 hover:text-[#ca8a04] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:hidden"
                    aria-controls="site-navigation"
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
                id="site-navigation"
                x-bind:class="navOpen ? 'grid opacity-100 translate-y-0' : 'hidden opacity-0 -translate-y-2'"
                class="hidden w-full grid-cols-1 gap-2 rounded-[1.25rem] border border-[#fafaf9]/10 bg-[#1c1917]/80 p-2 text-center text-[0.78rem] font-bold uppercase tracking-[0.16em] text-[#d6d3d1] shadow-[0_18px_50px_rgba(0,0,0,0.24)] transition duration-200 md:flex md:w-auto md:translate-y-0 md:items-center md:gap-7 md:border-0 md:bg-transparent md:p-0 md:opacity-100 md:shadow-none"
                aria-label="Seitenbereiche"
            >
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#fafaf9]/5 hover:text-[#fafaf9] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:px-2 md:py-2 md:hover:bg-transparent" href="#shop" x-on:click="navOpen = false">Shop</a>
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#fafaf9]/5 hover:text-[#fafaf9] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:px-2 md:py-2 md:hover:bg-transparent" href="#leistungen" x-on:click="navOpen = false">Leistungen</a>
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#fafaf9]/5 hover:text-[#fafaf9] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:px-2 md:py-2 md:hover:bg-transparent" href="#arbeiten" x-on:click="navOpen = false">Arbeiten</a>
                <a class="rounded-full px-4 py-3 outline-offset-4 transition-colors hover:bg-[#fafaf9]/5 hover:text-[#fafaf9] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:px-2 md:py-2 md:hover:bg-transparent" href="#prozess" x-on:click="navOpen = false">Prozess</a>
            </nav>

            <a class="hidden min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#ca8a04] bg-[#ca8a04] px-5 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] text-[#0c0a09] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#eab308] hover:bg-[#eab308] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:inline-flex" href="#kontakt">Projekt starten</a>
            <a x-show="navOpen" x-transition.opacity.duration.200ms style="display: none;" class="inline-flex min-h-12 w-full cursor-pointer items-center justify-center rounded-full border border-[#ca8a04] bg-[#ca8a04] px-5 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] text-[#0c0a09] outline-offset-4 transition hover:border-[#eab308] hover:bg-[#eab308] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04] md:hidden" href="#kontakt" x-on:click="navOpen = false">Projekt starten</a>
        </header>

        <main id="top" class="mx-auto w-[calc(100%_-_2rem)] max-w-7xl">
            <section x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="grid min-h-[calc(100svh-6rem)] items-center gap-10 py-12 transition duration-700 ease-out motion-reduce:transition-none sm:py-16 lg:grid-cols-[minmax(0,1.06fr)_minmax(20rem,0.94fr)] lg:items-end lg:gap-12 lg:py-20" aria-labelledby="hero-title">
                <div>
                    <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#ca8a04] before:h-px before:w-12 before:bg-[#ca8a04]">Design-Shop für starke Firmen</p>
                    <h1 id="hero-title" class="mt-7 max-w-[62rem] text-balance font-['Libre_Bodoni',Georgia,serif] text-[clamp(3.25rem,13vw,12rem)] font-semibold leading-[0.86] tracking-[-0.058em] sm:leading-[0.84] lg:tracking-[-0.065em]">
                        Logos, Websites und Branding aus dem <span class="text-transparent [-webkit-text-stroke:1px_rgba(250,250,249,0.74)]">Void</span>.
                    </h1>

                    <div class="mt-10 grid max-w-[53rem] items-end gap-7 md:grid-cols-[minmax(0,0.88fr)_auto]">
                        <p class="m-0 text-[clamp(1.08rem,2vw,1.5rem)] font-normal leading-[1.62] text-[#d6d3d1]">Void Studio übersetzt Positionierung in visuelle Systeme, die verkaufen: präzise Logos, hochwertige Websites und Brand Kits, die Teams direkt einsetzen können.</p>

                        <div class="flex flex-wrap gap-3">
                            <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#ca8a04] bg-[#ca8a04] px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] text-[#0c0a09] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#eab308] hover:bg-[#eab308] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" href="#shop">Pakete ansehen</a>
                            <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#fafaf9]/15 px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#ca8a04] hover:text-[#ca8a04] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" href="#arbeiten">Cases ansehen</a>
                        </div>
                    </div>
                </div>

                <aside x-bind:style="reduceMotion ? '' : `transform: perspective(1100px) rotateX(${(mouseY - 50) * -0.025}deg) rotateY(${(mouseX - 50) * 0.035}deg)`" class="relative min-h-[27rem] overflow-hidden rounded-[1.75rem] border border-[#fafaf9]/15 bg-[linear-gradient(165deg,rgba(250,250,249,0.1),transparent_30%),linear-gradient(145deg,rgba(68,64,60,0.9),rgba(9,8,6,0.98))] shadow-[0_34px_100px_rgba(0,0,0,0.48)] transition-transform duration-300 before:absolute before:inset-5 before:rounded-[1.75rem] before:border before:border-[#ca8a04]/30 motion-reduce:transition-none sm:min-h-[30rem] sm:before:inset-7 lg:min-h-[39rem] lg:rounded-[2.25rem]" aria-label="Void Studio Markenvisual">
                    <div class="absolute left-1/2 top-1/2 aspect-square w-[min(78vw,32rem)] -translate-x-1/2 -translate-y-1/2 animate-spin rounded-full border border-[#ca8a04]/30 motion-reduce:animate-none [animation-duration:38s]" aria-hidden="true">
                        <div class="absolute inset-[5.25rem] rounded-full border border-dashed border-[#fafaf9]/25"></div>
                        <div class="absolute left-1/2 top-7 size-3.5 -translate-x-1/2 rounded-full bg-[#ca8a04] shadow-[0_0_44px_rgba(202,138,4,0.86)]"></div>
                    </div>
                    <div class="absolute inset-0 grid place-items-center font-['Libre_Bodoni',Georgia,serif] text-[clamp(8rem,18vw,15rem)] tracking-[-0.13em]" aria-hidden="true">
                        <span>V<span class="text-transparent [-webkit-text-stroke:1px_#ca8a04]">S</span></span>
                    </div>

                    <div class="absolute inset-x-5 bottom-5 grid gap-4 rounded-3xl border border-[#fafaf9]/15 bg-[#090806]/72 p-5 backdrop-blur-xl md:inset-x-7 md:bottom-7 md:p-6">
                        <div class="flex items-center justify-between gap-5 border-b border-[#fafaf9]/15 pb-4">
                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#a8a29e]">Signature System</span>
                            <span class="rounded-full border border-[#ca8a04]/40 px-3 py-1 text-xs font-bold uppercase tracking-[0.16em] text-[#ca8a04]">Launch Ready</span>
                        </div>
                        <div class="grid gap-3 md:grid-cols-3">
                            <div class="rounded-[1.125rem] border border-[#fafaf9]/15 p-4">
                                <strong class="block font-['Libre_Bodoni',Georgia,serif] text-3xl leading-none text-[#ca8a04]">01</strong>
                                <span class="mt-2 block text-[0.76rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Logo System</span>
                            </div>
                            <div class="rounded-[1.125rem] border border-[#fafaf9]/15 p-4">
                                <strong class="block font-['Libre_Bodoni',Georgia,serif] text-3xl leading-none text-[#ca8a04]">02</strong>
                                <span class="mt-2 block text-[0.76rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Website</span>
                            </div>
                            <div class="rounded-[1.125rem] border border-[#fafaf9]/15 p-4">
                                <strong class="block font-['Libre_Bodoni',Georgia,serif] text-3xl leading-none text-[#ca8a04]">03</strong>
                                <span class="mt-2 block text-[0.76rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Brand Kit</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>

            <section id="shop" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out motion-reduce:transition-none lg:py-20" aria-labelledby="shop-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#ca8a04] before:h-px before:w-12 before:bg-[#ca8a04]">Studio-Shop</p>
                        <h2 id="shop-title" class="mt-5 text-balance font-['Libre_Bodoni',Georgia,serif] text-[clamp(2.45rem,6vw,7rem)] font-semibold leading-[0.92] tracking-[-0.055em] sm:leading-[0.9]">Wähle ein Paket. Wir bauen den Auftritt.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#d6d3d1]">Produktisierte Designpakete geben deinem Projekt einen klaren Scope, feste Lieferobjekte und genug Raum für eine maßgeschneiderte visuelle Richtung.</p>
                </div>

                <div class="mb-6 flex flex-wrap gap-3" role="tablist" aria-label="Paketfilter">
                    <button type="button" role="tab" class="cursor-pointer rounded-full border px-5 py-3 text-sm font-bold uppercase tracking-[0.14em] outline-offset-4 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" x-bind:aria-selected="(activePackage === 'brand').toString()" x-bind:class="activePackage === 'brand' ? 'border-[#ca8a04] bg-[#ca8a04] text-[#0c0a09] shadow-[0_12px_34px_rgba(202,138,4,0.24)]' : 'border-[#fafaf9]/20 bg-[#fafaf9]/5 text-[#d6d3d1] hover:border-[#ca8a04] hover:text-[#ca8a04]'" x-on:click="activePackage = 'brand'">Brand</button>
                    <button type="button" role="tab" class="cursor-pointer rounded-full border px-5 py-3 text-sm font-bold uppercase tracking-[0.14em] outline-offset-4 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" x-bind:aria-selected="(activePackage === 'web').toString()" x-bind:class="activePackage === 'web' ? 'border-[#ca8a04] bg-[#ca8a04] text-[#0c0a09] shadow-[0_12px_34px_rgba(202,138,4,0.24)]' : 'border-[#fafaf9]/20 bg-[#fafaf9]/5 text-[#d6d3d1] hover:border-[#ca8a04] hover:text-[#ca8a04]'" x-on:click="activePackage = 'web'">Web</button>
                    <button type="button" role="tab" class="cursor-pointer rounded-full border px-5 py-3 text-sm font-bold uppercase tracking-[0.14em] outline-offset-4 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" x-bind:aria-selected="(activePackage === 'launch').toString()" x-bind:class="activePackage === 'launch' ? 'border-[#ca8a04] bg-[#ca8a04] text-[#0c0a09] shadow-[0_12px_34px_rgba(202,138,4,0.24)]' : 'border-[#fafaf9]/20 bg-[#fafaf9]/5 text-[#d6d3d1] hover:border-[#ca8a04] hover:text-[#ca8a04]'" x-on:click="activePackage = 'launch'">Launch</button>
                </div>

                <div class="grid gap-5 lg:grid-cols-3">
                    <article x-bind:class="activePackage === 'brand' ? 'border-[#ca8a04]/70 bg-[#1c1917]/90' : 'border-[#fafaf9]/15 bg-[#15110f]/80'" class="relative overflow-hidden rounded-[1.875rem] border p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur transition duration-300 hover:-translate-y-1.5 hover:border-[#ca8a04]/60 motion-reduce:transition-none">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#ca8a04]">Logo + Identity</span>
                                <h3 class="mt-5 font-['Libre_Bodoni',Georgia,serif] text-4xl font-semibold leading-none tracking-[-0.05em]">Brand Core</h3>
                            </div>
                            <svg class="size-14 text-[#ca8a04]" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                <path d="M32 7L55 20V44L32 57L9 44V20L32 7Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M32 18L45 25.5V39L32 46.5L19 39V25.5L32 18Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <p class="mt-7 text-base font-normal leading-[1.7] text-[#d6d3d1]">Ein prägnantes Logo-System mit Farben, Typografie, Mini-Guideline und Social-Assets für den professionellen Start.</p>
                        <p class="mt-8 font-['Libre_Bodoni',Georgia,serif] text-5xl font-semibold tracking-[-0.06em] text-[#fafaf9]">ab 2.900 €</p>
                        <ul class="mt-7 grid gap-3 text-sm font-medium text-[#d6d3d1]">
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Logo-Set mit Wortmarke und Signet</li>
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Farbwelt, Typografie und Brand Regeln</li>
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Übergabepaket für Web und Print</li>
                        </ul>
                    </article>

                    <article x-bind:class="activePackage === 'web' ? 'border-[#ca8a04]/70 bg-[#1c1917]/90' : 'border-[#fafaf9]/15 bg-[#15110f]/80'" class="relative overflow-hidden rounded-[1.875rem] border p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur transition duration-300 hover:-translate-y-1.5 hover:border-[#ca8a04]/60 motion-reduce:transition-none">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#ca8a04]">Website Design</span>
                                <h3 class="mt-5 font-['Libre_Bodoni',Georgia,serif] text-4xl font-semibold leading-none tracking-[-0.05em]">Web Presence</h3>
                            </div>
                            <svg class="size-14 text-[#ca8a04]" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                <path d="M10 16H54V48H10V16Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M18 25H46M18 33H34M18 41H42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <p class="mt-7 text-base font-normal leading-[1.7] text-[#d6d3d1]">Eine conversionstarke Website mit klarer Story, hochwertigem Interface und responsive Layout für Landingpage oder Firmenauftritt.</p>
                        <p class="mt-8 font-['Libre_Bodoni',Georgia,serif] text-5xl font-semibold tracking-[-0.06em] text-[#fafaf9]">ab 4.800 €</p>
                        <ul class="mt-7 grid gap-3 text-sm font-medium text-[#d6d3d1]">
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>UX-Struktur, Copy-Richtung und Design</li>
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Responsive Sections und Interaktionen</li>
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Launch-ready Übergabe an Entwicklung</li>
                        </ul>
                    </article>

                    <article x-bind:class="activePackage === 'launch' ? 'border-[#ca8a04]/70 bg-[#1c1917]/90' : 'border-[#fafaf9]/15 bg-[#15110f]/80'" class="relative overflow-hidden rounded-[1.875rem] border p-8 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur transition duration-300 hover:-translate-y-1.5 hover:border-[#ca8a04]/60 motion-reduce:transition-none">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#ca8a04]">Full Branding</span>
                                <h3 class="mt-5 font-['Libre_Bodoni',Georgia,serif] text-4xl font-semibold leading-none tracking-[-0.05em]">Market Launch</h3>
                            </div>
                            <svg class="size-14 text-[#ca8a04]" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                <path d="M14 14H30V30H14V14ZM34 14H50V30H34V14ZM14 34H30V50H14V34ZM34 34H50V50H34V34Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <p class="mt-7 text-base font-normal leading-[1.7] text-[#d6d3d1]">Das komplette Paket für Firmen, die einen starken Relaunch brauchen: Strategie, Identität, Website und Brand Assets.</p>
                        <p class="mt-8 font-['Libre_Bodoni',Georgia,serif] text-5xl font-semibold tracking-[-0.06em] text-[#fafaf9]">ab 8.900 €</p>
                        <ul class="mt-7 grid gap-3 text-sm font-medium text-[#d6d3d1]">
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Positionierung und visuelle Leitidee</li>
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Logo, Website und Template-System</li>
                            <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-[#ca8a04]"></span>Guidelines für interne Teams</li>
                        </ul>
                    </article>
                </div>
            </section>

            <section id="leistungen" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out motion-reduce:transition-none lg:py-20" aria-labelledby="services-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#ca8a04] before:h-px before:w-12 before:bg-[#ca8a04]">Was entsteht</p>
                        <h2 id="services-title" class="mt-5 text-balance font-['Libre_Bodoni',Georgia,serif] text-[clamp(2.45rem,6vw,7rem)] font-semibold leading-[0.92] tracking-[-0.055em] sm:leading-[0.9]">Design mit System. Auftritt mit Schwerkraft.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#d6d3d1]">Jede Marke bekommt eine visuelle Sprache, die im Logo funktioniert, auf der Website trägt und in jedem Touchpoint wiedererkennbar bleibt.</p>
                </div>

                <div class="grid gap-5 md:grid-cols-3">
                    <article class="min-h-72 rounded-[1.75rem] border border-[#fafaf9]/15 bg-[#1c1917]/72 p-7 shadow-[0_24px_70px_rgba(0,0,0,0.2)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#ca8a04]/45 motion-reduce:transition-none">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-5xl text-[#ca8a04]">01</span>
                        <h3 class="mt-10 font-['Libre_Bodoni',Georgia,serif] text-3xl font-semibold tracking-[-0.05em]">Prägnante Zeichen</h3>
                        <p class="mt-4 text-base font-normal leading-[1.7] text-[#d6d3d1]">Logo-Familien, Wortmarken und visuelle Codes, die in kleinen Icons und großen Kampagnen gleich stark wirken.</p>
                    </article>
                    <article class="min-h-72 rounded-[1.75rem] border border-[#fafaf9]/15 bg-[#1c1917]/72 p-7 shadow-[0_24px_70px_rgba(0,0,0,0.2)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#ca8a04]/45 motion-reduce:transition-none">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-5xl text-[#ca8a04]">02</span>
                        <h3 class="mt-10 font-['Libre_Bodoni',Georgia,serif] text-3xl font-semibold tracking-[-0.05em]">Digitale Räume</h3>
                        <p class="mt-4 text-base font-normal leading-[1.7] text-[#d6d3d1]">Websites mit editorialer Dramaturgie, klarer Informationsarchitektur und Details, die Vertrauen schaffen.</p>
                    </article>
                    <article class="min-h-72 rounded-[1.75rem] border border-[#fafaf9]/15 bg-[#1c1917]/72 p-7 shadow-[0_24px_70px_rgba(0,0,0,0.2)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#ca8a04]/45 motion-reduce:transition-none">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-5xl text-[#ca8a04]">03</span>
                        <h3 class="mt-10 font-['Libre_Bodoni',Georgia,serif] text-3xl font-semibold tracking-[-0.05em]">Brand Kits</h3>
                        <p class="mt-4 text-base font-normal leading-[1.7] text-[#d6d3d1]">Farben, Typografie, Bildsprache, Templates und Guidelines für ein konsistentes Markenverhalten.</p>
                    </article>
                </div>
            </section>

            <section id="arbeiten" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out motion-reduce:transition-none lg:py-20" aria-labelledby="work-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#ca8a04] before:h-px before:w-12 before:bg-[#ca8a04]">Ausgewählte Arbeiten</p>
                        <h2 id="work-title" class="mt-5 text-balance font-['Libre_Bodoni',Georgia,serif] text-[clamp(2.45rem,6vw,7rem)] font-semibold leading-[0.92] tracking-[-0.055em] sm:leading-[0.9]">Strategie wird sichtbar, bevor sie erklärt werden muss.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#d6d3d1]">Konzeptuelle Case-Visuals zeigen, wie Void Studio aus unterschiedlichen Geschäftsmodellen klare Markenwelten formt.</p>
                </div>

                <div class="grid gap-5 lg:grid-cols-[1.18fr_0.82fr]">
                    <article class="relative min-h-[32rem] overflow-hidden rounded-[2.125rem] border border-[#fafaf9]/15 bg-[#1c1917]/75 p-7 pt-[18rem] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur md:pt-[21rem]">
                        <div class="absolute inset-x-7 top-7 h-[48%] rounded-[1.625rem] border border-[#ca8a04]/30 bg-[linear-gradient(135deg,rgba(202,138,4,0.24),transparent_40%),repeating-linear-gradient(90deg,rgba(250,250,249,0.08)_0_1px,transparent_1px_18px),#090806] before:absolute before:inset-8 before:rounded-full before:border before:border-[#fafaf9]/20" aria-hidden="true"></div>
                        <h3 class="relative z-10 font-['Libre_Bodoni',Georgia,serif] text-[clamp(2rem,3vw,3.25rem)] font-semibold leading-none tracking-[-0.05em]">Nova Ledger</h3>
                        <p class="relative z-10 mt-5 text-base font-normal leading-[1.7] text-[#d6d3d1]">Rebranding für eine Finance-Plattform: präzise Wortmarke, dunkles Interface-System und ein Vertrauensauftritt für Enterprise-Kunden.</p>
                        <div class="relative z-10 mt-6 flex flex-wrap gap-2.5" aria-label="Projektleistungen">
                            <span class="rounded-full border border-[#fafaf9]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Brand Strategy</span>
                            <span class="rounded-full border border-[#fafaf9]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Logo</span>
                            <span class="rounded-full border border-[#fafaf9]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Website</span>
                        </div>
                    </article>

                    <article class="relative min-h-[32rem] overflow-hidden rounded-[2.125rem] border border-[#fafaf9]/15 bg-[#1c1917]/75 p-7 pt-[18rem] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <div class="absolute inset-x-7 top-7 h-[48%] rounded-[1.625rem] border border-[#ca8a04]/30 bg-[linear-gradient(135deg,rgba(202,138,4,0.2),transparent_38%),radial-gradient(circle_at_40%_38%,rgba(250,250,249,0.14),transparent_18rem),#090806] before:absolute before:inset-8 before:rounded-[2rem] before:border before:border-[#fafaf9]/20" aria-hidden="true"></div>
                        <h3 class="relative z-10 font-['Libre_Bodoni',Georgia,serif] text-[clamp(2rem,3vw,3.25rem)] font-semibold leading-none tracking-[-0.05em]">Atlas Works</h3>
                        <p class="relative z-10 mt-5 text-base font-normal leading-[1.7] text-[#d6d3d1]">Markensystem für ein Architekturbüro mit reduzierter Typografie, modularen Layouts und einer Website, die Projekte groß wirken lässt.</p>
                        <div class="relative z-10 mt-6 flex flex-wrap gap-2.5" aria-label="Projektleistungen">
                            <span class="rounded-full border border-[#fafaf9]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Identity</span>
                            <span class="rounded-full border border-[#fafaf9]/15 px-3 py-2 text-[0.72rem] font-bold uppercase tracking-[0.14em] text-[#d6d3d1]">Editorial Web</span>
                        </div>
                    </article>
                </div>
            </section>

            <section id="prozess" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out motion-reduce:transition-none lg:py-20" aria-labelledby="process-title">
                <div class="mb-9 grid items-end gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(17.5rem,0.48fr)]">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#ca8a04] before:h-px before:w-12 before:bg-[#ca8a04]">Der Ablauf</p>
                        <h2 id="process-title" class="mt-5 text-balance font-['Libre_Bodoni',Georgia,serif] text-[clamp(2.45rem,6vw,7rem)] font-semibold leading-[0.92] tracking-[-0.055em] sm:leading-[0.9]">Vom leeren Raum zur führenden Marke.</h2>
                    </div>
                    <p class="m-0 text-lg font-normal leading-[1.65] text-[#d6d3d1]">Ein schlanker Prozess mit klaren Entscheidungen, schnellen Prototypen und finalen Assets, die direkt nutzbar sind.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <article class="min-h-64 rounded-[1.625rem] border border-[#fafaf9]/15 bg-[#1c1917]/74 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-sm tracking-[0.18em] text-[#ca8a04]">01</span>
                        <h3 class="mt-14 font-['Libre_Bodoni',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Audit</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#d6d3d1]">Markt, Zielgruppen und bestehende Wahrnehmung werden verdichtet.</p>
                    </article>
                    <article class="min-h-64 rounded-[1.625rem] border border-[#fafaf9]/15 bg-[#1c1917]/74 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-sm tracking-[0.18em] text-[#ca8a04]">02</span>
                        <h3 class="mt-14 font-['Libre_Bodoni',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Concept</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#d6d3d1]">Positionierung, Look Direction und erste visuelle Systeme entstehen.</p>
                    </article>
                    <article class="min-h-64 rounded-[1.625rem] border border-[#fafaf9]/15 bg-[#1c1917]/74 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-sm tracking-[0.18em] text-[#ca8a04]">03</span>
                        <h3 class="mt-14 font-['Libre_Bodoni',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Build</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#d6d3d1]">Logo, Website und Brand Assets werden sauber ausgearbeitet.</p>
                    </article>
                    <article class="min-h-64 rounded-[1.625rem] border border-[#fafaf9]/15 bg-[#1c1917]/74 p-6 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur">
                        <span class="font-['Libre_Bodoni',Georgia,serif] text-sm tracking-[0.18em] text-[#ca8a04]">04</span>
                        <h3 class="mt-14 font-['Libre_Bodoni',Georgia,serif] text-2xl font-semibold leading-none tracking-[-0.04em]">Launch</h3>
                        <p class="mt-5 text-base font-normal leading-[1.7] text-[#d6d3d1]">Guidelines, Übergabe und Rollout bringen die Marke in Bewegung.</p>
                    </article>
                </div>
            </section>

            <section id="kontakt" x-data="reveal" x-bind:class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="py-16 transition duration-700 ease-out motion-reduce:transition-none lg:py-20" aria-labelledby="contact-title">
                <div class="grid items-center gap-8 rounded-[1.75rem] border border-[#ca8a04]/45 bg-[radial-gradient(circle_at_88%_20%,rgba(202,138,4,0.2),transparent_22rem),rgba(28,25,23,0.86)] p-9 shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur lg:grid-cols-[minmax(0,0.9fr)_auto] lg:rounded-[2.5rem] lg:p-16">
                    <div>
                        <p class="inline-flex items-center gap-3 text-[0.82rem] font-bold uppercase tracking-[0.22em] text-[#ca8a04] before:h-px before:w-12 before:bg-[#ca8a04]">Checkout für neue Identität</p>
                        <h2 id="contact-title" class="mt-5 max-w-[52rem] text-balance font-['Libre_Bodoni',Georgia,serif] text-[clamp(2.45rem,7vw,8rem)] font-semibold leading-[0.92] tracking-[-0.055em] sm:leading-[0.9]">Bereit für eine Marke, die nicht austauschbar wirkt?</h2>
                        <p class="mt-6 max-w-xl text-lg font-normal leading-[1.6] text-[#d6d3d1]">Schick eine kurze Projektbeschreibung. Void Studio meldet sich mit einer klaren Einschätzung zu Scope, Timing und nächstem Schritt.</p>
                    </div>
                    <a class="inline-flex min-h-12 cursor-pointer items-center justify-center rounded-full border border-[#ca8a04] bg-[#ca8a04] px-6 text-center text-[0.82rem] font-bold uppercase tracking-[0.16em] text-[#0c0a09] outline-offset-4 transition hover:-translate-y-0.5 hover:border-[#eab308] hover:bg-[#eab308] focus-visible:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#ca8a04]" href="mailto:hello@void.studio?subject=Projektanfrage%20Void%20Studio">hello@void.studio</a>
                </div>
            </section>
        </main>

        <footer class="mx-auto flex w-[calc(100%_-_2rem)] max-w-7xl flex-col gap-3 border-t border-[#fafaf9]/15 py-9 text-[0.82rem] font-bold uppercase tracking-[0.14em] text-[#a8a29e] md:flex-row md:items-center md:justify-between">
            <span>Void Studio</span>
            <span>Logos / Websites / Branding</span>
            <span>{{ now()->year }}</span>
        </footer>
    </body>
</html>
