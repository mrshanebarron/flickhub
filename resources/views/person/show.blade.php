@extends('layouts.app')

@section('title', $person['name'] ?? 'Person')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-24 pb-12">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="flex-shrink-0 w-48">
            <img src="{{ $tmdb->profileUrl($person['profile_path'] ?? null, 'w500') }}" alt="{{ $person['name'] }}" class="w-full rounded-xl shadow-lg border border-surface-800">
        </div>
        <div class="flex-1">
            <h1 class="font-display text-3xl sm:text-4xl text-white mb-2">{{ $person['name'] }}</h1>
            @if(!empty($person['birthday']))
                <p class="text-sm text-surface-400 mb-1">
                    Born: {{ \Carbon\Carbon::parse($person['birthday'])->format('F j, Y') }}
                    @if(!empty($person['place_of_birth'])) in {{ $person['place_of_birth'] }} @endif
                </p>
            @endif
            @if(!empty($person['known_for_department']))
                <p class="text-sm text-surface-500 mb-4">Known for: {{ $person['known_for_department'] }}</p>
            @endif
            @if(!empty($person['biography']))
                <div x-data="{ expanded: false }">
                    <p class="text-surface-300 leading-relaxed" :class="expanded ? '' : 'line-clamp-6'">{{ $person['biography'] }}</p>
                    @if(strlen($person['biography']) > 500)
                        <button @click="expanded = !expanded" class="mt-2 text-sm text-brand-400 hover:text-brand-300" x-text="expanded ? 'Show less' : 'Read more'"></button>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if(!empty($person['combined_credits']['cast']))
        <section class="mt-12">
            <h2 class="font-display text-2xl text-white mb-6">Known For</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @php
                    $credits = collect($person['combined_credits']['cast'])
                        ->sortByDesc('vote_count')
                        ->unique('id')
                        ->take(18);
                @endphp
                @foreach($credits as $credit)
                    @php
                        $type = $credit['media_type'] ?? 'movie';
                        $title = $credit['title'] ?? $credit['name'] ?? 'Unknown';
                        $route = $type === 'movie' ? route('movies.show', $credit['id']) : route('tv.show', $credit['id']);
                    @endphp
                    <a href="{{ $route }}" class="group card-hover">
                        <div class="aspect-[2/3] rounded-lg overflow-hidden bg-surface-800">
                            <img src="{{ $tmdb->posterUrl($credit['poster_path'] ?? null) }}" alt="{{ $title }}" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <p class="mt-2 text-xs text-surface-300 group-hover:text-white transition-colors line-clamp-1">{{ $title }}</p>
                        <p class="text-[10px] text-surface-500 line-clamp-1">{{ $credit['character'] ?? '' }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
