<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;

class SearchController extends Controller
{
    public function __invoke(TmdbService $tmdb)
    {
        $query = request('q', '');
        $results = ['results' => [], 'total_results' => 0, 'total_pages' => 0];

        if (strlen($query) >= 2) {
            $results = $tmdb->search($query, request('page', 1));
        }

        return view('search', compact('query', 'results', 'tmdb'));
    }
}
