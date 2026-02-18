@props(['title', 'items', 'tmdb', 'showType' => false, 'link' => null])

@if(!empty($items))
<section class="mb-10">
    <div class="flex items-center justify-between mb-4 px-4 sm:px-6">
        <h2 class="font-display text-xl sm:text-2xl text-white">{{ $title }}</h2>
        @if($link)
            <a href="{{ $link }}" class="text-xs text-surface-400 hover:text-brand-400 transition-colors uppercase tracking-wider">See All &rarr;</a>
        @endif
    </div>
    <div class="scroll-row px-4 sm:px-6" x-data="{ container: null }" x-ref="scrollContainer">
        @foreach($items as $item)
            @if(isset($item['poster_path']) || isset($item['id']))
                @include('partials.card', ['item' => $item, 'tmdb' => $tmdb, 'showType' => $showType])
            @endif
        @endforeach
    </div>
</section>
@endif
