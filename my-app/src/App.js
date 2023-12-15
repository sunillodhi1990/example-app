import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Login from './login';
import Dashboard from './dashboard';
import Register from './register';



const App = () => {
  return (
    <Router>
      <Routes>

        <Route path="/" element={<Login />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/register" element={<Register />} />

      </Routes>
    </Router>
  );
};

export default App;
