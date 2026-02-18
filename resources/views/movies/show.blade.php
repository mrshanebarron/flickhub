@extends('layouts.app')

@section('title', $movie['title'])
@section('description', Str::limit($movie['overview'] ?? '', 160))

@section('content')
    {{-- Backdrop Hero --}}
    <section class="relative h-[50vh] min-h-[400px]">
        <div class="absolute inset-0">
            <img src="{{ $tmdb->backdropUrl($movie['backdrop_path'] ?? null, 'original') }}"
                 alt="{{ $movie['title'] }}"
                 class="w-full h-full object-cover object-top">
            <div class="hero-gradient absolute inset-0"></div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 -mt-48 relative z-10">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Poster --}}
            <div class="flex-shrink-0 w-48 md:w-64">
                <img src="{{ $tmdb->posterUrl($movie['poster_path'] ?? null, 'w500') }}"
                     alt="{{ $movie['title'] }}"
                     class="w-full rounded-xl shadow-2xl border border-surface-800">
            </div>

            {{-- Details --}}
            <div class="flex-1 pt-4 md:pt-24">
                <div class="flex items-center gap-3 mb-2">
                    @if(isset($movie['release_date']))
                        <span class="text-sm text-surface-400">{{ substr($movie['release_date'], 0, 4) }}</span>
                    @endif
                    @if(isset($movie['runtime']) && $movie['runtime'])
                        <span class="text-surface-600">&middot;</span>
                        <span class="text-sm text-surface-400">{{ floor($movie['runtime'] / 60) }}h {{ $movie['runtime'] % 60 }}m</span>
                    @endif
                    @if(isset($movie['vote_average']))
                        <span class="text-surface-600">&middot;</span>
                        <span class="flex items-center gap-1 text-sm">
                            <svg class="w-4 h-4 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-white font-medium">{{ round($movie['vote_average'], 1) }}</span>
                            <span class="text-surface-500 text-xs">({{ number_format($movie['vote_count'] ?? 0) }})</span>
                        </span>
                    @endif
                </div>

                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl text-white mb-4">{{ $movie['title'] }}</h1>

                {{-- Genres --}}
                @if(!empty($movie['genres']))
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($movie['genres'] as $genre)
                        <a href="{{ route('movies.genre', $genre['id']) }}" class="px-3 py-1 text-xs rounded-full bg-surface-800 text-surface-300 hover:bg-surface-700 hover:text-white border border-surface-700 transition-colors">
                            {{ $genre['name'] }}
                        </a>
                    @endforeach
                </div>
                @endif

                {{-- Tagline --}}
                @if(!empty($movie['tagline']))
                    <p class="text-brand-400 italic text-sm mb-3">{{ $movie['tagline'] }}</p>
                @endif

                {{-- Overview --}}
                <p class="text-surface-300 leading-relaxed mb-6">{{ $movie['overview'] ?? 'No overview available.' }}</p>

                {{-- Actions --}}
                <div class="flex items-center gap-3 mb-8">
                    {{-- Watchlist Toggle --}}
                    @auth
                    <form method="POST" action="{{ route('watchlist.toggle') }}">
                        @csrf
                        <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">
                        <input type="hidden" name="media_type" value="movie">
                        <input type="hidden" name="title" value="{{ $movie['title'] }}">
                        <input type="hidden" name="poster_path" value="{{ $movie['poster_path'] ?? '' }}">
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-colors
                            {{ $onWatchlist ? 'bg-brand-500/20 text-brand-400 border border-brand-500/50 hover:bg-brand-500/30' : 'bg-surface-800 text-surface-300 border border-surface-700 hover:bg-surface-700 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="{{ $onWatchlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                            {{ $onWatchlist ? 'On Watchlist' : 'Add to Watchlist' }}
                        </button>
                    </form>
                    @endauth

                    {{-- Trailer --}}
                    @php
                        $trailer = collect($movie['videos']['results'] ?? [])->first(fn($v) => $v['type'] === 'Trailer' && $v['site'] === 'YouTube');
                    @endphp
                    @if($trailer)
                        <a href="https://www.youtube.com/watch?v={{ $trailer['key'] }}" target="_blank" rel="noopener"
                           class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium bg-surface-800 text-surface-300 border border-surface-700 hover:bg-surface-700 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Watch Trailer
                        </a>
                    @endif
                </div>

                {{-- Cast --}}
                @if(!empty($movie['credits']['cast']))
                <div class="mb-8">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-surface-500 mb-3">Top Cast</h3>
                    <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2">
                        @foreach(array_slice($movie['credits']['cast'], 0, 10) as $cast)
                        <a href="{{ route('person.show', $cast['id']) }}" class="flex-shrink-0 w-20 text-center group">
                            <div class="w-16 h-16 mx-auto rounded-full overflow-hidden bg-surface-800 mb-1.5">
                                <img src="{{ $tmdb->profileUrl($cast['profile_path'] ?? null) }}"
                                     alt="{{ $cast['name'] }}"
                                     class="w-full h-full object-cover"
                                     loading="lazy">
                            </div>
                            <p class="text-xs text-surface-300 group-hover:text-white transition-colors line-clamp-1">{{ $cast['name'] }}</p>
                            <p class="text-[10px] text-surface-500 line-clamp-1">{{ $cast['character'] }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- User Reviews Section --}}
        <section class="mt-12 border-t border-surface-800 pt-10">
            <h2 class="font-display text-2xl text-white mb-6">Reviews</h2>

            {{-- Write Review (auth only) --}}
            @auth
                @if(!$userReview)
                <div x-data="{ open: false }" class="mb-8">
                    <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 bg-surface-800 border border-surface-700 rounded-lg text-sm text-surface-300 hover:text-white hover:bg-surface-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Write a Review
                    </button>
                    <div x-show="open" x-transition class="mt-4 bg-surface-900 border border-surface-800 rounded-xl p-6">
                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf
                            <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="media_type" value="movie">
                            <input type="hidden" name="title" value="{{ $movie['title'] }}">
                            <input type="hidden" name="poster_path" value="{{ $movie['poster_path'] ?? '' }}">

                            <div class="mb-4">
                                <label class="block text-sm text-surface-400 mb-2">Your Rating</label>
                                <div x-data="{ rating: 7 }" class="flex items-center gap-1">
                                    <template x-for="i in 10" :key="i">
                                        <button type="button" @click="rating = i"
                                                :class="i <= rating ? 'text-brand-400' : 'text-surface-600'"
                                                class="text-xl hover:text-brand-300 transition-colors">&#9733;</button>
                                    </template>
                                    <input type="hidden" name="rating" :value="rating">
                                    <span class="ml-2 text-sm text-surface-400" x-text="rating + '/10'"></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm text-surface-400 mb-2">Your Review</label>
                                <textarea name="body" rows="4" required minlength="10"
                                          class="w-full bg-surface-800 border border-surface-700 rounded-lg px-4 py-3 text-sm text-white placeholder-surface-500 focus:border-brand-500 focus:outline-none resize-none"
                                          placeholder="What did you think of this movie?"></textarea>
                            </div>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 text-sm text-surface-400">
                                    <input type="checkbox" name="contains_spoilers" value="1" class="rounded bg-surface-800 border-surface-600 text-brand-500 focus:ring-brand-500">
                                    Contains spoilers
                                </label>
                                <button type="submit" class="px-5 py-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-medium rounded-lg transition-colors">
                                    Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            @else
                <p class="text-sm text-surface-500 mb-6">
                    <a href="{{ route('login') }}" class="text-brand-400 hover:text-brand-300">Sign in</a> to write a review.
                </p>
            @endauth

            {{-- Review List --}}
            @if($reviews->isEmpty() && !$userReview)
                <p class="text-surface-500 text-sm">No reviews yet. Be the first!</p>
            @endif

            @if($userReview)
                <div class="mb-6 bg-surface-900 border border-brand-500/30 rounded-xl p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="text-sm font-medium text-white">{{ $userReview->user->name }}</span>
                            <span class="text-xs text-surface-500 ml-2">{{ $userReview->created_at->diffForHumans() }}</span>
                            <span class="inline-block ml-2 px-1.5 py-0.5 text-[10px] rounded bg-brand-500/20 text-brand-400">Your Review</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-brand-400 font-medium">{{ $userReview->rating }}/10</span>
                            <form method="POST" action="{{ route('reviews.destroy', $userReview) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-surface-500 hover:text-red-400 transition-colors">Delete</button>
                            </form>
                        </div>
                    </div>
                    @if($userReview->contains_spoilers)
                        <div x-data="{ show: false }">
                            <p x-show="!show" class="text-sm text-surface-500 italic">
                                This review contains spoilers.
                                <button @click="show = true" class="text-brand-400 hover:text-brand-300">Show anyway</button>
                            </p>
                            <p x-show="show" class="text-sm text-surface-300 leading-relaxed">{{ $userReview->body }}</p>
                        </div>
                    @else
                        <p class="text-sm text-surface-300 leading-relaxed">{{ $userReview->body }}</p>
                    @endif
                </div>
            @endif

            <div class="space-y-4">
                @foreach($reviews as $review)
                    @if(!$userReview || $review->id !== $userReview->id)
                    <div class="bg-surface-900 border border-surface-800 rounded-xl p-5">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <span class="text-sm font-medium text-white">{{ $review->user->name }}</span>
                                <span class="text-xs text-surface-500 ml-2">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <span class="text-sm text-brand-400 font-medium">{{ $review->rating }}/10</span>
                        </div>
                        @if($review->contains_spoilers)
                            <div x-data="{ show: false }">
                                <p x-show="!show" class="text-sm text-surface-500 italic">
                                    This review contains spoilers.
                                    <button @click="show = true" class="text-brand-400 hover:text-brand-300">Show anyway</button>
                                </p>
                                <p x-show="show" class="text-sm text-surface-300 leading-relaxed">{{ $review->body }}</p>
                            </div>
                        @else
                            <p class="text-sm text-surface-300 leading-relaxed">{{ $review->body }}</p>
                        @endif
                    </div>
                    @endif
                @endforeach
            </div>
        </section>

        {{-- Recommendations --}}
        @if(!empty($movie['recommendations']['results']))
            <div class="mt-12">
                @include('partials.content-row', [
                    'title' => 'You Might Also Like',
                    'items' => $movie['recommendations']['results'],
                    'tmdb' => $tmdb
                ])
            </div>
        @endif
    </div>
@endsection
