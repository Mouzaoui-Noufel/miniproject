import React, { useState, useEffect } from 'react';
import { IconButton, Tooltip } from '@mui/material';
import { Favorite, FavoriteBorder } from '@mui/icons-material';
import movieService from '../services/movieService';

const FavoriteButton = ({ movieId }) => {
  const [isFavorited, setIsFavorited] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    const checkFavoriteStatus = async () => {
      try {
        const response = await movieService.checkFavorite(movieId);
        setIsFavorited(response.data.favorited);
      } catch (err) {
        console.error('Error checking favorite status:', err);
      }
    };

    checkFavoriteStatus();
  }, [movieId]);

  const handleToggleFavorite = async () => {
    setIsLoading(true);
    setError(null);
    try {
      if (isFavorited) {
        await movieService.removeFromFavorites(movieId);
      } else {
        await movieService.addToFavorites(movieId);
      }
      setIsFavorited(!isFavorited);
    } catch (err) {
      setError('Failed to update favorite status');
      console.error('Favorite toggle error:', err);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <Tooltip title={isFavorited ? 'Remove from favorites' : 'Add to favorites'}>
      <IconButton
        onClick={handleToggleFavorite}
        disabled={isLoading}
        color={error ? 'error' : 'primary'}
      >
        {isFavorited ? <Favorite /> : <FavoriteBorder />}
      </IconButton>
    </Tooltip>
  );
};

export default FavoriteButton;
