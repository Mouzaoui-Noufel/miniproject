import React, { useState, useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box,
  TextField,
  Button,
  Typography,
  CircularProgress,
  Alert,
  Card,
  CardContent,
  IconButton,
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions
} from '@mui/material';
import { Edit as EditIcon, Delete as DeleteIcon } from '@mui/icons-material';
import { useAuth } from '../contexts/AuthContext';
import movieService from '../services/movieService';

const ReviewForm = ({ movieId, initialContent = '', onReviewSubmitted, isEditing = false, onCancel }) => {
  const [content, setContent] = useState(initialContent);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);
  console.log('ReviewForm rendered:', { movieId, initialContent, isEditing });
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!content.trim()) {
      setError('Review content cannot be empty');
      return;
    }
    setIsLoading(true);
    setError(null);

    try {
      console.log('Submitting review:', { movieId, content, isEditing });
      if (isEditing) {
        await movieService.updateReview(movieId, content);
      } else {
        await movieService.addReview(movieId, content);
      }
      setContent('');
      if (onReviewSubmitted) {
        onReviewSubmitted();
      }
    } catch (err) {
      console.error('Review submission error:', err);
      setError(err.response?.data?.message || 'Failed to submit review');
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <Box component="form" onSubmit={handleSubmit} sx={{ mt: 2 }}>
      {error && <Alert severity="error" sx={{ mb: 2 }}>{error}</Alert>}
      <TextField
        fullWidth
        multiline
        rows={4}
        label="Write your review"
        value={content}
        onChange={(e) => setContent(e.target.value)}
        disabled={isLoading}
        error={!!error}
        helperText={error}
        sx={{ mb: 2 }}
      />
      <Box sx={{ display: 'flex', gap: 2 }}>
        <Button
          type="submit"
          variant="contained"
          color="primary"
          disabled={isLoading || !content.trim()}
        >
          {isLoading ? 'Submitting...' : isEditing ? 'Update Review' : 'Submit Review'}
        </Button>
        {isEditing && (
          <Button variant="outlined" onClick={onCancel} disabled={isLoading}>
            Cancel
          </Button>
        )}
      </Box>
    </Box>
  );
};

const ReviewItem = ({ review, currentUserId, movieId, onReviewUpdated }) => {
  const [isEditing, setIsEditing] = useState(false);
  const [showDeleteDialog, setShowDeleteDialog] = useState(false);
  const [isDeleting, setIsDeleting] = useState(false);
  const [deleteError, setDeleteError] = useState(null);

  const handleDelete = async () => {
    setIsDeleting(true);
    setDeleteError(null);
    try {
      await movieService.deleteReview(movieId, review.id);
      setShowDeleteDialog(false);
      onReviewUpdated();
    } catch (err) {
      console.error('Error deleting review:', err);
      setDeleteError(err.response?.data?.message || 'Failed to delete review');
    } finally {
      setIsDeleting(false);
    }
  };

  return (
    <>
      <Card sx={{ mb: 2 }}>
        <CardContent>
          <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start' }}>            <div>
              <Typography variant="subtitle2">{review.user?.name || 'Anonymous User'}</Typography>
              <Typography variant="caption" color="text.secondary">
                {new Date(review.created_at).toLocaleDateString()}
              </Typography>
            </div>
            {currentUserId === review.user_id && (
              <Box>
                <IconButton size="small" onClick={() => setIsEditing(true)}>
                  <EditIcon />
                </IconButton>
                <IconButton size="small" onClick={() => setShowDeleteDialog(true)}>
                  <DeleteIcon />
                </IconButton>
              </Box>
            )}
          </Box>

          {isEditing ? (
            <ReviewForm
              movieId={movieId}
              initialContent={review.content}
              onReviewSubmitted={() => {
                setIsEditing(false);
                onReviewUpdated();
              }}
              isEditing={true}
              onCancel={() => setIsEditing(false)}
            />
          ) : (
            <Typography variant="body1" sx={{ mt: 1 }}>
              {review.content}
            </Typography>
          )}
        </CardContent>
      </Card>

      <Dialog open={showDeleteDialog} onClose={() => setShowDeleteDialog(false)}>
        <DialogTitle>Delete Review</DialogTitle>        <DialogContent>
          <Typography>Are you sure you want to delete this review?</Typography>
          {deleteError && (
            <Alert severity="error" sx={{ mt: 2 }}>
              {deleteError}
            </Alert>
          )}
        </DialogContent>
        <DialogActions>
          <Button onClick={() => {
            setShowDeleteDialog(false);
            setDeleteError(null);
          }} disabled={isDeleting}>
            Cancel
          </Button>
          <Button onClick={handleDelete} color="error" disabled={isDeleting}>
            {isDeleting ? 'Deleting...' : 'Delete'}
          </Button>
        </DialogActions>
      </Dialog>
    </>
  );
};

