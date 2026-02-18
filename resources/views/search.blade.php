@extends('layouts.app')

@section('title', $query ? "Search: {$query}" : 'Browse')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-24 pb-12">
    {{-- Search Bar --}}
    <div class="max-w-2xl mx-auto mb-12">
        <h1 class="font-display text-3xl text-white text-center mb-6">{{ $query ? 'Search Results' : 'Discover' }}</h1>
        <form action="{{ route('search') }}" method="GET">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-surface-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="q" value="{{ $query }}" autofocus
                       placeholder="Search for movies, TV shows, people..."
                       class="w-full pl-12 pr-4 py-4 bg-surface-900 border border-surface-700 rounded-xl text-white placeholder-surface-500 focus:border-brand-500 focus:outline-none text-lg">
            </div>
        </form>
    </div>

    {{-- Results --}}
    @if($query && !empty($results['results']))
        <p class="text-sm text-surface-500 mb-6">{{ number_format($results['total_results'] ?? 0) }} results for "{{ $query }}"</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach($results['results'] as $item)
                @php
                    $type = $item['media_type'] ?? 'movie';
                    if ($type === 'person') continue;
                    $title = $item['title'] ?? $item['name'] ?? 'Unknown';
                    $year = isset($item['release_date']) ? substr($item['release_date'], 0, 4) : (isset($item['first_air_date']) ? substr($item['first_air_date'], 0, 4) : '');
                    $route = $type === 'movie' ? route('movies.show', $item['id']) : route('tv.show', $item['id']);
                    $rating = isset($item['vote_average']) ? round($item['vote_average'], 1) : null;
                @endphp
                <a href="{{ $route }}" class="group card-hover">
                    <div class="relative aspect-[2/3] rounded-lg overflow-hidden bg-surface-800">
                        <img src="{{ $tmdb->posterUrl($item['poster_path'] ?? null) }}" alt="{{ $title }}" class="w-full h-full object-cover" loading="lazy">
                        @if($rating && $rating > 0)
                            <div class="absolute top-2 right-2 w-8 h-8 rounded-full flex items-center justify-center text-[10px] font-bold
                                {{ $rating >= 7 ? 'bg-green-600/90 text-green-100' : ($rating >= 5 ? 'bg-yellow-600/90 text-yellow-100' : 'bg-red-600/90 text-red-100') }}">
                                {{ $rating }}
                            </div>
                        @endif
                        <div class="absolute top-2 left-2">
                            <span class="px-1.5 py-0.5 text-[10px] uppercase tracking-wider rounded {{ $type === 'movie' ? 'bg-brand-500/80 text-white' : 'bg-blue-500/80 text-white' }}">{{ $type === 'movie' ? 'Movie' : 'TV' }}</span>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-surface-300 group-hover:text-white transition-colors line-clamp-1">{{ $title }}</p>
                    @if($year)
                        <p class="text-xs text-surface-500">{{ $year }}</p>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if(($results['total_pages'] ?? 1) > 1)
            <div class="flex justify-center gap-2 mt-10">
                @php $currentPage = request('page', 1); @endphp
                @if($currentPage > 1)
                    <a href="{{ route('search', ['q' => $query, 'page' => $currentPage - 1]) }}" class="px-4 py-2 bg-surface-800 border border-surface-700 rounded-lg text-sm text-surface-300 hover:text-white hover:bg-surface-700">&larr; Previous</a>
                @endif
                <span class="px-4 py-2 text-sm text-surface-500">Page {{ $currentPage }} of {{ min($results['total_pages'], 50) }}</span>
                @if($currentPage < min($results['total_pages'], 50))
                    <a href="{{ route('search', ['q' => $query, 'page' => $currentPage + 1]) }}" class="px-4 py-2 bg-surface-800 border border-surface-700 rounded-lg text-sm text-surface-300 hover:text-white hover:bg-surface-700">Next &rarr;</a>
                @endif
            </div>
        @endif
    @elseif($query)
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto text-surface-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <p class="text-surface-400 text-lg">No results found for "{{ $query }}"</p>
            <p class="text-surface-500 text-sm mt-1">Try a different search term</p>
        </div>
    @endif
</div>
@endsection
