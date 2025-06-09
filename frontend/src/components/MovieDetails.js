import React, { useState, useEffect, useCallback } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import {
  Typography,
  Box,
  Button,
  Divider,
  CircularProgress,
  Alert,
  Chip,
  Stack
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
      fetchMovieDetails();
    } catch (err) {
      console.error('Error updating rating:', err);
    }
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
    <Box sx={{ py: 4 }}>
      <Typography variant="h3" component="h1" gutterBottom>
        {movie.titre}
      </Typography>
      
      <Stack direction="row" spacing={1} sx={{ mb: 2 }}>
        <Chip label={movie.annee_sortie} size="small" />
        <Chip label={`${movie.duree} min`} size="small" />
        {movie.genres.split(',').map(genre => (
          <Chip key={genre} label={genre.trim()} size="small" />
        ))}
      </Stack>

      <Typography variant="subtitle1" gutterBottom>
        Directed by: {movie.realisateur.prenom} {movie.realisateur.nom}
      </Typography>

      <Typography variant="body1" paragraph sx={{ my: 3 }}>
        {movie.resume}
      </Typography>

      {movie.trailer_url && (
        <Box sx={{ my: 4 }}>
          <Typography variant="h6" gutterBottom>Trailer</Typography>
          <Box sx={{ 
            position: 'relative', 
            paddingTop: '56.25%', 
            overflow: 'hidden'
          }}>
            <iframe
              src={movie.trailer_url}
              title="Movie Trailer"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowFullScreen
              style={{
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                border: 'none'
              }}
            />
          </Box>
        </Box>
      )}

      {/* Rating and Favorite moved here below trailer */}
      <Box sx={{ display: 'flex', alignItems: 'center', gap: 2, my: 2 }}>
        <StarRating
          movieId={movie.id}
          initialRating={movie.userRating?.rating || 0}
          onRatingChange={handleRatingChange}
        />
        <Typography variant="body2">
          {movie.ratings_avg_rating?.toFixed(1) || '0.0'} ({movie.ratings_count || 0} ratings)
        </Typography>
        {user && <FavoriteButton movieId={movie.id} isFavorited={movie.isFavorited} />}
      </Box>

      <Divider sx={{ my: 4 }} />

      <Box>
        <Typography variant="h5" gutterBottom>Reviews</Typography>
        {user ? (
          <Reviews movieId={movie.id} />
        ) : (
          <Button
            variant="contained"
            onClick={() => navigate('/login', { state: { from: `/movies/${movie.id}` } })}
          >
            Login to Write a Review
          </Button>
        )}
      </Box>
    </Box>
  );
};

export default MovieDetails;