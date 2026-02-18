<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\TmdbService;

class MovieController extends Controller
{
    public function show(int $id, TmdbService $tmdb)
    {
        $movie = $tmdb->movie($id);

        if (!$movie) {
            abort(404);
        }

        $reviews = Review::where('tmdb_id', $id)
            ->where('media_type', 'movie')
            ->with('user')
            ->latest()
            ->get();

        $userReview = null;
        if (auth()->check()) {
            $userReview = Review::where('user_id', auth()->id())
                ->where('tmdb_id', $id)
                ->where('media_type', 'movie')
                ->first();
        }

        $onWatchlist = false;
        if (auth()->check()) {
            $onWatchlist = auth()->user()->watchlists()
                ->where('tmdb_id', $id)
                ->where('media_type', 'movie')
                ->exists();
        }

        return view('movies.show', compact('movie', 'reviews', 'userReview', 'onWatchlist', 'tmdb'));
    }

    public function genre(int $genreId, TmdbService $tmdb)
    {
        $genres = $tmdb->movieGenres();
        $genre = collect($genres)->firstWhere('id', $genreId);
        $movies = $tmdb->moviesByGenre($genreId, request('page', 1));

        return view('movies.genre', compact('genre', 'movies', 'tmdb'));
    }
}
