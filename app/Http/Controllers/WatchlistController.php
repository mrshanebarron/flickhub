<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Services\TmdbService;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function index(TmdbService $tmdb)
    {
        $items = auth()->user()->watchlists()->latest()->get();

        return view('watchlist', compact('items', 'tmdb'));
    }

    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'tmdb_id' => 'required|integer',
            'media_type' => 'required|in:movie,tv',
            'title' => 'required|string|max:255',
            'poster_path' => 'nullable|string',
        ]);

        $existing = auth()->user()->watchlists()
            ->where('tmdb_id', $validated['tmdb_id'])
            ->where('media_type', $validated['media_type'])
            ->first();

        if ($existing) {
            $existing->delete();
            $added = false;
        } else {
            auth()->user()->watchlists()->create($validated);
            $added = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['added' => $added]);
        }

        return back()->with('success', $added ? 'Added to watchlist!' : 'Removed from watchlist.');
    }
}
