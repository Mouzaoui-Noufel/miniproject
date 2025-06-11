import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { Box, Button, TextField, Typography } from '@mui/material';
import movieService from '../services/movieService';

const EditFilmPage = () => {
  const navigate = useNavigate();
  const { id } = useParams();

  const [formData, setFormData] = useState({
    titre: '',
    resume: '',
    annee_sortie: '',
    duree: '',
    genres: '',
    realisateur_id: '',
    image_url: '',
    trailer_url: '',
    acteurs: [],
  });

  const [errors, setErrors] = useState({});

  useEffect(() => {
    const fetchFilm = async () => {
      try {
        const { data } = await movieService.getMovieDetails(id);
        setFormData({
          titre: data.titre || '',
          resume: data.resume || '',
          annee_sortie: data.annee_sortie || '',
          duree: data.duree || '',
          genres: data.genres || '',
          realisateur_id: data.realisateur_id || '',
          image_url: data.image_url || '',
          trailer_url: data.trailer_url || '',
          acteurs: data.acteurs || [],
        });
      } catch (error) {
        console.error('Error fetching film:', error);
        alert('Error fetching film data');
      }
    };
    fetchFilm();
  }, [id]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value,
    }));
  };

  const validate = () => {
    const newErrors = {};
    if (!formData.titre) {
      newErrors.titre = 'Title is required';
    }
    if (formData.annee_sortie && !/^\d{4}$/.test(formData.annee_sortie)) {
      newErrors.annee_sortie = 'Year of Release must be exactly 4 digits';
    }
    if (formData.realisateur_id === '' || formData.realisateur_id === null) {
      newErrors.realisateur_id = 'Director ID is required';
    }
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) {
      return;
    }
    try {
      await movieService.updateMovie(id, formData);
      alert('Film updated successfully');
      navigate(`/movies/${id}`);
    } catch (error) {
      console.error('Error updating film:', error);
      alert('Error updating film');
    }
  };

  return (
    <Box sx={{ maxWidth: 600, mx: 'auto' }}>
      <Typography variant="h4" component="h1" gutterBottom>
        Edit Film
      </Typography>
      <form onSubmit={handleSubmit} noValidate>
        <TextField
          label="Title"
          name="titre"
          value={formData.titre}
          onChange={handleChange}
          error={!!errors.titre}
          helperText={errors.titre}
          fullWidth
          required
          margin="normal"
        />
        <TextField
          label="Resume"
          name="resume"
          value={formData.resume}
          onChange={handleChange}
          multiline
          rows={4}
          fullWidth
          margin="normal"
        />
        <TextField
          label="Year of Release"
          name="annee_sortie"
          value={formData.annee_sortie}
          onChange={handleChange}
          error={!!errors.annee_sortie}
          helperText={errors.annee_sortie}
          fullWidth
          margin="normal"
          inputProps={{ maxLength: 4 }}
        />
        <TextField
          label="Duration (minutes)"
          name="duree"
          value={formData.duree}
          onChange={handleChange}
          type="number"
          fullWidth
          margin="normal"
        />
        <TextField
          label="Genres"
          name="genres"
          value={formData.genres}
          onChange={handleChange}
          fullWidth
          margin="normal"
        />
        <TextField
          label="Director ID"
          name="realisateur_id"
          value={formData.realisateur_id}
          onChange={handleChange}
          error={!!errors.realisateur_id}
          helperText={errors.realisateur_id}
          type="number"
          fullWidth
          required
          margin="normal"
        />
        <TextField
          label="Image URL"
          name="image_url"
          value={formData.image_url}
          onChange={handleChange}
          fullWidth
          margin="normal"
        />
        <TextField
          label="Trailer URL"
          name="trailer_url"
          value={formData.trailer_url}
          onChange={handleChange}
          fullWidth
          margin="normal"
        />
        {/* Additional fields for acteurs can be added here */}
        <Button type="submit" variant="contained" color="primary" sx={{ mt: 2 }}>
          Update Film
        </Button>
      </form>
    </Box>
  );
};

export default EditFilmPage;
