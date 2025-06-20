import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import movieService from '../services/movieService';

const MovieCard = ({ movie }) => {
  const [hovered, setHovered] = useState(false);
  const navigate = useNavigate();
  const { user } = useAuth();

  const handleDelete = async () => {
    if (!window.confirm('Are you sure you want to delete this film?')) {
      return;
    }
    try {
      await movieService.deleteMovie(movie.id);
      alert('Film deleted successfully');
      // Optionally, refresh the page or update the parent component state
      window.location.reload();
    } catch (error) {
      console.error('Error deleting film:', error);
      alert('Error deleting film');
    }
  };

  return (
    <div 
      style={{ 
        position: 'relative',
        width: '220px',
        height: '330px',
        borderRadius: '10px',
        overflow: 'hidden',
        cursor: 'pointer',
        transition: 'transform 0.3s ease, box-shadow 0.3s ease',
        transform: hovered ? 'scale(1.05)' : 'scale(1)',
        boxShadow: hovered ? '0 8px 16px rgba(0,0,0,0.3)' : '0 2px 8px rgba(0,0,0,0.15)',
        color: '#fff',
        backgroundColor: '#000',
        margin: '10px',
      }}
      onMouseEnter={() => setHovered(true)}
      onMouseLeave={() => setHovered(false)}
    >
      <img 
        src={movie.image_url} 
        alt={movie.titre}
        style={{
          width: '100%',
          height: '100%',
          objectFit: 'cover',
          filter: hovered ? 'brightness(40%)' : 'brightness(100%)',
          transition: 'filter 0.3s ease',
        }}
      />
      {hovered && (
        <div style={{
          position: 'absolute',
          top: 0,
          left: 0,
          width: '100%',
          height: '100%',
          padding: '15px',
          boxSizing: 'border-box',
          backgroundColor: 'rgba(0, 0, 0, 0.7)',
          display: 'flex',
          flexDirection: 'column',
          justifyContent: 'center',
          opacity: hovered ? 1 : 0,
          transition: 'opacity 0.3s ease',
          color: '#fff',
          overflowY: 'visible',
        }}>
          <h3 style={{ marginTop: 0, fontSize: '1.2em', marginBottom: '8px' }}>
            <Link 
              to={`/movies/${movie.id}`}
              style={{ 
                color: '#1abc9c',
                textDecoration: 'none',
              }}
            >
              {movie.titre}
            </Link>
          </h3>
          <p style={{ fontSize: '0.9em', marginBottom: '8px', lineHeight: '1.3' }}>{movie.resume}</p>
          <p style={{ marginBottom: '6px' }}><strong>Année:</strong> {movie.annee_sortie}</p>
          <p style={{ marginBottom: '6px' }}><strong>Durée:</strong> {movie.duree} minutes</p>
          <p style={{ marginBottom: '6px' }}><strong>Genres:</strong> {movie.genres}</p>
          <p style={{ marginBottom: '0' }}><strong>Réalisateur:</strong> {movie.realisateur?.prenom} {movie.realisateur?.nom}</p>
          {user && movie.user_id === user.id && (
            <div style={{ marginTop: '10px', display: 'flex', gap: '10px' }}>
              <button
                onClick={(e) => {
                  e.stopPropagation();
                  navigate(`/movies/${movie.id}/edit`);
                }}
                style={{
                  padding: '6px 12px',
                  backgroundColor: '#1abc9c',
                  border: 'none',
                  borderRadius: '4px',
                  color: '#fff',
                  cursor: 'pointer',
                }}
              >
                Modify
              </button>
              <button
                onClick={(e) => {
                  e.stopPropagation();
                  handleDelete();
                }}
                style={{
                  padding: '6px 12px',
                  backgroundColor: '#e74c3c',
                  border: 'none',
                  borderRadius: '4px',
                  color: '#fff',
                  cursor: 'pointer',
                }}
              >
                Delete
              </button>
            </div>
          )}
        </div>
      )}
    </div>
  );
};

export default MovieCard;