const Reviews = ({ movieId }) => {
  const { user } = useAuth();
  const navigate = useNavigate();
  const [reviews, setReviews] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);
  const [reviewContent, setReviewContent] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);  const handleSubmitReview = async (e) => {
    e.preventDefault();
    if (!reviewContent.trim()) {
      setError('Review content cannot be empty');
      return;
    }
    
    setIsSubmitting(true);
    try {      await movieService.addReview(movieId, reviewContent);
      setReviewContent('');
      await fetchReviews();
    } catch (err) {
      console.error('Error submitting review:', err);
      setError(err.response?.data?.message || 'Failed to submit review');
    } finally {
      setIsSubmitting(false);
    }
  };

  const fetchReviews = useCallback(async () => {
    if (!movieId) return;
    setIsLoading(true);
    try {
      console.log('Fetching reviews for movie:', movieId);      const response = await movieService.getMovieReviews(movieId);
      console.log('Reviews API response:', response);
      
      // Handle the response data structure
      const reviewsData = response.data.data || response.data || [];
      console.log('Processed reviews data:', reviewsData);
      setReviews(reviewsData);
    } catch (err) {
      console.error('Reviews loading error:', err);
      setError('Failed to load reviews. Please try again later.');
    } finally {
      setIsLoading(false);    }
  }, [movieId]);
  useEffect(() => {
    fetchReviews();
  }, [fetchReviews]);

  if (isLoading) {
    return (
      <Box display="flex" justifyContent="center">
        <CircularProgress />
      </Box>
    );
  }

  if (error) {
    return <Alert severity="error">{error}</Alert>;
  }  return (
    <Box>
      {error && (
        <Alert severity="error" sx={{ mb: 2 }}>
          {error}
        </Alert>
      )}

      {user ? (
        <Box component="form" onSubmit={handleSubmitReview} sx={{ mb: 4 }}>
          <Typography variant="h6" gutterBottom>
            Write a Review
          </Typography>
          <TextField
            fullWidth
            multiline
            rows={4}
            label="Write your review"
            placeholder="Share your thoughts about this movie..."
            value={reviewContent}
            onChange={(e) => setReviewContent(e.target.value)}
            disabled={isSubmitting}
            sx={{ mb: 2 }}
          />
          <Button
            type="submit"
            variant="contained"
            color="primary"
            disabled={isSubmitting || !reviewContent.trim()}
          >
            {isSubmitting ? 'Submitting...' : 'Submit Review'}
          </Button>
        </Box>
      ) : (
        <Box sx={{ mb: 4 }}>
          <Button
            variant="outlined"
            onClick={() => navigate('/login', { state: { from: `/movies/${movieId}` } })}
          >
            Login to Write a Review
          </Button>
        </Box>
      )}

      <Box sx={{ mt: 4 }}>
        <Typography variant="h6" gutterBottom>
          Reviews
        </Typography>
        {reviews.length > 0 ? (
          reviews.map((review) => (
            <ReviewItem
              key={review.id}
              review={review}
              currentUserId={user?.id}
              movieId={movieId}
              onReviewUpdated={fetchReviews}
            />
          ))
        ) : (
          <Typography color="text.secondary">
            No reviews yet. Be the first to review!
          </Typography>
        )}
      </Box>
    </Box>
  );
   
};

export { ReviewForm, Reviews };
