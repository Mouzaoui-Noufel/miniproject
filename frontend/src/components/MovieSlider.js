import React, { useEffect, useState } from 'react';
import { fetchMovies } from '../services/api';

const MovieSlider = () => {
  const [movies, setMovies] = useState([]);
  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    const loadMovies = async () => {
      try {
        const response = await fetchMovies({ page: 1, per_page: 10 });
        setMovies(response.data.data);
      } catch (error) {
        console.error('Failed to fetch movies for slider:', error);
      }
    };
    loadMovies();
  }, []);

  const prevSlide = () => {
    setCurrentIndex((prevIndex) => (prevIndex === 0 ? movies.length - 1 : prevIndex - 1));
  };

  const nextSlide = () => {
    setCurrentIndex((prevIndex) => (prevIndex + 1) % movies.length);
  };

  if (movies.length === 0) {
    return null;
  }

  return (
    <div style={{
      position: 'relative',
      height: '350px',
      overflow: 'hidden',
      borderRadius: '15px',
      marginBottom: '30px',
      boxShadow: '0 6px 20px rgba(0,0,0,0.4)',
      color: '#fff',
      fontFamily: 'Verdana, Geneva, Tahoma, sans-serif',
      backgroundColor: '#111',
    }}>
      <button
        onClick={prevSlide}
        style={{
          position: 'absolute',
          top: '50%',
          left: '15px',
          transform: 'translateY(-50%)',
          backgroundColor: 'rgba(255,255,255,0.2)',
          border: 'none',
          borderRadius: '50%',
          width: '45px',
          height: '45px',
          color: '#fff',
          fontSize: '28px',
          cursor: 'pointer',
          userSelect: 'none',
          zIndex: 10,
          transition: 'background-color 0.3s ease',
        }}
        onMouseEnter={e => e.currentTarget.style.backgroundColor = 'rgba(255,255,255,0.5)'}
        onMouseLeave={e => e.currentTarget.style.backgroundColor = 'rgba(255,255,255,0.2)'}
        aria-label="Previous Slide"
      >
        ‹
      </button>
      <button
        onClick={nextSlide}
        style={{
          position: 'absolute',
          top: '50%',
          right: '15px',
          transform: 'translateY(-50%)',
          backgroundColor: 'rgba(255,255,255,0.2)',
          border: 'none',
          borderRadius: '50%',
          width: '45px',
          height: '45px',
          color: '#fff',
          fontSize: '28px',
          cursor: 'pointer',
          userSelect: 'none',
          zIndex: 10,
          transition: 'background-color 0.3s ease',
        }}
        onMouseEnter={e => e.currentTarget.style.backgroundColor = 'rgba(255,255,255,0.5)'}
        onMouseLeave={e => e.currentTarget.style.backgroundColor = 'rgba(255,255,255,0.2)'}
        aria-label="Next Slide"
      >
        ›
      </button>
      {movies.map((movie, index) => {
        const isActive = index === currentIndex;
        return (
          <div
            key={movie.id}
            style={{
              position: isActive ? 'relative' : 'absolute',
              top: 0,
              left: 0,
              width: '100%',
              height: '100%',
              opacity: isActive ? 1 : 0,
              transition: 'opacity 0.8s ease-in-out',
              backgroundImage: `linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2)), url(${movie.image_url})`,
              backgroundSize: 'cover',
              backgroundPosition: 'center',
              display: 'flex',
              flexDirection: 'column',
              justifyContent: 'flex-end',
              padding: '30px',
              boxSizing: 'border-box',
              borderRadius: '15px',
              color: '#f0f0f0',
              textShadow: '2px 2px 6px rgba(0,0,0,0.9)',
              fontWeight: 'bold',
              fontFamily: 'Georgia, serif',
            }}
          >
            <h2 style={{ margin: 0, fontSize: '3em' }}>{movie.titre}</h2>
            <p style={{ fontSize: '1.3em', maxWidth: '65%' }}>{movie.resume}</p>
          </div>
        );
      })}
    </div>
  );
};

export default MovieSlider;
