import React, { useState, useEffect, useCallback } from 'react';
import MovieCard from './MovieCard';
import { fetchMovies } from '../services/api';
import movieService from '../services/movieService';

const MovieList = ({ favorites = false }) => {
  const [movies, setMovies] = useState([]);
  const [searchTitle, setSearchTitle] = useState('');
  const [page, setPage] = useState(1);
  const [lastPage, setLastPage] = useState(1);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const loadMovies = useCallback(async (pageNumber = 1, title = '') => {
    setLoading(true);
    try {
      let response;
      if (favorites) {
        const params = { page: pageNumber, per_page: 20 };
        response = await movieService.getFavorites(params);
        const favoritedMovies = response.data.data.map(fav => ({
          ...fav.film,
          isFavorited: true
        }));
        setMovies(favoritedMovies);
        setPage(response.data.current_page);
        setLastPage(response.data.last_page);
      } else {
        const params = { page: pageNumber, per_page: 20 };
        if (title) {
          params.titre = title;
        }
        response = await fetchMovies(params);
        setMovies(response.data.data);
        setPage(response.data.current_page);
        setLastPage(response.data.last_page);
      }
    } catch (error) {
      console.error('Failed to fetch movies:', error);
      setError('Failed to load movies');
    } finally {
      setLoading(false);
    }
  }, [favorites]);
  useEffect(() => {
    loadMovies(page, searchTitle);
  }, [loadMovies, page, searchTitle]);

  const handleSearchChange = (e) => {
    setSearchTitle(e.target.value);
  };

  const handleSearchSubmit = (e) => {
    e.preventDefault();
    loadMovies(1, searchTitle);
  };

  const handlePageChange = (newPage) => {
    if (newPage >= 1 && newPage <= lastPage) {
      loadMovies(newPage, searchTitle);
    }
  };
  return (
    <div>
      {!favorites && (
        <form onSubmit={handleSearchSubmit} style={{ marginBottom: '20px' }}>
          <input
            type="text"
            placeholder="Rechercher par titre"
            value={searchTitle}
            onChange={handleSearchChange}
            style={{ padding: '5px', width: '300px' }}
          />
          <button type="submit" style={{ padding: '5px 10px', marginLeft: '10px' }}>
            Rechercher
          </button>
        </form>
      )}

      {loading ? (
        <p>Chargement...</p>
      ) : error ? (
        <p>Error: {error}</p>
      ) : movies.length === 0 ? (
        <p>{favorites ? "You haven't favorited any movies yet." : "No movies found."}</p>
      ) : (
        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(auto-fill, minmax(200px, 1fr))',
          gap: '20px'
        }}>
          {movies.map((movie) => <MovieCard key={movie.id} movie={movie} />)}
        </div>
      )}

      {movies.length > 0 && (
        <div style={{ marginTop: '20px', display: 'flex', justifyContent: 'center', alignItems: 'center', gap: '15px' }}>
          <button onClick={() => handlePageChange(page - 1)} disabled={page === 1} style={{ padding: '8px 16px', borderRadius: '5px', border: 'none', backgroundColor: '#007bff', color: '#fff', cursor: page === 1 ? 'not-allowed' : 'pointer' }}>
            Précédent
          </button>
          <span style={{ margin: '0 10px', fontWeight: 'bold' }}>
            Page {page} sur {lastPage}
          </span>
          <button onClick={() => handlePageChange(page + 1)} disabled={page === lastPage} style={{ padding: '8px 16px', borderRadius: '5px', border: 'none', backgroundColor: '#007bff', color: '#fff', cursor: page === lastPage ? 'not-allowed' : 'pointer' }}>
            Suivant
          </button>
        </div>
      )}
    </div>
  );
};

export default MovieList;
