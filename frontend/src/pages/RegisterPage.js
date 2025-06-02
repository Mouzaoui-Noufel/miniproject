import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Container, Paper, Typography, Box, Link } from '@mui/material';
import RegisterForm from '../components/RegisterForm';

const RegisterPage = () => {
  const navigate = useNavigate();

  const handleRegisterSuccess = (user) => {
    // Store user data in local storage
    localStorage.setItem('user', JSON.stringify(user));
    navigate('/');
    window.location.reload();
  };

  return (
    <Container component="main" maxWidth="xs">
      <Box
        sx={{
          marginTop: 8,
          display: 'flex',
          flexDirection: 'column',	
          alignItems: 'center',
        }}
      >
        <Paper elevation={3} sx={{ p: 4, width: '100%' }}>
          <Typography component="h1" variant="h5" align="center" gutterBottom>
            Create Account
          </Typography>
          <RegisterForm onRegisterSuccess={handleRegisterSuccess} />
          <Box sx={{ mt: 2, textAlign: 'center' }}>
            <Link href="/login" variant="body2">
              Already have an account? Sign In
            </Link>
          </Box>
        </Paper>
      </Box>
    </Container>
  );
};

export default RegisterPage;
