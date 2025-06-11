import { axiosInstance } from './authService';

const movieService = {
  getAllMovies: async (page = 1) => {
    return axiosInstance.get(`/movies?page=${page}`);
  },

  getMovieDetails: async (id) => {
    return axiosInstance.get(`/movies/${id}`);
  },

  createMovie: async (movieData) => {
    return axiosInstance.post('/movies', movieData);
  },

  updateMovie: async (id, movieData) => {
    return axiosInstance.put(`/movies/${id}`, movieData);
  },

  deleteMovie: async (id) => {
    return axiosInstance.delete(`/movies/${id}`);
  },

  // Ratings
  rateMovie: async (movieId, rating) => {
    return axiosInstance.post(`/movies/${movieId}/rate`, { rating });
  },

  deleteRating: async (movieId) => {
    return axiosInstance.delete(`/movies/${movieId}/rate`);
  },

  getMovieRating: async (movieId) => {
    return axiosInstance.get(`/movies/${movieId}/rating`);
  },  // Reviews
  getMovieReviews: async (movieId) => {
    try {
      const response = await axiosInstance.get(`/movies/${movieId}/reviews`);
      console.log('Reviews API response:', response.data);
      return response;
    } catch (error) {
      console.error('Error fetching reviews:', error);
      throw error;
    }
  },

  addReview: async (movieId, content) => {
    try {
      console.log('Adding review for movie:', movieId, 'content:', content);
      const response = await axiosInstance.post(`/movies/${movieId}/reviews`, { content });
      console.log('Add review response:', response);
      return response;
    } catch (error) {
      console.error('Error adding review:', error.response || error);
      throw error;
    }
  },

  updateReview: async (movieId, reviewId, content) => {
    return axiosInstance.put(`/movies/${movieId}/reviews/${reviewId}`, { content });
  },

  deleteReview: async (movieId, reviewId) => {
    return axiosInstance.delete(`/movies/${movieId}/reviews/${reviewId}`);
  },

  getUserReview: async (movieId) => {
    return axiosInstance.get(`/movies/${movieId}/user-review`);
  },

  // Favorites
  getFavorites: async (page = 1) => {
    return axiosInstance.get(`/favorites?page=${page}`);
  },

  addToFavorites: async (movieId) => {
    return axiosInstance.post(`/movies/${movieId}/favorite`);
  },

  removeFromFavorites: async (movieId) => {
    return axiosInstance.delete(`/movies/${movieId}/favorite`);
  },

  checkFavorite: async (movieId) => {
    return axiosInstance.get(`/movies/${movieId}/favorite/check`);
  }
};

export default movieService;
