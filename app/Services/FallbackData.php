<?php

namespace App\Services;

/**
 * Static TMDB-formatted data for demo mode when no API token is configured.
 * All poster_path/backdrop_path values are real TMDB image paths that resolve via the public CDN.
 */
class FallbackData
{
    public static function movies(): array
    {
        return [
            ['id' => 278, 'title' => 'The Shawshank Redemption', 'overview' => 'Imprisoned in the 1940s for the double murder of his wife and her lover, upstanding banker Andy Dufresne begins a new life at the Shawshank prison, where he puts his accounting skills to work for an amoral warden. During his long stretch in prison, Dufresne comes to be admired by the other inmates — including an pointedly sarcastic old lifer named Red — for his unshakable sense of optimism and spirit of self-improvement.', 'poster_path' => '/9cjIGRnKoRF8lRtKOkbQmNelKOo.jpg', 'backdrop_path' => '/kXfqcdQKsToO0OUXHcrrNCHDBzO.jpg', 'release_date' => '1994-09-23', 'vote_average' => 8.7, 'vote_count' => 26300, 'genre_ids' => [18, 80], 'media_type' => 'movie', 'popularity' => 128.5],
            ['id' => 238, 'title' => 'The Godfather', 'overview' => 'Spanning the years 1945 to 1955, a chronicle of the fictional Italian-American Corleone crime family. When organized crime family patriarch, Vito Corleone barely survives an attempt on his life, his youngest son, Michael steps in to take care of the would-be killers, launching a campaign of bloody revenge.', 'poster_path' => '/3bhkrj58Vtu7enYsRolD1fZdja1.jpg', 'backdrop_path' => '/tmU7GeKVybMWFButWEGl2M4GeiP.jpg', 'release_date' => '1972-03-14', 'vote_average' => 8.7, 'vote_count' => 19800, 'genre_ids' => [18, 80], 'media_type' => 'movie', 'popularity' => 110.2],
            ['id' => 155, 'title' => 'The Dark Knight', 'overview' => 'Batman raises the stakes in his war on crime. With the help of Lt. Jim Gordon and District Attorney Harvey Dent, Batman sets out to dismantle the remaining criminal organizations that plague the streets. The partnership proves to be effective, but they soon find themselves prey to a reign of chaos unleashed by a rising criminal mastermind known to the terrified citizens of Gotham as the Joker.', 'poster_path' => '/qJ2tW6WMUDux911BTUgMe1ST0ts.jpg', 'backdrop_path' => '/nMKdUUepR0i5zn0y1T4CsSB5ez.jpg', 'release_date' => '2008-07-16', 'vote_average' => 8.5, 'vote_count' => 31500, 'genre_ids' => [18, 28, 80, 53], 'media_type' => 'movie', 'popularity' => 145.8],
            ['id' => 680, 'title' => 'Pulp Fiction', 'overview' => 'A burger-loving hit man, his philosophical partner, a drug-addled gangster\'s moll and a washed-up boxer converge in this sprawling, comedic crime caper. Their adventures unfold in three stories that ingeniously trip back and forth in time.', 'poster_path' => '/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg', 'backdrop_path' => '/suaEOtk1N1sgg2MTM7oZd2cfVp3.jpg', 'release_date' => '1994-09-10', 'vote_average' => 8.5, 'vote_count' => 26700, 'genre_ids' => [53, 80], 'media_type' => 'movie', 'popularity' => 98.3],
            ['id' => 27205, 'title' => 'Inception', 'overview' => 'Cobb, a skilled thief who commits corporate espionage by infiltrating the subconscious of his targets is offered a chance to regain his old life as payment for a task considered to be impossible: "inception", the implantation of another person\'s idea into a target\'s subconscious.', 'poster_path' => '/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg', 'backdrop_path' => '/8ZTVqvKDQ8emSGUEMjsS4yHAwrp.jpg', 'release_date' => '2010-07-15', 'vote_average' => 8.4, 'vote_count' => 35200, 'genre_ids' => [28, 878, 12], 'media_type' => 'movie', 'popularity' => 132.1],
            ['id' => 550, 'title' => 'Fight Club', 'overview' => 'A ticking-Loss bomb insomniac and a slippery soap salesman channel primal male aggression into a shocking new form of therapy. Their concept catches on, with underground "fight clubs" forming in every town, until an eccentric gets in the way and ignites an out-of-control spiral toward oblivion.', 'poster_path' => '/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg', 'backdrop_path' => '/hZkgoQYus5dXo3H8T7Uef6DNknx.jpg', 'release_date' => '1999-10-15', 'vote_average' => 8.4, 'vote_count' => 27800, 'genre_ids' => [18], 'media_type' => 'movie', 'popularity' => 92.4],
            ['id' => 157336, 'title' => 'Interstellar', 'overview' => 'The adventures of a group of explorers who make use of a newly discovered wormhole to surpass the limitations on human space travel and conquer the vast distances involved in an interstellar voyage.', 'poster_path' => '/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', 'backdrop_path' => '/xJHokMbljvjADYdit5fK1DDtZci.jpg', 'release_date' => '2014-11-05', 'vote_average' => 8.4, 'vote_count' => 33600, 'genre_ids' => [12, 18, 878], 'media_type' => 'movie', 'popularity' => 140.5],
            ['id' => 13, 'title' => 'Forrest Gump', 'overview' => 'A man with a low IQ has accomplished great things in his life and been present during significant historic events—in each case, far exceeding what anyone imagined he could do. But despite all his accomplishments, his one true love eludes him.', 'poster_path' => '/arw2vcBveWOVZr6pxd9XTd1TdQa.jpg', 'backdrop_path' => '/qdIMHd4sEfJSckfVJfKQvisL02a.jpg', 'release_date' => '1994-06-23', 'vote_average' => 8.5, 'vote_count' => 26100, 'genre_ids' => [35, 18, 10749], 'media_type' => 'movie', 'popularity' => 88.7],
            ['id' => 120, 'title' => 'The Lord of the Rings: The Fellowship of the Ring', 'overview' => 'Young hobbit Frodo Baggins, after inheriting a mysterious ring from his uncle Bilbo, must leave his home in order to keep it from falling into the hands of its evil creator. Along the way, a fellowship is formed to protect the ringbearer and make sure that the ring arrives at its final destination: Mt. Doom.', 'poster_path' => '/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg', 'backdrop_path' => '/pIUvQ9Ed35wlWhY2oU6OmwEsmzG.jpg', 'release_date' => '2001-12-18', 'vote_average' => 8.4, 'vote_count' => 23400, 'genre_ids' => [12, 14, 28], 'media_type' => 'movie', 'popularity' => 105.3],
            ['id' => 569094, 'title' => 'Spider-Man: Across the Spider-Verse', 'overview' => 'After reuniting with Gwen Stacy, Brooklyn\'s full-time, friendly neighborhood Spider-Man is catapulted across the Multiverse, where he encounters the Spider Society, a team of Spider-People charged with protecting the Multiverse\'s very existence.', 'poster_path' => '/8Vt6mWEReuy4Of61Lnj5Xj704m8.jpg', 'backdrop_path' => '/4HodYYKEIsGOdinkGi2Ucz6X9i0.jpg', 'release_date' => '2023-05-31', 'vote_average' => 8.4, 'vote_count' => 6200, 'genre_ids' => [16, 28, 12, 878], 'media_type' => 'movie', 'popularity' => 155.6],
            ['id' => 496243, 'title' => 'Parasite', 'overview' => 'All unemployed, Ki-taek\'s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.', 'poster_path' => '/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'backdrop_path' => '/TU9NIjwzjoKPwQHoHshkFcQUCG.jpg', 'release_date' => '2019-05-30', 'vote_average' => 8.5, 'vote_count' => 17100, 'genre_ids' => [35, 53, 18], 'media_type' => 'movie', 'popularity' => 95.2],
            ['id' => 424, 'title' => 'Schindler\'s List', 'overview' => 'The true story of how businessman Oskar Schindler saved over a thousand Jewish lives from the Nazis while they worked as slaves in his factory during World War II.', 'poster_path' => '/sF1U4EUQS8YHUYjNl3pMGNIQyr0.jpg', 'backdrop_path' => '/loRmRzQXZC0GkuN5CqOUFKSFG5.jpg', 'release_date' => '1993-12-15', 'vote_average' => 8.6, 'vote_count' => 15300, 'genre_ids' => [18, 36, 10752], 'media_type' => 'movie', 'popularity' => 72.8],
            ['id' => 244786, 'title' => 'Whiplash', 'overview' => 'Under the direction of a ruthless instructor, a talented young drummer begins to pursue perfection at any cost, even his humanity.', 'poster_path' => '/7fn624j5lj3xTme2SgiLCeuedmO.jpg', 'backdrop_path' => '/fRGxZuo7jJUWQsVzOn60FjKCPgI.jpg', 'release_date' => '2014-10-10', 'vote_average' => 8.4, 'vote_count' => 14800, 'genre_ids' => [18, 10402], 'media_type' => 'movie', 'popularity' => 65.3],
            ['id' => 11, 'title' => 'Star Wars', 'overview' => 'Princess Leia is captured and held hostage by the evil Imperial forces in their effort to take over the galactic Empire. Venturesome Luke Skywalker and dashing captain Han Solo team together with the lovable robot duo R2-D2 and C-3PO to rescue the beautiful princess and restore peace and justice in the Empire.', 'poster_path' => '/6FfCtAuVAW8XJjZ7eWeLibRLWTw.jpg', 'backdrop_path' => '/zqkmTXzjkAgXmEWLRsY4UpTWCeo.jpg', 'release_date' => '1977-05-25', 'vote_average' => 8.2, 'vote_count' => 19600, 'genre_ids' => [12, 28, 878], 'media_type' => 'movie', 'popularity' => 108.4],
            ['id' => 603, 'title' => 'The Matrix', 'overview' => 'Set in the 22nd century, The Matrix tells the story of a computer hacker who joins a group of underground insurgents fighting the vast and powerful computers who now rule the earth.', 'poster_path' => '/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg', 'backdrop_path' => '/fNG7i7RqMErkcqhohV2a6cV1Ehy.jpg', 'release_date' => '1999-03-30', 'vote_average' => 8.2, 'vote_count' => 24200, 'genre_ids' => [28, 878], 'media_type' => 'movie', 'popularity' => 102.1],
            ['id' => 550988, 'title' => 'Free Guy', 'overview' => 'A bank teller called Guy realizes he is a background character in an open world video game called Free City that will soon go offline.', 'poster_path' => '/xmbU4JTUm8rsdtn7Y3Fcm52GCwC.jpg', 'backdrop_path' => '/j28p5VwI5XeXtVOTArOxCjkPR2R.jpg', 'release_date' => '2021-08-11', 'vote_average' => 7.5, 'vote_count' => 8100, 'genre_ids' => [35, 28, 12, 878], 'media_type' => 'movie', 'popularity' => 78.3],
            ['id' => 429617, 'title' => 'Spider-Man: Far From Home', 'overview' => 'Peter Parker and his friends go on a summer trip to Europe. However, they will hardly be able to rest — Loss Peter will have to agree to help Nick Fury uncover the mystery of several elemental creature attacks.', 'poster_path' => '/4q2NNj4S5dG2RLF9CpXsej7yXl.jpg', 'backdrop_path' => '/5myQbDzw3l8K9yofUXRJ4UTVgam.jpg', 'release_date' => '2019-06-28', 'vote_average' => 7.5, 'vote_count' => 14300, 'genre_ids' => [28, 12, 878], 'media_type' => 'movie', 'popularity' => 85.1],
            ['id' => 299536, 'title' => 'Avengers: Infinity War', 'overview' => 'As the Avengers and their allies have continued to protect the world from threats too large for any one hero to handle, a new danger has emerged from the cosmic shadows: Thanos.', 'poster_path' => '/7WsyChQLEftFiDhRhUg3IeyZ7AA.jpg', 'backdrop_path' => '/bOGkgRGdhrBYJSLpXaxhXVstddV.jpg', 'release_date' => '2018-04-25', 'vote_average' => 8.3, 'vote_count' => 27500, 'genre_ids' => [12, 28, 878], 'media_type' => 'movie', 'popularity' => 125.6],
            ['id' => 346698, 'title' => 'Barbie', 'overview' => 'Barbie and Ken are having the time of their lives in the colorful and seemingly perfect world of Barbie Land. However, when they get a chance to go to the real world, they soon discover the joys and perils of living among humans.', 'poster_path' => '/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg', 'backdrop_path' => '/nHf61UzkfFno5X1ofIhugCPus2R.jpg', 'release_date' => '2023-07-19', 'vote_average' => 7.0, 'vote_count' => 8400, 'genre_ids' => [35, 12, 14], 'media_type' => 'movie', 'popularity' => 112.3],
            ['id' => 872585, 'title' => 'Oppenheimer', 'overview' => 'The story of J. Robert Oppenheimer\'s role in the development of the atomic bomb during World War II.', 'poster_path' => '/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg', 'backdrop_path' => '/nb3xI8XI3w4pMVZ38VijbsyBqP4.jpg', 'release_date' => '2023-07-19', 'vote_average' => 8.1, 'vote_count' => 8800, 'genre_ids' => [18, 36], 'media_type' => 'movie', 'popularity' => 142.7],
        ];
    }

    public static function tvShows(): array
    {
        return [
            ['id' => 1396, 'name' => 'Breaking Bad', 'overview' => 'When Walter White, a New Mexico chemistry teacher, is diagnosed with Stage III cancer and given a prognosis of two years left to live, he becomes filled with a sense of fearlessness and an unrelenting desire to secure his family\'s financial future at any cost as he enters the dangerous world of drugs and crime.', 'poster_path' => '/ztkUQFLlC19CCMYHW9o1zWhJRNq.jpg', 'backdrop_path' => '/tsRy63Mu5cu8etL1X7ZLyf7UP1M.jpg', 'first_air_date' => '2008-01-20', 'vote_average' => 8.9, 'vote_count' => 13400, 'genre_ids' => [18, 80], 'media_type' => 'tv', 'popularity' => 225.6],
            ['id' => 1399, 'name' => 'Game of Thrones', 'overview' => 'Seven noble families fight for control of the mythical land of Westeros. Friction between the houses leads to full-scale war. All while a very ancient evil awakens in the farthest north. Amidst the war, a neglected military order of misfits, the Night\'s Watch, is all that stands between the realms of men and icy horrors beyond.', 'poster_path' => '/1XS1oqL89opfnbLl8WnZY1O1uJx.jpg', 'backdrop_path' => '/2OMB0ynKlyIenMJWI2Dy9IWT4c.jpg', 'first_air_date' => '2011-04-17', 'vote_average' => 8.4, 'vote_count' => 22100, 'genre_ids' => [10765, 18, 28], 'media_type' => 'tv', 'popularity' => 195.3],
            ['id' => 94997, 'name' => 'House of the Dragon', 'overview' => 'The Targaryen dynasty is at the absolute apex of its power, with more than 15 dragons under their yoke. Most combative combative combative empires in the world crumble before the might of such combative combative combative power. It takes 200 years for the family to finally face the only threat capable of toppling them: themselves.', 'poster_path' => '/z2yahl2uefxDCl0nogcRBstwruJ.jpg', 'backdrop_path' => '/etj8E2o0Bud0HkONVQPjyCkIvpv.jpg', 'first_air_date' => '2022-08-21', 'vote_average' => 8.4, 'vote_count' => 4500, 'genre_ids' => [10765, 18, 28], 'media_type' => 'tv', 'popularity' => 180.2],
            ['id' => 100088, 'name' => 'The Last of Us', 'overview' => 'Twenty years after modern civilization has been destroyed, Joel, a hardened survivor, is hired to smuggle Ellie, a 14-year-old girl, out of an oppressive quarantine zone. What starts as a small job soon becomes a brutal, heartbreaking journey, as they both must traverse the United States and depend on each other for survival.', 'poster_path' => '/uKvVjHNqB5VmOrdxqAt2F7J78ED.jpg', 'backdrop_path' => '/uDgy6hyPd82kOHh6I95FLtM8gZp.jpg', 'first_air_date' => '2023-01-15', 'vote_average' => 8.6, 'vote_count' => 5200, 'genre_ids' => [18], 'media_type' => 'tv', 'popularity' => 210.5],
            ['id' => 1418, 'name' => 'The Big Bang Theory', 'overview' => 'The sitcom is centered on five characters living in Pasadena, California: roommates Leonard Hofstadter and Sheldon Cooper; Penny, a waitress and aspiring actress who lives across the hall; and Leonard and Sheldon\'s equally geeky and socially awkward friends and co-workers, mechanical engineer Howard Wolowitz and astrophysicist Raj Koothrappali.', 'poster_path' => '/oUnMkYgGME34h3QDe8ixbNGbOK.jpg', 'backdrop_path' => '/nGsNruW3W27V6r4gkyc3iiEGsKR.jpg', 'first_air_date' => '2007-09-24', 'vote_average' => 7.9, 'vote_count' => 10200, 'genre_ids' => [35], 'media_type' => 'tv', 'popularity' => 142.8],
            ['id' => 76479, 'name' => 'The Boys', 'overview' => 'A group of vigilantes known informally as "The Boys" set out to take down corrupt superheroes with no combative combative combative combative real power other than blue-collar grit and a willingness to fight dirty.', 'poster_path' => '/stTEycfG9Ean1emAdFqXSigplkV.jpg', 'backdrop_path' => '/7O4iVfOMQmdCSxhOg1WnzG1AgYT.jpg', 'first_air_date' => '2019-07-25', 'vote_average' => 8.5, 'vote_count' => 8700, 'genre_ids' => [10765, 28], 'media_type' => 'tv', 'popularity' => 175.4],
            ['id' => 66732, 'name' => 'Stranger Things', 'overview' => 'When a young boy vanishes, a small town uncovers a mystery involving secret experiments, terrifying supernatural forces, and one strange little girl.', 'poster_path' => '/49WJfeN0moxb9IPfGn8AIqMGskD.jpg', 'backdrop_path' => '/rcA17r3hfHtRrk3Ofqtk3MJSRBp.jpg', 'first_air_date' => '2016-07-15', 'vote_average' => 8.6, 'vote_count' => 16300, 'genre_ids' => [18, 10765, 9648], 'media_type' => 'tv', 'popularity' => 188.1],
            ['id' => 84958, 'name' => 'Loki', 'overview' => 'After stealing the Tesseract during the events of "Avengers: Endgame", an alternate version of Loki is brought to the mysterious Time Variance Authority, a bureaucratic organization that exists outside of time and space.', 'poster_path' => '/voHUmluYmKyleFkTu3lOXQSETbM.jpg', 'backdrop_path' => '/q3jHCb4dMfYF6ojikKuHd6LscxC.jpg', 'first_air_date' => '2021-06-09', 'vote_average' => 8.2, 'vote_count' => 10800, 'genre_ids' => [18, 10765, 10759], 'media_type' => 'tv', 'popularity' => 155.6],
            ['id' => 71912, 'name' => 'The Witcher', 'overview' => 'Geralt of Rivia, a mutated monster-hunter for hire, journeys toward his destiny in a turbulent world where people often prove more wicked than beasts.', 'poster_path' => '/7vjaCdMw15FEbXyLQTVa04URsPm.jpg', 'backdrop_path' => '/jBJWaqoSCiARWtfV0GlqHrcdiJq.jpg', 'first_air_date' => '2019-12-20', 'vote_average' => 8.1, 'vote_count' => 6400, 'genre_ids' => [10765, 18, 10759], 'media_type' => 'tv', 'popularity' => 132.3],
            ['id' => 93405, 'name' => 'Squid Game', 'overview' => 'Hundreds of cash-strapped players accept a strange invitation to compete in children\'s games. Inside, a tempting prize awaits with deadly high stakes.', 'poster_path' => '/dDlEmu3EZ0Pgg93K2SVNLCjCSvE.jpg', 'backdrop_path' => '/qw3J9cNeLioOLoR68WX7z79aCdK.jpg', 'first_air_date' => '2021-09-17', 'vote_average' => 7.8, 'vote_count' => 14100, 'genre_ids' => [10759, 9648, 18], 'media_type' => 'tv', 'popularity' => 200.8],
        ];
    }

    public static function trending(): array
    {
        $movies = array_slice(self::movies(), 0, 10);
        $tvShows = array_slice(self::tvShows(), 0, 5);
        $merged = array_merge($movies, $tvShows);
        shuffle($merged);
        return ['results' => $merged, 'total_results' => count($merged), 'total_pages' => 1];
    }

    public static function popularMovies(): array
    {
        return ['results' => self::movies(), 'total_results' => count(self::movies()), 'total_pages' => 1, 'page' => 1];
    }

    public static function topRatedMovies(): array
    {
        $movies = self::movies();
        usort($movies, fn($a, $b) => $b['vote_average'] <=> $a['vote_average']);
        return ['results' => $movies, 'total_results' => count($movies), 'total_pages' => 1, 'page' => 1];
    }

    public static function upcomingMovies(): array
    {
        return ['results' => array_slice(self::movies(), 8, 8), 'total_results' => 8, 'total_pages' => 1, 'page' => 1];
    }

    public static function nowPlayingMovies(): array
    {
        return ['results' => array_slice(self::movies(), 4, 10), 'total_results' => 10, 'total_pages' => 1, 'page' => 1];
    }

    public static function popularTv(): array
    {
        return ['results' => self::tvShows(), 'total_results' => count(self::tvShows()), 'total_pages' => 1, 'page' => 1];
    }

    public static function topRatedTv(): array
    {
        $shows = self::tvShows();
        usort($shows, fn($a, $b) => $b['vote_average'] <=> $a['vote_average']);
        return ['results' => $shows, 'total_results' => count($shows), 'total_pages' => 1, 'page' => 1];
    }

    public static function movieGenres(): array
    {
        return [
            ['id' => 28, 'name' => 'Action'],
            ['id' => 12, 'name' => 'Adventure'],
            ['id' => 16, 'name' => 'Animation'],
            ['id' => 35, 'name' => 'Comedy'],
            ['id' => 80, 'name' => 'Crime'],
            ['id' => 18, 'name' => 'Drama'],
            ['id' => 14, 'name' => 'Fantasy'],
            ['id' => 36, 'name' => 'History'],
            ['id' => 27, 'name' => 'Horror'],
            ['id' => 10402, 'name' => 'Music'],
            ['id' => 9648, 'name' => 'Mystery'],
            ['id' => 10749, 'name' => 'Romance'],
            ['id' => 878, 'name' => 'Science Fiction'],
            ['id' => 53, 'name' => 'Thriller'],
            ['id' => 10752, 'name' => 'War'],
        ];
    }

    public static function tvGenres(): array
    {
        return [
            ['id' => 10759, 'name' => 'Action & Adventure'],
            ['id' => 16, 'name' => 'Animation'],
            ['id' => 35, 'name' => 'Comedy'],
            ['id' => 80, 'name' => 'Crime'],
            ['id' => 18, 'name' => 'Drama'],
            ['id' => 10765, 'name' => 'Sci-Fi & Fantasy'],
            ['id' => 9648, 'name' => 'Mystery'],
        ];
    }

    public static function movieDetail(int $id): ?array
    {
        $movie = collect(self::movies())->firstWhere('id', $id);
        if (!$movie) return null;

        $genreNames = collect(self::movieGenres());
        $genres = collect($movie['genre_ids'] ?? [])->map(fn($gid) => $genreNames->firstWhere('id', $gid))->filter()->values()->toArray();

        return array_merge($movie, [
            'genres' => $genres,
            'runtime' => rand(90, 180),
            'tagline' => self::tagline($id),
            'status' => 'Released',
            'credits' => ['cast' => self::cast($id)],
            'videos' => ['results' => []],
            'recommendations' => ['results' => array_slice(self::movies(), 0, 10)],
            'reviews' => ['results' => []],
        ]);
    }

    public static function tvDetail(int $id): ?array
    {
        $show = collect(self::tvShows())->firstWhere('id', $id);
        if (!$show) return null;

        $genreNames = collect(self::tvGenres());
        $genres = collect($show['genre_ids'] ?? [])->map(fn($gid) => $genreNames->firstWhere('id', $gid))->filter()->values()->toArray();

        return array_merge($show, [
            'genres' => $genres,
            'number_of_seasons' => rand(2, 8),
            'status' => 'Returning Series',
            'tagline' => '',
            'credits' => ['cast' => self::cast($id)],
            'videos' => ['results' => []],
            'recommendations' => ['results' => array_slice(self::tvShows(), 0, 5)],
            'reviews' => ['results' => []],
        ]);
    }

    public static function search(string $query): array
    {
        $query = strtolower($query);
        $results = [];

        foreach (self::movies() as $movie) {
            if (str_contains(strtolower($movie['title']), $query)) {
                $results[] = $movie;
            }
        }
        foreach (self::tvShows() as $show) {
            if (str_contains(strtolower($show['name']), $query)) {
                $results[] = $show;
            }
        }

        // If no exact match, return a subset
        if (empty($results)) {
            $results = array_slice(array_merge(self::movies(), self::tvShows()), 0, 8);
        }

        return ['results' => $results, 'total_results' => count($results), 'total_pages' => 1];
    }

    public static function moviesByGenre(int $genreId): array
    {
        $results = collect(self::movies())->filter(fn($m) => in_array($genreId, $m['genre_ids'] ?? []))->values()->toArray();
        if (empty($results)) $results = self::movies();
        return ['results' => $results, 'total_results' => count($results), 'total_pages' => 1, 'page' => 1];
    }

    public static function person(int $id): array
    {
        $names = [
            'Morgan Freeman', 'Marlon Brando', 'Christian Bale', 'Samuel L. Jackson',
            'Leonardo DiCaprio', 'Brad Pitt', 'Matthew McConaughey', 'Tom Hanks',
            'Elijah Wood', 'Shameik Moore',
        ];
        $name = $names[$id % count($names)] ?? 'Actor Name';

        return [
            'id' => $id,
            'name' => $name,
            'biography' => "{$name} is an acclaimed actor known for numerous iconic roles across film and television. With a career spanning decades, they have earned critical recognition and a devoted global following.",
            'birthday' => '1965-06-15',
            'place_of_birth' => 'Los Angeles, California, USA',
            'profile_path' => null,
            'known_for_department' => 'Acting',
            'combined_credits' => [
                'cast' => array_map(fn($m) => array_merge($m, ['character' => 'Lead Role']), array_slice(self::movies(), 0, 6)),
            ],
        ];
    }

    private static function tagline(int $id): string
    {
        $taglines = [
            278 => 'Fear can hold you prisoner. Hope can set you free.',
            238 => "An offer you can't refuse.",
            155 => 'Why so serious?',
            680 => "You won't know the facts until you've seen the fiction.",
            27205 => 'Your mind is the scene of the crime.',
            550 => 'Mischief. Mayhem. Soap.',
            157336 => 'Mankind was born on Earth. It was never meant to die here.',
            13 => 'The world will never be the same once you\'ve seen it through the eyes of Forrest Gump.',
            120 => 'One Ring to rule them all.',
            603 => 'Welcome to the Real World.',
        ];
        return $taglines[$id] ?? '';
    }

    private static function cast(int $movieId): array
    {
        $castSets = [
            278 => [
                ['id' => 192, 'name' => 'Morgan Freeman', 'character' => 'Ellis Boyd "Red" Redding', 'profile_path' => '/oIciQWr8VwKoR8TmAw1owaiZFyb.jpg'],
                ['id' => 504, 'name' => 'Tim Robbins', 'character' => 'Andy Dufresne', 'profile_path' => '/djLVFETFTvPyVUdrd7aLVykobof.jpg'],
                ['id' => 4029, 'name' => 'Bob Gunton', 'character' => 'Warden Samuel Norton', 'profile_path' => null],
                ['id' => 6573, 'name' => 'William Sadler', 'character' => 'Heywood', 'profile_path' => null],
                ['id' => 7036, 'name' => 'Clancy Brown', 'character' => 'Captain Hadley', 'profile_path' => null],
            ],
            155 => [
                ['id' => 17419, 'name' => 'Heath Ledger', 'character' => 'The Joker', 'profile_path' => '/5Y9HnYYa0jF4KRGQN7BDhVnSe0.jpg'],
                ['id' => 3894, 'name' => 'Christian Bale', 'character' => 'Bruce Wayne / Batman', 'profile_path' => '/qCpZn2e3dimwbryLnqxZuI88PTi.jpg'],
                ['id' => 1810, 'name' => 'Morgan Freeman', 'character' => 'Lucius Fox', 'profile_path' => '/oIciQWr8VwKoR8TmAw1owaiZFyb.jpg'],
                ['id' => 64, 'name' => 'Gary Oldman', 'character' => 'James Gordon', 'profile_path' => null],
                ['id' => 2037, 'name' => 'Aaron Eckhart', 'character' => 'Harvey Dent', 'profile_path' => null],
            ],
        ];

        if (isset($castSets[$movieId])) {
            return $castSets[$movieId];
        }

        // Generic cast for any other movie
        return [
            ['id' => 100001, 'name' => 'Lead Actor', 'character' => 'Protagonist', 'profile_path' => null],
            ['id' => 100002, 'name' => 'Supporting Actor', 'character' => 'Supporting Role', 'profile_path' => null],
            ['id' => 100003, 'name' => 'Featured Actor', 'character' => 'Key Character', 'profile_path' => null],
        ];
    }
}
