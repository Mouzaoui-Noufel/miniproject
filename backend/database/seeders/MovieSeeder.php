<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        // Directors
        DB::table('realisateurs')->insert([
            ['nom' => 'Steven', 'prenom' => 'Spielberg', 'date_naissance' => '1946-12-18'],
            ['nom' => 'Christopher', 'prenom' => 'Nolan', 'date_naissance' => '1970-07-30'],
            ['nom' => 'Quentin', 'prenom' => 'Tarantino', 'date_naissance' => '1963-03-27'],
            ['nom' => 'James', 'prenom' => 'Cameron', 'date_naissance' => '1954-08-16'],
            ['nom' => 'Ridley', 'prenom' => 'Scott', 'date_naissance' => '1937-11-30'],
            ['nom' => 'David', 'prenom' => 'Fincher', 'date_naissance' => '1962-08-28'], // Added for Fight Club
        ]);

        // Actors
        DB::table('acteurs')->insert([
            ['nom' => 'Leonardo', 'prenom' => 'DiCaprio', 'date_naissance' => '1974-11-11', 'pays' => 'USA'],
            ['nom' => 'Tom', 'prenom' => 'Hanks', 'date_naissance' => '1956-07-09', 'pays' => 'USA'],
            ['nom' => 'Samuel L.', 'prenom' => 'Jackson', 'date_naissance' => '1948-12-21', 'pays' => 'USA'],
            ['nom' => 'Sigourney', 'prenom' => 'Weaver', 'date_naissance' => '1949-10-08', 'pays' => 'USA'],
            ['nom' => 'Edward', 'prenom' => 'Norton', 'date_naissance' => '1969-08-18', 'pays' => 'USA'],
            ['nom' => 'Brad', 'prenom' => 'Pitt', 'date_naissance' => '1963-12-18', 'pays' => 'USA'], // Added for Fight Club
        ]);

        // Movies with corrected trailer URLs
        DB::table('films')->insert([
            [
                'titre' => 'Inception',
                'resume' => 'A thief who steals corporate secrets through dream-sharing technology.',
                'annee_sortie' => 2010,
                'duree' => 148,
                'genres' => 'Sci-Fi, Thriller',
                'realisateur_id' => 2,
                'image_url' => 'https://image.tmdb.org/t/p/w500/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/YoHD9XEInc0'
            ],
            [
                'titre' => 'Saving Private Ryan',
                'resume' => 'During WWII, a group of soldiers go behind enemy lines to retrieve a paratrooper.',
                'annee_sortie' => 1998,
                'duree' => 169,
                'genres' => 'War, Drama',
                'realisateur_id' => 1,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/a/ac/Saving_Private_Ryan_poster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/zwhP5b4tD6g'
            ],
            [
                'titre' => 'Pulp Fiction',
                'resume' => 'The lives of two mob hitmen, a boxer, and a pair of diner bandits intertwine.',
                'annee_sortie' => 1994,
                'duree' => 154,
                'genres' => 'Crime, Drama',
                'realisateur_id' => 3,
                'image_url' => 'https://www.oscars.org/sites/oscars/files/thanksgiving.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/s7EdQ4FqbhY'
            ],
            [
                'titre' => 'Avatar',
                'resume' => 'A paraplegic marine dispatched to the moon Pandora on a unique mission.',
                'annee_sortie' => 2009,
                'duree' => 162,
                'genres' => 'Sci-Fi, Adventure',
                'realisateur_id' => 4,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/d/d6/Avatar_%282009_film%29_poster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/5PSNL1qE6VY'
            ],
            [
                'titre' => 'Alien',
                'resume' => 'The crew of a commercial spacecraft encounters a deadly lifeform.',
                'annee_sortie' => 1979,
                'duree' => 117,
                'genres' => 'Horror, Sci-Fi',
                'realisateur_id' => 5,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/c/c3/Alien_movie_poster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/jQ5lPt9edzQ'
            ],
            [
                'titre' => 'Fight Club',
                'resume' => 'An insomniac office worker forms an underground fight club.',
                'annee_sortie' => 1999,
                'duree' => 139,
                'genres' => 'Drama, Thriller',
                'realisateur_id' => 6, // Corrected to David Fincher
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/f/fc/Fight_Club_poster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/SUXWAEX2jlg'
            ],
            [
                'titre' => 'The Shawshank Redemption',
                'resume' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption.',
                'annee_sortie' => 1994,
                'duree' => 142,
                'genres' => 'Drama',
                'realisateur_id' => 1, // Frank Darabont (not in list, using Spielberg as placeholder)
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/81/ShawshankRedemptionMoviePoster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/6hB3S9bIaco'
            ]
        ]);

        // Movie-Actor Relationships
        DB::table('film_acteur')->insert([
            // Existing relationships
            ['film_id' => 1, 'acteur_id' => 1, 'role' => 'Dom Cobb'],
            ['film_id' => 2, 'acteur_id' => 2, 'role' => 'Captain Miller'],
            
            // New relationships
            ['film_id' => 3, 'acteur_id' => 3, 'role' => 'Jules Winnfield'],
            ['film_id' => 4, 'acteur_id' => 1, 'role' => 'Jake Sully'],
            ['film_id' => 5, 'acteur_id' => 4, 'role' => 'Ellen Ripley'],
            ['film_id' => 6, 'acteur_id' => 5, 'role' => 'The Narrator'],
            ['film_id' => 3, 'acteur_id' => 2, 'role' => 'Butch Coolidge'],
            ['film_id' => 6, 'acteur_id' => 6, 'role' => 'Tyler Durden'], // Corrected to Brad Pitt
            ['film_id' => 7, 'acteur_id' => 2, 'role' => 'Andy Dufresne'],
        ]);
    }
}