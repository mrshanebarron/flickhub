@props(['title', 'items', 'tmdb', 'showType' => false, 'link' => null])

@if(!empty($items))
<section class="mb-10 content-section">
    <div class="flex items-center justify-between mb-4 px-4 sm:px-6">
        <h2 class="font-display text-xl sm:text-2xl text-white">{{ $title }}</h2>
        @if($link)
            <a href="{{ $link }}" class="text-xs text-surface-400 hover:text-brand-400 transition-colors uppercase tracking-wider">See All &rarr;</a>
        @endif
    </div>
    <div class="scroll-row-wrapper">
        <div class="scroll-arrow scroll-arrow-left">
            <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </div>
        <div class="scroll-row px-4 sm:px-6">
            @foreach($items as $item)
                @if(isset($item['poster_path']) || isset($item['id']))
                    @include('partials.card', ['item' => $item, 'tmdb' => $tmdb, 'showType' => $showType])
                @endif
            @endforeach
        </div>
        <div class="scroll-arrow scroll-arrow-right">
            <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </div>
    </div>
</section>
@endif
