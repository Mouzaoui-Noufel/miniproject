import React, { useState, useEffect, useCallback } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import {
  Container,
  Typography,
  Box,
  Grid,
  Card,
  CardMedia,
  CardContent,
  Button,
  Divider,
  CircularProgress,
  Alert
} from '@mui/material';
import { useAuth } from '../contexts/AuthContext';
import StarRating from './StarRating';
import { Reviews } from './Reviews';
import FavoriteButton from './FavoriteButton';
import movieService from '../services/movieService';

const MovieDetails = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const { user } = useAuth();
  const [movie, setMovie] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const fetchMovieDetails = useCallback(async () => {
    try {
      const response = await movieService.getMovieDetails(id);
      setMovie(response.data);
    } catch (err) {
      setError('Failed to load movie details');
      console.error('Error fetching movie details:', err);
    } finally {
      setLoading(false);
    }
  }, [id]);

  useEffect(() => {
    fetchMovieDetails();
  }, [fetchMovieDetails]);

  const handleRatingChange = async (newValue) => {
    if (!user) {
      navigate('/login', { state: { from: `/movies/${id}` } });
      return;
    }

    try {
      if (newValue === null) {
        await movieService.deleteRating(id);
      } else {
        await movieService.rateMovie(id, newValue);
      }
      fetchMovieDetails(); // Refresh movie data
    } catch (err) {
      console.error('Error updating rating:', err);
    }
  };
  const formatRating = (rating) => {
    const numRating = Number(rating);
    return !isNaN(numRating) ? numRating.toFixed(1) : '0.0';
  };

  if (loading) {
    return (
      <Box display="flex" justifyContent="center" alignItems="center" minHeight="60vh">
        <CircularProgress />
      </Box>
    );
  }

  if (error) {
    return <Alert severity="error">{error}</Alert>;
  }

  if (!movie) {
    return <Alert severity="info">Movie not found</Alert>;
  }

  return (
    <Container>
      <Grid container spacing={4}>
        <Grid item xs={12} md={4}>
          <Card>
            <CardMedia
              component="img"
              image={movie.image_url || '/placeholder-movie.jpg'}
              alt={movie.titre}
              sx={{ width: '100%', height: 'auto' }}
            />
            <CardContent>
              {user && (
                <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', mb: 2 }}>
                  <StarRating
                    movieId={movie.id}
                    initialRating={movie.userRating?.rating || 0}
                    onRatingChange={handleRatingChange}
                  />
                  <FavoriteButton
                    movieId={movie.id}
                    isFavorited={movie.isFavorited}
                  />
                </Box>
              )}
              <Typography variant="body2" color="text.secondary">
                Average Rating: {formatRating(movie.ratings_avg_rating)} ({movie.ratings_count || 0} ratings)
              </Typography>
            </CardContent>
          </Card>
        </Grid>

        <Grid item xs={12} md={8}>
          <Typography variant="h4" component="h1" gutterBottom>
            {movie.titre}
          </Typography>
          <Typography variant="subtitle1" gutterBottom>
            Directed by: {movie.realisateur.prenom} {movie.realisateur.nom}
          </Typography>
          <Typography variant="body1" paragraph>
            {movie.resume}
          </Typography>

          <Box sx={{ my: 3 }}>
            <Typography variant="h6" gutterBottom>
              Movie Details
            </Typography>
            <Typography>Year: {movie.annee_sortie}</Typography>
            <Typography>Duration: {movie.duree} minutes</Typography>
            <Typography>Genres: {movie.genres}</Typography>
          </Box>

          {movie.trailer_url && (
            <Box sx={{ my: 3 }}>
              <Typography variant="h6" gutterBottom>
                Trailer
              </Typography>
              <iframe
                width="100%"
                height="315"
                src={movie.trailer_url}
                title="Movie Trailer"
                frameBorder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
              />
            </Box>
          )}

          <Divider sx={{ my: 3 }} />          <Box sx={{ my: 3 }}>
            <Typography variant="h6" gutterBottom>
              Reviews ({movie.reviews_count || 0})
            </Typography>
            {user ? (
              <Reviews movieId={movie.id} />
            ) : (
              <Box sx={{ mb: 2 }}>
                <Button
                  variant="outlined"
                  onClick={() => navigate('/login', { state: { from: `/movies/${movie.id}` } })}
                >
                  Login to Write a Review
                </Button>
              </Box>
            )}
          </Box>
        </Grid>
      </Grid>
    </Container>
  );
};

export default MovieDetails;
