import { axiosInstance } from './authService';

const movieService = {
  getAllMovies: async (page = 1) => {
    return axiosInstance.get(`/movies?page=${page}`);
  },

  getMovieDetails: async (id) => {
    return axiosInstance.get(`/movies/${id}`);
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
  },

  // Reviews
  getMovieReviews: async (movieId, page = 1) => {
    return axiosInstance.get(`/movies/${movieId}/reviews?page=${page}`);
  },

  addReview: async (movieId, content) => {
    return axiosInstance.post(`/movies/${movieId}/reviews`, { content });
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
