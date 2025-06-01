# Movie Application Backend

This is the backend API for the Movie Application built with Laravel. It provides endpoints for managing movies, user authentication, ratings, reviews, and favorites functionality.

## Features

- **User Authentication**
  - Registration and Login with Laravel Sanctum
  - Token-based authentication
  - Protected routes

- **Movie Management**
  - List movies with pagination and search
  - Detailed movie information
  - Movies have directors (réalisateurs) and actors (acteurs)
  - Support for movie images and trailer URLs

- **User Interactions**
  - Rate movies (1-5 stars)
  - Write and manage reviews
  - Add/remove movies to favorites
  - View personalized lists (favorites, etc.)

## Technology Stack

- Laravel 10.x
- MySQL Database
- Laravel Sanctum for Authentication
- CORS enabled for frontend communication

## Setup Instructions

1. Clone the repository
2. Install dependencies:
```bash
composer install
```

3. Create and configure `.env` file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

## API Endpoints

### Authentication
- `POST /api/register` - Register new user
- `POST /api/login` - User login
- `POST /api/logout` - User logout (protected)

### Movies
- `GET /api/movies` - List all movies (paginated)
- `GET /api/movies/{id}` - Get movie details
- `POST /api/movies` - Create new movie (protected)
- `PUT /api/movies/{id}` - Update movie (protected)
- `DELETE /api/movies/{id}` - Delete movie (protected)

### Ratings
- `POST /api/movies/{film}/rate` - Rate a movie (protected)
- `DELETE /api/movies/{film}/rate` - Remove rating (protected)
- `GET /api/movies/{film}/rating` - Get movie rating stats

### Reviews
- `GET /api/movies/{film}/reviews` - Get movie reviews
- `POST /api/movies/{film}/reviews` - Add review (protected)
- `PUT /api/movies/{film}/reviews/{review}` - Update review (protected)
- `DELETE /api/movies/{film}/reviews/{review}` - Delete review (protected)

### Favorites
- `GET /api/favorites` - List user's favorite movies (protected)
- `POST /api/movies/{film}/favorite` - Add to favorites (protected)
- `DELETE /api/movies/{film}/favorite` - Remove from favorites (protected)
- `GET /api/movies/{film}/favorite/check` - Check if movie is favorited (protected)

## Database Structure

The application uses several interconnected models:
- `User` - User accounts and authentication
- `Film` - Movie information
- `Realisateur` - Movie directors
- `Acteur` - Movie actors
- `Rating` - Movie ratings
- `Review` - Movie reviews
- `Favorite` - User's favorite movies

## Error Handling

The API uses standard HTTP status codes and returns error messages in JSON format:
```json
{
    "message": "Error description",
    "errors": {
        "field": ["Validation error messages"]
    }
}
```

## Security

- Authentication using Laravel Sanctum
- CSRF protection enabled
- Input validation on all endpoints
- Protected routes for authenticated users only

## License

This project is licensed under the MIT License.
