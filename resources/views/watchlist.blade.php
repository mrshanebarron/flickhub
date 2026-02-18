@extends('layouts.app')

@section('title', 'My Watchlist')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-24 pb-12">
    <h1 class="font-display text-3xl text-white mb-8">My Watchlist</h1>

    @if($items->isEmpty())
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto text-surface-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
            <p class="text-surface-400 text-lg">Your watchlist is empty</p>
            <p class="text-surface-500 text-sm mt-1 mb-6">Browse movies and TV shows to add them here.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2 bg-brand-500 hover:bg-brand-600 text-white text-sm rounded-lg transition-colors">
                Browse Content
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach($items as $item)
                @php
                    $route = $item->media_type === 'movie' ? route('movies.show', $item->tmdb_id) : route('tv.show', $item->tmdb_id);
                @endphp
                <div class="group relative">
                    <a href="{{ $route }}" class="card-hover block">
                        <div class="aspect-[2/3] rounded-lg overflow-hidden bg-surface-800">
                            <img src="{{ $tmdb->posterUrl($item->poster_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-2 left-2">
                                <span class="px-1.5 py-0.5 text-[10px] uppercase tracking-wider rounded {{ $item->media_type === 'movie' ? 'bg-brand-500/80 text-white' : 'bg-blue-500/80 text-white' }}">{{ $item->media_type === 'movie' ? 'Movie' : 'TV' }}</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-surface-300 group-hover:text-white transition-colors line-clamp-1">{{ $item->title }}</p>
                    </a>
                    <form method="POST" action="{{ route('watchlist.toggle') }}" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf
                        <input type="hidden" name="tmdb_id" value="{{ $item->tmdb_id }}">
                        <input type="hidden" name="media_type" value="{{ $item->media_type }}">
                        <input type="hidden" name="title" value="{{ $item->title }}">
                        <input type="hidden" name="poster_path" value="{{ $item->poster_path }}">
                        <button type="submit" class="w-7 h-7 rounded-full bg-black/70 flex items-center justify-center text-red-400 hover:text-red-300 hover:bg-black/90 transition-all" title="Remove">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
