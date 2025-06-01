# Movie App

This is a simple movie application with a Laravel backend and React frontend.

## Backend (Laravel)

### Setup

1. Navigate to the backend directory:
   ```
   cd backend
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. Configure your `.env` file with your database credentials.

4. Run migrations:
   ```
   php artisan migrate
   ```

5. Start the backend server:
   ```
   php artisan serve
   ```

The backend API endpoints are available under `http://localhost:8000/api/movies`.

For example:
- List movies: GET `http://localhost:8000/api/movies`
- Get movie details: GET `http://localhost:8000/api/movies/{id}`
- Create movie: POST `http://localhost:8000/api/movies`
- Update movie: PUT `http://localhost:8000/api/movies/{id}`
- Delete movie: DELETE `http://localhost:8000/api/movies/{id}`

## Frontend (React)

### Setup

1. Navigate to the frontend directory:
   ```
   cd frontend
   ```

2. Install dependencies:
   ```
   npm install
   ```

3. Start the frontend development server:
   ```
   npm start
   ```

The frontend will be available at `http://localhost:3000`.

## Features

- List movies with pagination.
- Search movies by title.
- View movie details.
- CRUD operations on movies via API.

## Notes

- The backend uses MySQL (or compatible) database.
- The frontend communicates with the backend API using axios.
- Authentication and advanced features are not implemented for simplicity.
