# Movie Application Frontend

A modern React-based frontend for the Movie Application. This application provides a user-friendly interface for browsing movies, managing favorites, writing reviews, and rating films.

## Features

- **User Interface**
  - Responsive design using Material-UI components
  - Modern and intuitive navigation
  - Beautiful movie cards with images
  - Smooth transitions and loading states

- **User Authentication**
  - User registration and login
  - Protected routes for authenticated users
  - Token-based authentication with automatic renewal

- **Movie Features**
  - Browse movies with pagination
  - Search movies by title
  - View detailed movie information
  - Watch movie trailers
  - View director and actor information

- **User Interactions**
  - Rate movies with a 5-star system
  - Write, edit, and delete reviews
  - Add/remove movies to favorites
  - View personalized favorites list

## Technology Stack

- React 18
- Material-UI (MUI) for components
- React Router for navigation
- Axios for API communication
- Context API for state management

## Project Structure

```
src/
├── components/         # Reusable UI components
│   ├── MovieCard.js
│   ├── MovieList.js
│   ├── StarRating.js
│   ├── Reviews.js
│   └── ...
├── contexts/          # React Context providers
│   └── AuthContext.js
├── pages/            # Main route components
│   ├── LoginPage.js
│   ├── RegisterPage.js
│   └── MovieDetails.js
├── services/         # API and utility services
│   ├── authService.js
│   └── movieService.js
└── App.js           # Main application component
```

## Setup Instructions

1. Install dependencies:
```bash
npm install
```

2. Configure environment variables:
Create a `.env` file with:
```
REACT_APP_API_URL=http://localhost:8000/api
```

3. Start the development server:
```bash
npm start
```

The application will be available at `http://localhost:3000`.

## Available Scripts

- `npm start` - Run development server
- `npm build` - Build for production
- `npm test` - Run tests
- `npm run lint` - Check for linting issues

## Components

### MovieList
Displays a grid of movie cards with pagination and search functionality.

### MovieDetails
Shows detailed information about a specific movie, including:
- Movie information (title, synopsis, year, duration)
- Director and cast information
- Rating system
- Review section
- Favorite toggle

### StarRating
Reusable 5-star rating component with:
- Interactive rating interface
- Average rating display
- Total ratings count

### Reviews
Review management component with:
- Review creation form
- Edit/delete functionality
- Review list display

## State Management

The application uses React Context API for:
- User authentication state
- Movie data caching
- UI state management

## API Integration

The frontend communicates with the Laravel backend using:
- Axios for HTTP requests
- JWT token authentication
- Automatic token refresh
- Error handling and retries

## Error Handling

The application includes:
- User-friendly error messages
- Loading states
- Network error recovery
- Form validation

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License.
