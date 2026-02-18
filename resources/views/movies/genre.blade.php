@extends('layouts.app')

@section('title', ($genre['name'] ?? 'Genre') . ' Movies')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-24 pb-12">
    <h1 class="font-display text-3xl text-white mb-8">{{ $genre['name'] ?? 'Genre' }} Movies</h1>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($movies['results'] ?? [] as $movie)
            @include('partials.card', ['item' => array_merge($movie, ['media_type' => 'movie']), 'tmdb' => $tmdb])
        @endforeach
    </div>

    @if(($movies['total_pages'] ?? 1) > 1)
        <div class="flex justify-center gap-2 mt-10">
            @php $currentPage = request('page', 1); @endphp
            @if($currentPage > 1)
                <a href="{{ route('movies.genre', ['genreId' => $genre['id'], 'page' => $currentPage - 1]) }}" class="px-4 py-2 bg-surface-800 border border-surface-700 rounded-lg text-sm text-surface-300 hover:text-white">&larr; Previous</a>
            @endif
            <span class="px-4 py-2 text-sm text-surface-500">Page {{ $currentPage }} of {{ min($movies['total_pages'], 50) }}</span>
            @if($currentPage < min($movies['total_pages'], 50))
                <a href="{{ route('movies.genre', ['genreId' => $genre['id'], 'page' => $currentPage + 1]) }}" class="px-4 py-2 bg-surface-800 border border-surface-700 rounded-lg text-sm text-surface-300 hover:text-white">Next &rarr;</a>
            @endif
        </div>
    @endif
</div>
@endsection
