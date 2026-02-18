<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;

class HomeController extends Controller
{
    public function __invoke(TmdbService $tmdb)
    {
        $trending = $tmdb->trending('all', 'week');
        $popularMovies = $tmdb->popularMovies();
        $topRatedMovies = $tmdb->topRatedMovies();
        $popularTv = $tmdb->popularTv();
        $topRatedTv = $tmdb->topRatedTv();
        $upcoming = $tmdb->upcomingMovies();
        $nowPlaying = $tmdb->nowPlayingMovies();

        // Pick a random trending item for the hero
        $hero = null;
        if (!empty($trending['results'])) {
            $heroItems = array_filter($trending['results'], fn($item) => !empty($item['backdrop_path']));
            if (!empty($heroItems)) {
                $hero = $heroItems[array_rand($heroItems)];
            }
        }

        return view('home', compact(
            'trending', 'popularMovies', 'topRatedMovies',
            'popularTv', 'topRatedTv', 'upcoming', 'nowPlaying',
            'hero', 'tmdb'
        ));
    }
}
