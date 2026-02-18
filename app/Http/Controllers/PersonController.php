<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;

class PersonController extends Controller
{
    public function show(int $id, TmdbService $tmdb)
    {
        $person = $tmdb->person($id);

        if (!$person) {
            abort(404);
        }

        return view('person.show', compact('person', 'tmdb'));
    }
}
