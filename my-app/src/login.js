import React, { useState, useEffect } from 'react';
import swal from 'sweetalert';
import logo from './logo.svg';
import './App.css';

async function loginUser(credentials) {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(), // Add this line to include CSRF token
      },
      body: JSON.stringify(credentials),
    });

    if (!response.ok) {
      throw new Error('Login failed');
    }

    const data = await response.json();
    return data;

  } catch (error) {
    console.error('Error during login:', error.message);
    throw error;
  }
}

// Function to get the CSRF token from the meta tag
function getCsrfToken() {
  const metaTag = document.querySelector('meta[name="csrf-token"]');
  return metaTag ? metaTag.content : '';
}



export default function Login() {

  const token = localStorage.getItem('accessToken');

  if (token) {   
      window.location.href = '/dashboard';
  }
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await loginUser({
        email,
        password,
      });

      if (response) {
        swal('Success', response.message || 'Login Successful', 'success', {
          buttons: false,
          timer: 2000,
        }).then(() => {
          localStorage.setItem('accessToken', response.data.token);
          localStorage.setItem('user', JSON.stringify(response.data));
          window.location.href = '/dashboard';
        });
      } else {
        swal('Failed', response?.message || 'Login Failed', 'error');
      }

    } catch (error) {
      swal('Failed', 'Login Failed', 'error');
      console.error('Login failed:', error.message);
    }
  };

  return (
    <div className="App">
      <div className="wrapper fadeInDown">
        <div id="formContent">
          <div className="fadeIn first">
            <img src={logo} id="icon" alt="User Icon" />
          </div>
          <form onSubmit={handleSubmit}>
            <input
              type="text"
              id="login"
              className="fadeIn second"
              name="login"
              placeholder="Username"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
            <input
              type="password"
              id="password"
              className="fadeIn third"
              name="login"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
            <input type="submit" className="fadeIn fourth" value="Log In" />
          </form>
          <div id="formFooter">
            <a className="underlineHover" href="#">
              Forgot Password?
            </a>
            <a className="underlineHover" href="/register">
              User Signup?
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
