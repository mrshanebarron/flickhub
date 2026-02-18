@props(['item', 'tmdb', 'showType' => false])

@php
    $mediaType = $item['media_type'] ?? ($item['title'] ?? false ? 'movie' : 'tv');
    $title = $item['title'] ?? $item['name'] ?? 'Unknown';
    $year = isset($item['release_date']) ? substr($item['release_date'], 0, 4) :
            (isset($item['first_air_date']) ? substr($item['first_air_date'], 0, 4) : '');
    $rating = isset($item['vote_average']) ? round($item['vote_average'], 1) : null;
    $route = $mediaType === 'movie' ? route('movies.show', $item['id']) : route('tv.show', $item['id']);
@endphp

<a href="{{ $route }}" class="flex-shrink-0 w-[160px] sm:w-[180px] group card-hover relative">
    <div class="relative aspect-[2/3] rounded-lg overflow-hidden bg-surface-800">
        <img src="{{ $tmdb->posterUrl($item['poster_path'] ?? null) }}"
             alt="{{ $title }}"
             class="w-full h-full object-cover"
             loading="lazy">

        {{-- Hover overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute bottom-0 left-0 right-0 p-3">
                <p class="text-white text-sm font-medium leading-tight line-clamp-2">{{ $title }}</p>
                <div class="flex items-center gap-2 mt-1">
                    @if($rating)
                        <span class="flex items-center gap-1 text-xs">
                            <svg class="w-3 h-3 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-surface-300">{{ $rating }}</span>
                        </span>
                    @endif
                    @if($year)
                        <span class="text-xs text-surface-400">{{ $year }}</span>
                    @endif
                </div>
                @if($showType)
                    <span class="inline-block mt-1 px-1.5 py-0.5 text-[10px] uppercase tracking-wider rounded {{ $mediaType === 'movie' ? 'bg-brand-500/30 text-brand-300' : 'bg-blue-500/30 text-blue-300' }}">
                        {{ $mediaType === 'movie' ? 'Movie' : 'TV' }}
                    </span>
                @endif
            </div>
        </div>

        {{-- Rating badge (always visible) --}}
        @if($rating && $rating > 0)
            <div class="absolute top-2 right-2 w-8 h-8 rounded-full flex items-center justify-center text-[10px] font-bold
                {{ $rating >= 7 ? 'bg-green-600/90 text-green-100' : ($rating >= 5 ? 'bg-yellow-600/90 text-yellow-100' : 'bg-red-600/90 text-red-100') }}">
                {{ $rating }}
            </div>
        @endif
    </div>

    {{-- Title below card --}}
    <p class="mt-2 text-xs text-surface-400 group-hover:text-surface-200 transition-colors line-clamp-1">{{ $title }}</p>
</a>
