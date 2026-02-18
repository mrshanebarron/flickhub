@extends('layouts.app')

@section('title', 'FlickHub')

@section('content')
    {{-- Hero Section --}}
    @if($hero)
    <section class="relative h-[70vh] min-h-[500px]">
        <div class="absolute inset-0">
            <img src="{{ $tmdb->backdropUrl($hero['backdrop_path'], 'original') }}"
                 alt="{{ $hero['title'] ?? $hero['name'] ?? '' }}"
                 class="w-full h-full object-cover object-top">
            <div class="hero-gradient absolute inset-0"></div>
        </div>
        <div class="relative h-full flex items-end pb-20 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="max-w-lg">
                @php
                    $heroType = isset($hero['title']) ? 'movie' : 'tv';
                    $heroTitle = $hero['title'] ?? $hero['name'] ?? 'Featured';
                    $heroRoute = $heroType === 'movie' ? route('movies.show', $hero['id']) : route('tv.show', $hero['id']);
                @endphp
                <span class="inline-block px-2 py-0.5 text-[10px] uppercase tracking-widest rounded bg-brand-500/30 text-brand-300 mb-3">
                    {{ $heroType === 'movie' ? 'Trending Movie' : 'Trending Show' }}
                </span>
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-white leading-tight mb-4">{{ $heroTitle }}</h1>
                <p class="text-surface-300 text-sm sm:text-base line-clamp-3 mb-6">{{ $hero['overview'] ?? '' }}</p>
                <div class="flex items-center gap-3">
                    <a href="{{ $heroRoute }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-lg font-medium text-sm transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        More Info
                    </a>
                    @if(isset($hero['vote_average']))
                    <span class="flex items-center gap-1.5 text-sm text-surface-300">
                        <svg class="w-4 h-4 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        {{ round($hero['vote_average'], 1) }} / 10
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Content Rows --}}
    <div class="max-w-7xl mx-auto {{ $hero ? '-mt-10 relative z-10' : 'pt-24' }}">
        @include('partials.content-row', ['title' => 'Trending This Week', 'items' => $trending['results'] ?? [], 'tmdb' => $tmdb, 'showType' => true])
        @include('partials.content-row', ['title' => 'Popular Movies', 'items' => $popularMovies['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Now Playing', 'items' => $nowPlaying['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Top Rated Movies', 'items' => $topRatedMovies['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Popular TV Shows', 'items' => $popularTv['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Top Rated TV Shows', 'items' => $topRatedTv['results'] ?? [], 'tmdb' => $tmdb])
        @include('partials.content-row', ['title' => 'Upcoming Movies', 'items' => $upcoming['results'] ?? [], 'tmdb' => $tmdb])
    </div>
@endsection
