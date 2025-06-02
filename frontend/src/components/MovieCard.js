import React from 'react';
import { Link } from 'react-router-dom';

const MovieCard = ({ movie }) => {
  return (
    <div style={{ 
      border: '1px solid #ccc', 
      padding: '15px', 
      marginBottom: '20px',
      borderRadius: '8px',
      boxShadow: '0 2px 4px rgba(0,0,0,0.1)',
      display: 'flex',
      gap: '20px'
    }}>
      <div style={{ flexShrink: 0 }}>
        {movie.image_url ? (
          <img 
            src={movie.image_url} 
            alt={movie.titre}
            style={{
              width: '150px',
              height: '225px',
              objectFit: 'cover',
              borderRadius: '4px'
            }}
          />
        ) : (
          <div style={{
            width: '150px',
            height: '225px',
            backgroundColor: '#eee',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            borderRadius: '4px'
          }}>
            No Image
          </div>
        )}
      </div>
      <div>
        <h3 style={{ marginTop: 0 }}>
          <Link 
            to={`/movies/${movie.id}`}
            style={{ 
              color: '#2c3e50',
              textDecoration: 'none',
              fontSize: '1.4em'
            }}
          >
            {movie.titre}
          </Link>
        </h3>
        <p style={{ color: '#666', marginBottom: '10px' }}>{movie.resume}</p>
        <p><strong>Année:</strong> {movie.annee_sortie}</p>
        <p><strong>Durée:</strong> {movie.duree} minutes</p>
        <p><strong>Genres:</strong> {movie.genres}</p>
        <p><strong>Réalisateur:</strong> {movie.realisateur?.prenom} {movie.realisateur?.nom}</p>
      </div>
    </div>
  );
};

export default MovieCard;
