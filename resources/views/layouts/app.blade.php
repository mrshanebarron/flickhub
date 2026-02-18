<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FlickHub') — Movie & TV Reviews</title>
    <meta name="description" content="@yield('description', 'Discover, review, and track your favorite movies and TV shows.')">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwindcss.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50: '#fff1f1', 100: '#ffe1e1', 200: '#ffc7c7', 300: '#ffa0a0', 400: '#ff6b6b', 500: '#e63946', 600: '#c81e2b', 700: '#a11d2b', 800: '#851b28', 900: '#6e1a26' },
                        surface: { 50: '#f5f5f6', 100: '#e5e5e7', 200: '#ccccce', 300: '#a8a8ac', 400: '#7c7c82', 500: '#616168', 600: '#525258', 700: '#45454a', 800: '#2d2d31', 900: '#1a1a1e', 950: '#0d0d10' }
                    },
                    fontFamily: {
                        display: ['DM Serif Display', 'Georgia', 'serif'],
                        body: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- GSAP --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background: #0d0d10; color: #e5e5e7; }
        .font-display { font-family: 'DM Serif Display', Georgia, serif; }

        /* Netflix-style horizontal scroll */
        .scroll-row { display: flex; gap: 0.5rem; overflow-x: auto; scroll-behavior: smooth; padding-bottom: 1rem; scrollbar-width: none; }
        .scroll-row::-webkit-scrollbar { display: none; }

        /* Scroll row navigation arrows */
        .scroll-row-wrapper { position: relative; }
        .scroll-row-wrapper .scroll-arrow { position: absolute; top: 0; bottom: 1rem; width: 3rem; z-index: 5; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; cursor: pointer; }
        .scroll-row-wrapper:hover .scroll-arrow { opacity: 1; }
        .scroll-arrow-left { left: 0; background: linear-gradient(to right, #0d0d10 0%, transparent); padding-left: 0.5rem; }
        .scroll-arrow-right { right: 0; background: linear-gradient(to left, #0d0d10 0%, transparent); padding-right: 0.5rem; }

        /* Card hover effect */
        .card-hover { transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.3s ease; }
        .card-hover:hover { transform: scale(1.08); z-index: 10; box-shadow: 0 12px 40px rgba(0,0,0,0.6), 0 0 0 1px rgba(230,57,70,0.15); }

        /* Star rating */
        .star-rating input[type="radio"] { display: none; }
        .star-rating label { cursor: pointer; color: #45454a; transition: color 0.15s; font-size: 1.5rem; }
        .star-rating label:hover, .star-rating label:hover ~ label,
        .star-rating input:checked ~ label { color: #e63946; }
        .star-rating { direction: rtl; display: inline-flex; }

        /* Gradient fade for text */
        .text-fade { mask-image: linear-gradient(to bottom, black 60%, transparent); -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent); }

        /* Hero gradient — richer, more cinematic */
        .hero-gradient {
            background:
                linear-gradient(to top, #0d0d10 0%, rgba(13,13,16,0.8) 30%, transparent 70%),
                linear-gradient(to right, #0d0d10 0%, rgba(13,13,16,0.4) 50%, transparent 80%),
                radial-gradient(ellipse at 20% 80%, rgba(230,57,70,0.08) 0%, transparent 50%);
        }

        /* Film grain overlay — subtle texture */
        .film-grain::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            opacity: 0.4;
            mix-blend-mode: overlay;
        }

        /* Skeleton loading */
        .skeleton { background: linear-gradient(90deg, #1a1a1e 25%, #2d2d31 50%, #1a1a1e 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        /* Content row reveal animation */
        .content-section { visibility: visible; }

        /* Subtle glow effect on brand elements */
        .brand-glow { box-shadow: 0 0 20px rgba(230,57,70,0.15), 0 0 60px rgba(230,57,70,0.05); }

        /* Vignette for hero images */
        .vignette::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, transparent 50%, rgba(13,13,16,0.4) 100%);
            pointer-events: none;
            z-index: 1;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-surface-950 antialiased" x-data="{ mobileMenu: false }">

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{ scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
         :class="scrolled ? 'bg-surface-950/95 backdrop-blur-md shadow-lg' : 'bg-gradient-to-b from-surface-950/80 to-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-brand-500 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M18 3v2h-2V3H8v2H6V3H4v18h2v-2h2v2h8v-2h2v2h2V3h-2zM8 17H6v-2h2v2zm0-4H6v-2h2v2zm0-4H6V7h2v2zm10 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2z"/></svg>
                    </div>
                    <span class="font-display text-xl text-white group-hover:text-brand-400 transition-colors">FlickHub</span>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-surface-300 hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-white' : '' }}">Home</a>
                    <a href="{{ route('search', ['q' => '']) }}" class="text-sm font-medium text-surface-300 hover:text-white transition-colors {{ request()->routeIs('search') ? 'text-white' : '' }}">Browse</a>
                    @auth
                        <a href="{{ route('watchlist') }}" class="text-sm font-medium text-surface-300 hover:text-white transition-colors {{ request()->routeIs('watchlist') ? 'text-white' : '' }}">My List</a>
                    @endauth
                </div>

                {{-- Search + Auth --}}
                <div class="flex items-center gap-3">
                    <form action="{{ route('search') }}" method="GET" class="hidden sm:block" x-data="{ expanded: false }">
                        <div class="relative" :class="expanded ? 'w-64' : 'w-8'">
                            <button type="button" @click="expanded = !expanded; $nextTick(() => $refs.searchInput?.focus())" class="absolute left-0 top-0 w-8 h-8 flex items-center justify-center text-surface-400 hover:text-white z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                            <input x-ref="searchInput" x-show="expanded" x-transition type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Search movies, TV shows..."
                                   class="w-full h-8 pl-8 pr-3 text-sm bg-surface-800/80 border border-surface-700 rounded text-white placeholder-surface-500 focus:border-brand-500 focus:outline-none"
                                   @click.away="if(!$el.value) expanded = false"
                                   @keydown.escape="expanded = false">
                        </div>
                    </form>

                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 text-sm text-surface-300 hover:text-white">
                                <div class="w-7 h-7 rounded bg-brand-600 flex items-center justify-center text-xs font-bold text-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                 class="absolute right-0 mt-2 w-48 bg-surface-800 border border-surface-700 rounded-lg shadow-xl py-1 z-50">
                                <div class="px-4 py-2 border-b border-surface-700">
                                    <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-surface-400">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('watchlist') }}" class="block px-4 py-2 text-sm text-surface-300 hover:text-white hover:bg-surface-700">My Watchlist</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-surface-300 hover:text-white hover:bg-surface-700">Sign Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline text-sm text-surface-300 hover:text-white transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="hidden sm:inline text-sm px-3 py-1.5 bg-brand-500 hover:bg-brand-600 text-white rounded transition-colors">Join</a>
                    @endauth

                    {{-- Mobile menu toggle --}}
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden w-8 h-8 flex items-center justify-center text-surface-400 hover:text-white">
                        <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-surface-950/98 backdrop-blur-lg border-t border-surface-800/50" x-cloak>
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block py-2.5 px-3 text-sm rounded-lg {{ request()->routeIs('home') ? 'text-white bg-surface-800' : 'text-surface-300 hover:text-white hover:bg-surface-800/50' }}">Home</a>
                <a href="{{ route('search', ['q' => '']) }}" class="block py-2.5 px-3 text-sm rounded-lg {{ request()->routeIs('search') ? 'text-white bg-surface-800' : 'text-surface-300 hover:text-white hover:bg-surface-800/50' }}">Browse</a>
                @auth
                    <a href="{{ route('watchlist') }}" class="block py-2.5 px-3 text-sm rounded-lg {{ request()->routeIs('watchlist') ? 'text-white bg-surface-800' : 'text-surface-300 hover:text-white hover:bg-surface-800/50' }}">My Watchlist</a>
                @endauth
                <form action="{{ route('search') }}" method="GET" class="pt-2">
                    <input type="text" name="q" placeholder="Search movies, TV shows..."
                           class="w-full px-4 py-2.5 bg-surface-800 border border-surface-700 rounded-lg text-sm text-white placeholder-surface-500 focus:border-brand-500 focus:outline-none">
                </form>
                @guest
                <div class="flex gap-2 pt-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 text-sm text-surface-300 border border-surface-700 rounded-lg hover:text-white hover:bg-surface-800">Sign In</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 text-sm bg-brand-500 hover:bg-brand-600 text-white rounded-lg">Join</a>
                </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
             class="fixed top-20 right-4 z-50 bg-green-900/90 text-green-100 px-4 py-2 rounded-lg text-sm shadow-lg border border-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-surface-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="font-display text-lg text-white mb-3">FlickHub</h4>
                    <p class="text-sm text-surface-400 leading-relaxed">Your destination for movie and TV show reviews, ratings, and discovery.</p>
                </div>
                <div>
                    <h5 class="text-xs font-semibold uppercase tracking-wider text-surface-500 mb-3">Browse</h5>
                    <ul class="space-y-2 text-sm text-surface-400">
                        <li><a href="{{ route('search', ['q' => 'action']) }}" class="hover:text-white transition-colors">Action</a></li>
                        <li><a href="{{ route('search', ['q' => 'comedy']) }}" class="hover:text-white transition-colors">Comedy</a></li>
                        <li><a href="{{ route('search', ['q' => 'drama']) }}" class="hover:text-white transition-colors">Drama</a></li>
                        <li><a href="{{ route('search', ['q' => 'thriller']) }}" class="hover:text-white transition-colors">Thriller</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xs font-semibold uppercase tracking-wider text-surface-500 mb-3">Account</h5>
                    <ul class="space-y-2 text-sm text-surface-400">
                        @auth
                            <li><a href="{{ route('watchlist') }}" class="hover:text-white transition-colors">My Watchlist</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Create Account</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h5 class="text-xs font-semibold uppercase tracking-wider text-surface-500 mb-3">Data</h5>
                    <p class="text-xs text-surface-500 leading-relaxed">This product uses the TMDB API but is not endorsed or certified by TMDB.</p>
                    <img src="https://www.themoviedb.org/assets/2/v4/logos/v2/blue_short-8e7b30f73a4020692ccca9c88bafe5dcb6f8a62a4c6bc55cd9ba82bb2cd95f6c.svg" alt="TMDB" class="h-4 mt-2 opacity-60">
                </div>
            </div>
            <div class="border-t border-surface-800 mt-8 pt-8 text-center">
                <p class="text-xs text-surface-500">&copy; {{ date('Y') }} FlickHub. Built with Laravel.</p>
            </div>
        </div>
    </footer>

    {{-- GSAP Scroll Animations --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.registerPlugin(ScrollTrigger);

            // Animate content sections on scroll
            document.querySelectorAll('.content-section').forEach((section, i) => {
                const rect = section.getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    // Already in viewport — animate immediately
                    gsap.fromTo(section,
                        { autoAlpha: 0, y: 40 },
                        { autoAlpha: 1, y: 0, duration: 0.8, delay: i * 0.1, ease: 'power2.out' }
                    );
                } else {
                    gsap.fromTo(section,
                        { autoAlpha: 0, y: 40 },
                        {
                            autoAlpha: 1, y: 0, duration: 0.8, ease: 'power2.out',
                            scrollTrigger: { trigger: section, start: 'top 85%', once: true }
                        }
                    );
                }
            });

            // Hero parallax — subtle backdrop movement on scroll
            const heroImg = document.querySelector('.hero-backdrop');
            if (heroImg) {
                gsap.to(heroImg, {
                    yPercent: 15,
                    ease: 'none',
                    scrollTrigger: { trigger: heroImg.closest('section'), start: 'top top', end: 'bottom top', scrub: true }
                });
            }

            // Scroll row arrow buttons
            document.querySelectorAll('.scroll-row-wrapper').forEach(wrapper => {
                const row = wrapper.querySelector('.scroll-row');
                const leftArrow = wrapper.querySelector('.scroll-arrow-left');
                const rightArrow = wrapper.querySelector('.scroll-arrow-right');
                if (row && leftArrow && rightArrow) {
                    leftArrow.addEventListener('click', () => row.scrollBy({ left: -400, behavior: 'smooth' }));
                    rightArrow.addEventListener('click', () => row.scrollBy({ left: 400, behavior: 'smooth' }));
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
