import React, { useState, useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import { Box, Rating, Typography } from '@mui/material';
import { useAuth } from '../contexts/AuthContext';
import movieService from '../services/movieService';

const StarRating = ({ movieId, showAverage = true }) => {
  const navigate = useNavigate();
  const { user } = useAuth();
  const [userRating, setUserRating] = useState(0);
  const [averageRating, setAverageRating] = useState(0);
  const [totalRatings, setTotalRatings] = useState(0);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);
  const fetchRatings = useCallback(async () => {
    try {
      const response = await movieService.getMovieRating(movieId);
      const { userRating: userR, averageRating: avgR, totalRatings: total } = response.data;
      setUserRating(userR || 0);
      setAverageRating(avgR || 0);
      setTotalRatings(total || 0);
    } catch (err) {
      console.error('Error fetching ratings:', err);
      setError('Failed to load ratings');
    }
  }, [movieId]);
  useEffect(() => {
    fetchRatings();
  }, [fetchRatings]);

  const handleRatingChange = async (event, newValue) => {
    if (!user) {
      navigate('/login', { state: { from: `/movies/${movieId}` } });
      return;
    }

    setIsLoading(true);
    setError(null);

    try {
      if (newValue === null) {
        await movieService.deleteRating(movieId);
        setUserRating(0);
      } else {
        await movieService.rateMovie(movieId, newValue);
        setUserRating(newValue);
      }
      await fetchRatings();
    } catch (err) {
      setError('Failed to update rating');
      console.error('Rating error:', err);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <Box>
      <Box sx={{ display: 'flex', alignItems: 'center', mb: 1 }}>
        <Rating
          name={`movie-rating-${movieId}`}
          value={userRating}
          onChange={handleRatingChange}
          disabled={isLoading}
          precision={0.5}
        />
        {user && userRating > 0 && (
          <Typography variant="body2" color="text.secondary" sx={{ ml: 1 }}>
            Your rating
          </Typography>
        )}
      </Box>

      {showAverage && (
        <Typography variant="body2" color="text.secondary">
          {averageRating > 0 ? (
            <>
              Average: {averageRating.toFixed(1)} ({totalRatings} {totalRatings === 1 ? 'rating' : 'ratings'})
            </>
          ) : (
            'No ratings yet'
          )}
        </Typography>
      )}

      {error && (
        <Typography variant="body2" color="error" sx={{ mt: 1 }}>
          {error}
        </Typography>
      )}
    </Box>
  );
};

export default StarRating;
