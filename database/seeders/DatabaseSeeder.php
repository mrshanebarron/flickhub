<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $demo = User::create([
            'name' => 'Demo User',
            'email' => 'demo@flickhub.com',
            'password' => bcrypt('password'),
        ]);

        $reviewers = collect([
            ['name' => 'Sarah Chen', 'email' => 'sarah@example.com'],
            ['name' => 'Marcus Webb', 'email' => 'marcus@example.com'],
            ['name' => 'Elena Rodriguez', 'email' => 'elena@example.com'],
            ['name' => 'James Okafor', 'email' => 'james@example.com'],
        ])->map(fn($data) => User::create(array_merge($data, ['password' => bcrypt('password')])));

        $sampleReviews = [
            ['tmdb_id' => 278, 'media_type' => 'movie', 'title' => 'The Shawshank Redemption', 'poster_path' => '/9cjIGRnKoRF8lRtKOkbQmNelKOo.jpg', 'rating' => 10, 'body' => 'A masterpiece that transcends the prison drama genre. Morgan Freeman and Tim Robbins deliver performances that feel effortlessly natural. The story of hope persevering through the darkest circumstances stays with you long after the credits roll.'],
            ['tmdb_id' => 155, 'media_type' => 'movie', 'title' => 'The Dark Knight', 'poster_path' => '/qJ2tW6WMUDux911BTUgMe1ST0ts.jpg', 'rating' => 9, 'body' => 'Heath Ledger\'s Joker is one of cinema\'s greatest villains. Nolan crafted not just a superhero film but a genuine crime thriller that happens to feature a man in a bat suit. The IMAX sequences still look stunning.'],
            ['tmdb_id' => 27205, 'media_type' => 'movie', 'title' => 'Inception', 'poster_path' => '/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg', 'rating' => 9, 'body' => 'Nolan at his most ambitious. The layered dream architecture is visually stunning and intellectually engaging. Hans Zimmer\'s score is iconic. The ending still sparks debates years later.'],
            ['tmdb_id' => 680, 'media_type' => 'movie', 'title' => 'Pulp Fiction', 'poster_path' => '/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg', 'rating' => 10, 'body' => 'Tarantino rewrote the rules of narrative cinema. Every scene crackles with tension and dark humor. The non-linear structure somehow makes the story more compelling, not less.'],
            ['tmdb_id' => 1396, 'media_type' => 'tv', 'title' => 'Breaking Bad', 'poster_path' => '/ztkUQFLlC19CCMYHW9o1zWhJRNq.jpg', 'rating' => 10, 'body' => 'The gold standard for television storytelling. Walter White\'s transformation from mild-mannered teacher to drug lord is the most compelling character arc ever put to screen.'],
        ];

        foreach ($sampleReviews as $i => $review) {
            $user = $reviewers[$i % $reviewers->count()];
            Review::create(array_merge($review, ['user_id' => $user->id]));
        }
    }
}
