<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tmdb_id' => 'required|integer',
            'media_type' => 'required|in:movie,tv',
            'title' => 'required|string|max:255',
            'poster_path' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:10',
            'body' => 'required|string|min:10|max:5000',
            'contains_spoilers' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['contains_spoilers'] = $request->boolean('contains_spoilers');

        Review::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'tmdb_id' => $validated['tmdb_id'],
                'media_type' => $validated['media_type'],
            ],
            $validated
        );

        $route = $validated['media_type'] === 'movie'
            ? route('movies.show', $validated['tmdb_id'])
            : route('tv.show', $validated['tmdb_id']);

        return redirect($route)->with('success', 'Review saved!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $route = $review->media_type === 'movie'
            ? route('movies.show', $review->tmdb_id)
            : route('tv.show', $review->tmdb_id);

        $review->delete();

        return redirect($route)->with('success', 'Review deleted.');
    }
}
