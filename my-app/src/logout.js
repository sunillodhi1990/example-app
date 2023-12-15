import React from 'react';
import { useNavigate } from 'react-router-dom';

const Logout = () => {
  const navigate = useNavigate();

  const handleLogout = () => {
    // Clear user-related data (e.g., tokens, user info) from localStorage or any state management system
    localStorage.removeItem('accessToken'); // Clear access token from localStorage

    // Redirect the user to the login page
    navigate('/');
  };

  return (
    <div>
      <h2>Logout</h2>
      <button onClick={handleLogout}>Logout</button>
    </div>
  );
};

export default Logout;
