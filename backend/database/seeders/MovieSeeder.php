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
            ['nom' => 'Francis', 'prenom' => 'Ford Coppola', 'date_naissance' => '1939-04-07'],
            ['nom' => 'Tim', 'prenom' => 'Burton', 'date_naissance' => '1958-08-25'],
            ['nom' => 'Guillermo', 'prenom' => 'del Toro', 'date_naissance' => '1964-10-09'],
            ['nom' => 'Denis', 'prenom' => 'Villeneuve', 'date_naissance' => '1967-10-03'],
            ['nom' => 'Wes', 'prenom' => 'Anderson', 'date_naissance' => '1969-05-01'],
            ['nom' => 'Stanley', 'prenom' => 'Kubrick', 'date_naissance' => '1928-07-26'],
            ['nom' => 'Sergio', 'prenom' => 'Leone', 'date_naissance' => '1929-01-03'],
            ['nom' => 'George', 'prenom' => 'Miller', 'date_naissance' => '1945-03-03'],
             ['nom' => 'Martin', 'prenom' => 'Scorsese', 'date_naissance' => '1942-11-17'],
    ['nom' => 'Stanley', 'prenom' => 'Kubrick', 'date_naissance' => '1928-07-26'],
    ['nom' => 'Peter', 'prenom' => 'Jackson', 'date_naissance' => '1961-10-31'],
    ['nom' => 'George', 'prenom' => 'Lucas', 'date_naissance' => '1944-05-14'],
    ['nom' => 'Alfred', 'prenom' => 'Hitchcock', 'date_naissance' => '1899-08-13'],
    ['nom' => 'David', 'prenom' => 'Lynch', 'date_naissance' => '1946-01-20'],
    ['nom' => 'Paul', 'prenom' => 'Thomas Anderson', 'date_naissance' => '1970-06-26'],
    ['nom' => 'Richard', 'prenom' => 'Linklater', 'date_naissance' => '1960-07-30'],
    ['nom' => 'Akira', 'prenom' => 'Kurosawa', 'date_naissance' => '1910-03-23'],
    ['nom' => 'Hayao', 'prenom' => 'Miyazaki', 'date_naissance' => '1941-01-05'],
    ['nom' => 'Greta', 'prenom' => 'Gerwig', 'date_naissance' => '1983-08-04'],
    ['nom' => 'Damien', 'prenom' => 'Chazelle', 'date_naissance' => '1985-01-19'],
    ['nom' => 'Rian', 'prenom' => 'Johnson', 'date_naissance' => '1973-12-17'],
    ['nom' => 'Todd', 'prenom' => 'Phillips', 'date_naissance' => '1970-12-20'],
    ['nom' => 'Jordan', 'prenom' => 'Peele', 'date_naissance' => '1979-02-21'],
    ['nom' => 'Bong', 'prenom' => 'Joon-ho', 'date_naissance' => '1969-09-14'],
        ]);

        // Actors
        DB::table('acteurs')->insert([
            ['nom' => 'Leonardo', 'prenom' => 'DiCaprio', 'date_naissance' => '1974-11-11', 'pays' => 'USA'],
            ['nom' => 'Tom', 'prenom' => 'Hanks', 'date_naissance' => '1956-07-09', 'pays' => 'USA'],
            ['nom' => 'Samuel L.', 'prenom' => 'Jackson', 'date_naissance' => '1948-12-21', 'pays' => 'USA'],
            ['nom' => 'Sigourney', 'prenom' => 'Weaver', 'date_naissance' => '1949-10-08', 'pays' => 'USA'],
            ['nom' => 'Edward', 'prenom' => 'Norton', 'date_naissance' => '1969-08-18', 'pays' => 'USA'],
            ['nom' => 'Brad', 'prenom' => 'Pitt', 'date_naissance' => '1963-12-18', 'pays' => 'USA'],
            ['nom' => 'Meryl', 'prenom' => 'Streep', 'date_naissance' => '1949-06-22', 'pays' => 'USA'],
            ['nom' => 'Jack', 'prenom' => 'Nicholson', 'date_naissance' => '1937-04-22', 'pays' => 'USA'],
            ['nom' => 'Denzel', 'prenom' => 'Washington', 'date_naissance' => '1954-12-28', 'pays' => 'USA'],
            ['nom' => 'Charlize', 'prenom' => 'Theron', 'date_naissance' => '1975-08-07', 'pays' => 'South Africa'],
            ['nom' => 'Javier', 'prenom' => 'Bardem', 'date_naissance' => '1969-03-01', 'pays' => 'Spain'],
            ['nom' => 'Nicole', 'prenom' => 'Kidman', 'date_naissance' => '1967-06-20', 'pays' => 'Australia'],
            ['nom' => 'Keanu', 'prenom' => 'Reeves', 'date_naissance' => '1964-09-02', 'pays' => 'Canada'],
            ['nom' => 'Hugh', 'prenom' => 'Jackman', 'date_naissance' => '1968-10-12', 'pays' => 'Australia'],
             ['nom' => 'Robert', 'prenom' => 'De Niro', 'date_naissance' => '1943-08-17', 'pays' => 'USA'],
    ['nom' => 'Morgan', 'prenom' => 'Freeman', 'date_naissance' => '1937-06-01', 'pays' => 'USA'],
    ['nom' => 'Cate', 'prenom' => 'Blanchett', 'date_naissance' => '1969-05-14', 'pays' => 'Australia'],
    ['nom' => 'Johnny', 'prenom' => 'Depp', 'date_naissance' => '1963-06-09', 'pays' => 'USA'],
    ['nom' => 'Natalie', 'prenom' => 'Portman', 'date_naissance' => '1981-06-09', 'pays' => 'palestine'],
     ['nom' => 'Joaquin', 'prenom' => 'Phoenix', 'date_naissance' => '1974-10-28', 'pays' => 'USA'],
    ['nom' => 'Zendaya', 'prenom' => '', 'date_naissance' => '1996-09-01', 'pays' => 'USA'],
    ['nom' => 'Cillian', 'prenom' => 'Murphy', 'date_naissance' => '1976-05-25', 'pays' => 'Ireland'],
    ['nom' => 'Margot', 'prenom' => 'Robbie', 'date_naissance' => '1990-07-02', 'pays' => 'Australia'],
    ['nom' => 'Daniel', 'prenom' => 'Day-Lewis', 'date_naissance' => '1957-04-29', 'pays' => 'UK'],
    ['nom' => 'Viola', 'prenom' => 'Davis', 'date_naissance' => '1965-08-11', 'pays' => 'USA'],
    ['nom' => 'Timothée', 'prenom' => 'Chalamet', 'date_naissance' => '1995-12-27', 'pays' => 'USA'],
    ['nom' => 'Florence', 'prenom' => 'Pugh', 'date_naissance' => '1996-01-03', 'pays' => 'UK'],
    ['nom' => 'Ryan', 'prenom' => 'Gosling', 'date_naissance' => '1980-11-12', 'pays' => 'Canada'],
    ['nom' => 'Emma', 'prenom' => 'Stone', 'date_naissance' => '1988-11-06', 'pays' => 'USA'],
    ['nom' => 'Song', 'prenom' => 'Kang-ho', 'date_naissance' => '1967-01-17', 'pays' => 'South Korea'],
        ]);

        // Movies with corrected trailer URLs and fixed image URLs
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
                'realisateur_id' => 6,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/f/fc/Fight_Club_poster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/SUXWAEX2jlg'
            ],
            [
                'titre' => 'The Shawshank Redemption',
                'resume' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption.',
                'annee_sortie' => 1994,
                'duree' => 142,
                'genres' => 'Drama',
                'realisateur_id' => 1,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/81/ShawshankRedemptionMoviePoster.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/6hB3S9bIaco'
            ],
            [
                'titre' => 'Mad Max: Fury Road',
                'resume' => 'A woman rebels against a tyrannical ruler in a post-apocalyptic wasteland.',
                'annee_sortie' => 2015,
                'duree' => 120,
                'genres' => 'Action, Adventure',
                'realisateur_id' => 14,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/6/6e/Mad_Max_Fury_Road.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/hEJnMQG9ev8'
            ],
            [
                'titre' => 'Pans Labyrinth',
                'resume' => 'A young girl discovers a mysterious labyrinth in post-Civil War Spain.',
                'annee_sortie' => 2006,
                'duree' => 118,
                'genres' => 'Drama, Fantasy',
                'realisateur_id' => 9,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/6/67/Pan%27s_Labyrinth.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/EqYiSlkvRuw'
            ],
            [
                'titre' => 'The Shining',
                'resume' => 'A writer and his family are tormented by supernatural forces at a remote hotel.',
                'annee_sortie' => 1980,
                'duree' => 146,
                'genres' => 'Horror, Thriller',
                'realisateur_id' => 12,
                'image_url' => 'https://image.tmdb.org/t/p/w500/xazWoLealQwEgqZ89MLZklLZD3k.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/S014oGZiSdI'
            ],
            [
                'titre' => 'The Godfather',
                'resume' => 'The aging patriarch of an organized crime dynasty transfers control to his reluctant son.',
                'annee_sortie' => 1972,
                'duree' => 175,
                'genres' => 'Crime, Drama',
                'realisateur_id' => 7,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/1/1c/Godfather_ver1.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/sY1S34973zA'
            ],
            [
                'titre' => 'The Lord of the Rings: The Fellowship of the Ring',
                'resume' => 'A hobbit sets out on a quest to destroy the One Ring.',
                'annee_sortie' => 2001,
                'duree' => 178,
                'genres' => 'Adventure, Fantasy',
                'realisateur_id' => 17,
                'image_url' => 'https://image.tmdb.org/t/p/w500/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/V75dMMIW2B4'
            ],
            [
                'titre' => 'Joker',
                'resume' => 'A failed comedian embarks on a descent into madness and chaos.',
                'annee_sortie' => 2019,
                'duree' => 122,
                'genres' => 'Crime, Drama',
                'realisateur_id' => 28,
                'image_url' => 'https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/t433PEQGErc'
            ],
            [
                'titre' => 'Oppenheimer',
                'resume' => 'The story of J. Robert Oppenheimer and the development of the atomic bomb.',
                'annee_sortie' => 2023,
                'duree' => 180,
                'genres' => 'Biography, Drama',
                'realisateur_id' => 2,
                'image_url' => 'https://image.tmdb.org/t/p/w500/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/bK6ldnjE3Y0'
            ],
            [
                'titre' => 'Spirited Away',
                'resume' => 'A young girl wanders into a magical world ruled by spirits.',
                'annee_sortie' => 2001,
                'duree' => 125,
                'genres' => 'Animation, Fantasy',
                'realisateur_id' => 24,
                'image_url' => 'https://image.tmdb.org/t/p/w500/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/ByXuk9QqQkk'
            ],
            // 9 NEW MOVIES ADDED BELOW
            [
                'titre' => 'The Dark Knight',
                'resume' => 'Batman faces his greatest psychological and physical tests when the Joker wreaks havoc on Gotham.',
                'annee_sortie' => 2008,
                'duree' => 152,
                'genres' => 'Action, Crime, Drama',
                'realisateur_id' => 2,
                'image_url' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/EXeTwQWrcwY'
            ],
            [
                'titre' => 'Parasite',
                'resume' => 'A poor family schemes to become employed by a wealthy family by infiltrating their household.',
                'annee_sortie' => 2019,
                'duree' => 132,
                'genres' => 'Comedy, Drama, Thriller',
                'realisateur_id' => 30,
                'image_url' => 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/5xH0HfJHsaY'
            ],
            [
                'titre' => 'Dune',
                'resume' => 'Paul Atreides leads nomadic tribes in a revolt against the galactic emperor and his father\'s enemy.',
                'annee_sortie' => 2021,
                'duree' => 155,
                'genres' => 'Adventure, Drama, Sci-Fi',
                'realisateur_id' => 10,
                'image_url' => 'https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/n9xhJrPXop4'
            ],
            [
                'titre' => 'Get Out',
                'resume' => 'A young African-American visits his white girlfriend\'s parents for the weekend, where his simmering uneasiness becomes a nightmare.',
                'annee_sortie' => 2017,
                'duree' => 104,
                'genres' => 'Horror, Mystery, Thriller',
                'realisateur_id' => 29,
                'image_url' => 'https://image.tmdb.org/t/p/w500/tFXcEccSQMf3lfhfXKSU9iRBpa3.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/DzfpyUB60YY'
            ],
            [
                'titre' => 'La La Land',
                'resume' => 'A jazz musician and an aspiring actress meet and fall in love in Los Angeles while pursuing their dreams.',
                'annee_sortie' => 2016,
                'duree' => 128,
                'genres' => 'Comedy, Drama, Musical',
                'realisateur_id' => 26,
                'image_url' => 'https://image.tmdb.org/t/p/w500/uDO8zWDhfWwoFdKS4fzkUJt0Rf0.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/0pdqf4P9MB8'
            ],
            [
                'titre' => 'The Matrix',
                'resume' => 'A computer programmer discovers that reality as he knows it is a simulation controlled by machines.',
                'annee_sortie' => 1999,
                'duree' => 136,
                'genres' => 'Action, Sci-Fi',
                'realisateur_id' => 1, // Placeholder for Wachowski Sisters
                'image_url' => 'https://image.tmdb.org/t/p/w500/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/vKQi3bBA1y8'
            ],
            [
                'titre' => 'Goodfellas',
                'resume' => 'The story of Henry Hill and his life in the mafia, covering his relationship with his wife and his mob partners.',
                'annee_sortie' => 1990,
                'duree' => 146,
                'genres' => 'Biography, Crime, Drama',
                'realisateur_id' => 15,
                'image_url' => 'https://image.tmdb.org/t/p/w500/aKuFiU82s5ISJpGZp7YkIr3kCUd.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/qo5jJpHtI1Y'
            ],
            [
                'titre' => 'Barbie',
                'resume' => 'Barbie and Ken are having the time of their lives in Barbie Land until an existential crisis leads them on a journey of self-discovery.',
                'annee_sortie' => 2023,
                'duree' => 114,
                'genres' => 'Adventure, Comedy, Fantasy',
                'realisateur_id' => 25,
                'image_url' => 'https://image.tmdb.org/t/p/w500/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/pBk4NYhWNMM'
            ],
            [
                'titre' => 'Blade Runner 2049',
                'resume' => 'A young blade runner discovers a secret that leads him to Rick Deckard, who has been missing for thirty years.',
                'annee_sortie' => 2017,
                'duree' => 164,
                'genres' => 'Action, Drama, Mystery',
                'realisateur_id' => 10,
                'image_url' => 'https://image.tmdb.org/t/p/w500/gajva2L0rPYkEWjzgFlBXCAVBE5.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/gCcx85zbxz4'
            ]
        ]);

        // Movie-Actor Relationships (including new movies)
        DB::table('film_acteur')->insert([
            ['film_id' => 1, 'acteur_id' => 1, 'role' => 'Dom Cobb'],
            ['film_id' => 2, 'acteur_id' => 2, 'role' => 'Captain Miller'],
            ['film_id' => 3, 'acteur_id' => 3, 'role' => 'Jules Winnfield'],
            ['film_id' => 4, 'acteur_id' => 1, 'role' => 'Jake Sully'],
            ['film_id' => 5, 'acteur_id' => 4, 'role' => 'Ellen Ripley'],
            ['film_id' => 6, 'acteur_id' => 5, 'role' => 'The Narrator'],
            ['film_id' => 3, 'acteur_id' => 2, 'role' => 'Butch Coolidge'],
            ['film_id' => 6, 'acteur_id' => 6, 'role' => 'Tyler Durden'],
            ['film_id' => 7, 'acteur_id' => 2, 'role' => 'Andy Dufresne'],
            ['film_id' => 8, 'acteur_id' => 10, 'role' => 'Imperator Furiosa'],
            ['film_id' => 8, 'acteur_id' => 14, 'role' => 'Max Rockatansky'],
            ['film_id' => 9, 'acteur_id' => 11, 'role' => 'Captain Vidal'],
            ['film_id' => 10, 'acteur_id' => 8, 'role' => 'Jack Torrance'],
            ['film_id' => 11, 'acteur_id' => 15, 'role' => 'Vito Corleone'],
            ['film_id' => 12, 'acteur_id' => 17, 'role' => 'Galadriel'],
            ['film_id' => 13, 'acteur_id' => 20, 'role' => 'Arthur Fleck'],
            ['film_id' => 14, 'acteur_id' => 22, 'role' => 'J. Robert Oppenheimer'],
            ['film_id' => 15, 'acteur_id' => 26, 'role' => 'Chihiro'],
            // New movie relationships
            ['film_id' => 16, 'acteur_id' => 8, 'role' => 'Joker'], // The Dark Knight
            ['film_id' => 17, 'acteur_id' => 30, 'role' => 'Ki-taek'], // Parasite
            ['film_id' => 18, 'acteur_id' => 26, 'role' => 'Paul Atreides'], // Dune
            ['film_id' => 18, 'acteur_id' => 21, 'role' => 'Chani'], // Dune - Zendaya
            ['film_id' => 19, 'acteur_id' => 9, 'role' => 'Chris Washington'], // Get Out (fictional casting)
            ['film_id' => 20, 'acteur_id' => 28, 'role' => 'Sebastian'], // La La Land
            ['film_id' => 20, 'acteur_id' => 29, 'role' => 'Mia'], // La La Land
            ['film_id' => 21, 'acteur_id' => 13, 'role' => 'Neo'], // The Matrix
            ['film_id' => 22, 'acteur_id' => 15, 'role' => 'Henry Hill'], // Goodfellas
            ['film_id' => 23, 'acteur_id' => 23, 'role' => 'Barbie'], // Barbie
            ['film_id' => 23, 'acteur_id' => 28, 'role' => 'Ken'], // Barbie
            ['film_id' => 24, 'acteur_id' => 28, 'role' => 'K'], // Blade Runner 2049
        ]);
    }
}