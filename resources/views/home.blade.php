@extends('layouts.app')

@section('title', 'FlickHub')

@section('content')
    {{-- Hero Section — Auto-rotating Cinematic --}}
    @php
        $heroItems = [];
        if (!empty($trending['results'])) {
            $heroItems = array_values(array_filter(
                array_slice($trending['results'], 0, 5),
                fn($item) => !empty($item['backdrop_path'])
            ));
        }
    @endphp

    @if(!empty($heroItems))
    <section class="relative h-[75vh] min-h-[550px] overflow-hidden" x-data="heroSlider()" x-init="start()">
        {{-- Backdrop images --}}
        @foreach($heroItems as $i => $item)
        <div class="absolute inset-0 transition-opacity duration-1000"
             :class="current === {{ $i }} ? 'opacity-100' : 'opacity-0'">
            <img src="{{ $tmdb->backdropUrl($item['backdrop_path'], 'original') }}"
                 alt="{{ $item['title'] ?? $item['name'] ?? '' }}"
                 class="hero-backdrop w-full h-full object-cover object-top">
            <div class="hero-gradient absolute inset-0"></div>
            <div class="vignette absolute inset-0"></div>
        </div>
        @endforeach

        {{-- Film grain texture --}}
        <div class="film-grain absolute inset-0 z-10 pointer-events-none"></div>

        {{-- Content overlay --}}
        <div class="relative z-20 h-full flex items-end pb-24 px-4 sm:px-6 max-w-7xl mx-auto">
            @foreach($heroItems as $i => $item)
            @php
                $heroType = isset($item['title']) ? 'movie' : 'tv';
                $heroTitle = $item['title'] ?? $item['name'] ?? 'Featured';
                $heroRoute = $heroType === 'movie' ? route('movies.show', $item['id']) : route('tv.show', $item['id']);
            @endphp
            <div class="max-w-xl transition-all duration-700"
                 x-show="current === {{ $i }}"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <span class="inline-block px-2.5 py-1 text-[10px] uppercase tracking-widest rounded-sm bg-brand-500/30 text-brand-300 mb-3 border border-brand-500/20">
                    {{ $heroType === 'movie' ? 'Trending Movie' : 'Trending Show' }}
                </span>
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.1] mb-4 drop-shadow-lg">{{ $heroTitle }}</h1>
                <p class="text-surface-300 text-sm sm:text-base line-clamp-3 mb-6 max-w-md">{{ $item['overview'] ?? '' }}</p>
                <div class="flex items-center gap-3">
                    <a href="{{ $heroRoute }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-lg font-medium text-sm transition-all hover:shadow-lg hover:shadow-brand-500/20 brand-glow">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        More Info
                    </a>
                    @if(isset($item['vote_average']))
                    <span class="flex items-center gap-1.5 text-sm text-surface-300">
                        <svg class="w-4 h-4 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        {{ round($item['vote_average'], 1) }} / 10
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Hero indicators --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            @foreach($heroItems as $i => $item)
            <button @click="goTo({{ $i }})"
                    class="h-1 rounded-full transition-all duration-500"
                    :class="current === {{ $i }} ? 'w-8 bg-brand-500' : 'w-4 bg-surface-600 hover:bg-surface-400'"></button>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Content Rows --}}
    <div class="max-w-7xl mx-auto {{ !empty($heroItems) ? '-mt-10 relative z-10' : 'pt-24' }}">
        @include('partials.content-row', ['title' => 'Trending This Week', 'items' => $trending['results'] ?? [], 'tmdb' => $tmdb, 'showType' => true])
        @include('partials.content-row', ['title' => 'Popular Movies', 'items' => $popularMovies['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Now Playing', 'items' => $nowPlaying['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Top Rated Movies', 'items' => $topRatedMovies['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Popular TV Shows', 'items' => $popularTv['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Top Rated TV Shows', 'items' => $topRatedTv['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Upcoming Movies', 'items' => $upcoming['results'] ?? [], 'tmdb' => $tmdb])
    </div>
@endsection

@push('scripts')
<script>
    function heroSlider() {
        return {
            current: 0,
            total: {{ count($heroItems ?? []) }},
            interval: null,
            start() {
                if (this.total <= 1) return;
                this.interval = setInterval(() => this.next(), 6000);
            },
            next() {
                this.current = (this.current + 1) % this.total;
            },
            goTo(i) {
                this.current = i;
                clearInterval(this.interval);
                this.interval = setInterval(() => this.next(), 6000);
            }
        };
    }
</script>
@endpush
