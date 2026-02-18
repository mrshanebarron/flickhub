<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TmdbService
{
    protected string $baseUrl = 'https://api.themoviedb.org/3';
    protected string $token;
    protected string $imageBase = 'https://image.tmdb.org/t/p/';

    public function __construct()
    {
        $this->token = config('services.tmdb.token');
    }

    protected function get(string $endpoint, array $params = []): ?array
    {
        $cacheKey = 'tmdb_' . md5($endpoint . serialize($params));

        return Cache::remember($cacheKey, 3600, function () use ($endpoint, $params) {
            $response = Http::withToken($this->token)
                ->get($this->baseUrl . $endpoint, $params);

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        });
    }

    // --- Trending ---
    public function trending(string $type = 'all', string $window = 'week'): array
    {
        return $this->get("/trending/{$type}/{$window}") ?? ['results' => []];
    }

    // --- Movies ---
    public function popularMovies(int $page = 1): array
    {
        return $this->get('/movie/popular', ['page' => $page]) ?? ['results' => []];
    }

    public function topRatedMovies(int $page = 1): array
    {
        return $this->get('/movie/top_rated', ['page' => $page]) ?? ['results' => []];
    }

    public function upcomingMovies(int $page = 1): array
    {
        return $this->get('/movie/upcoming', ['page' => $page]) ?? ['results' => []];
    }

    public function nowPlayingMovies(int $page = 1): array
    {
        return $this->get('/movie/now_playing', ['page' => $page]) ?? ['results' => []];
    }

    public function movie(int $id): ?array
    {
        return $this->get("/movie/{$id}", [
            'append_to_response' => 'credits,videos,recommendations,reviews',
        ]);
    }

    public function moviesByGenre(int $genreId, int $page = 1): array
    {
        return $this->get('/discover/movie', [
            'with_genres' => $genreId,
            'sort_by' => 'popularity.desc',
            'page' => $page,
        ]) ?? ['results' => []];
    }

    // --- TV Shows ---
    public function popularTv(int $page = 1): array
    {
        return $this->get('/tv/popular', ['page' => $page]) ?? ['results' => []];
    }

    public function topRatedTv(int $page = 1): array
    {
        return $this->get('/tv/top_rated', ['page' => $page]) ?? ['results' => []];
    }

    public function tvShow(int $id): ?array
    {
        return $this->get("/tv/{$id}", [
            'append_to_response' => 'credits,videos,recommendations,reviews',
        ]);
    }

    // --- Genres ---
    public function movieGenres(): array
    {
        $data = $this->get('/genre/movie/list') ?? ['genres' => []];
        return $data['genres'];
    }

    public function tvGenres(): array
    {
        $data = $this->get('/genre/tv/list') ?? ['genres' => []];
        return $data['genres'];
    }

    // --- Search ---
    public function search(string $query, int $page = 1): array
    {
        return $this->get('/search/multi', [
            'query' => $query,
            'page' => $page,
        ]) ?? ['results' => [], 'total_results' => 0, 'total_pages' => 0];
    }

    // --- Person ---
    public function person(int $id): ?array
    {
        return $this->get("/person/{$id}", [
            'append_to_response' => 'combined_credits',
        ]);
    }

    // --- Image URLs ---
    public function posterUrl(?string $path, string $size = 'w342'): string
    {
        if (!$path) {
            return 'https://placehold.co/342x513/1a1a2e/e0e0e0?text=No+Poster';
        }
        return $this->imageBase . $size . $path;
    }

    public function backdropUrl(?string $path, string $size = 'w1280'): string
    {
        if (!$path) {
            return 'https://placehold.co/1280x720/1a1a2e/e0e0e0?text=No+Image';
        }
        return $this->imageBase . $size . $path;
    }

    public function profileUrl(?string $path, string $size = 'w185'): string
    {
        if (!$path) {
            return 'https://placehold.co/185x278/1a1a2e/e0e0e0?text=No+Photo';
        }
        return $this->imageBase . $size . $path;
    }
}
