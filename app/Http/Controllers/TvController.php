<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\TmdbService;

class TvController extends Controller
{
    public function show(int $id, TmdbService $tmdb)
    {
        $show = $tmdb->tvShow($id);

        if (!$show) {
            abort(404);
        }

        $reviews = Review::where('tmdb_id', $id)
            ->where('media_type', 'tv')
            ->with('user')
            ->latest()
            ->get();

        $userReview = null;
        if (auth()->check()) {
            $userReview = Review::where('user_id', auth()->id())
                ->where('tmdb_id', $id)
                ->where('media_type', 'tv')
                ->first();
        }

        $onWatchlist = false;
        if (auth()->check()) {
            $onWatchlist = auth()->user()->watchlists()
                ->where('tmdb_id', $id)
                ->where('media_type', 'tv')
                ->exists();
        }

        return view('tv.show', compact('show', 'reviews', 'userReview', 'onWatchlist', 'tmdb'));
    }
}
