# Movie Application

A full-stack movie application built with Laravel and React. Features movie browsing, ratings, reviews, and favorites functionality.

## Project Overview

- **Backend**: Laravel REST API with MySQL
- **Frontend**: React with Material-UI
- **Authentication**: Laravel Sanctum

## Features

- User authentication (register/login)
- Movie browsing with pagination
- Search functionality
- Movie ratings and reviews
- Favorite movies list
- Movie details with trailers

## Project Structure

```
├── backend/           # Laravel API
│   ├── app/          # Application core code
│   ├── database/     # Migrations and seeders
│   └── routes/       # API routes
└── frontend/         # React application
    ├── src/
    │   ├── components/
    │   ├── contexts/
    │   ├── pages/
    │   └── services/
```

## Getting Started

### Backend Setup

1. Install dependencies:
```powershell
cd backend
composer install
```

2. Set up environment:
```powershell
Copy-Item .env.example .env
php artisan key:generate
```

3. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movies_db
DB_USERNAME=root
DB_PASSWORD=
```

4. Run migrations:
```powershell
php artisan migrate --seed
```

5. Start the server:
```powershell
php artisan serve
```

### Frontend Setup

1. Install dependencies:
```powershell
cd frontend
npm install
```

2. Set up environment:
```powershell
Copy-Item .env.example .env
```

3. Start development server:
```powershell
npm start
```

## API Endpoints

### Public Routes
- `GET /api/movies` - List movies
- `GET /api/movies/{id}` - Get movie details
- `POST /api/register` - Register user
- `POST /api/login` - Login user

### Protected Routes
- `POST /api/movies/{id}/rate` - Rate movie
- `POST /api/movies/{id}/reviews` - Add review
- `POST /api/movies/{id}/favorite` - Toggle favorite
- `GET /api/favorites` - List favorites

## Technologies Used

### Backend
- Laravel 10
- MySQL
- Laravel Sanctum
- CORS enabled

### Frontend
- React 18
- Material-UI
- React Router
- Axios
- Context API

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
