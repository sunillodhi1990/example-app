import React, { useState } from 'react';
import swal from 'sweetalert';
import logo from './logo.svg';
import './App.css';

// ... Your imports and other functions

async function registerUser(credentials) {
    try {
      const csrfToken = getCsrfToken();
  
      const response = await fetch('http://127.0.0.1:8000/api/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(credentials),
      });
  
      if (!response.ok) {
        throw new Error('Registration failed');
      }
  
      const data = await response.json();
      return data;
    } catch (error) {
    //   console.error('Error during registration:', error.message);
      throw error;
    }
  }
  
  // ... Rest of your code remains the same
  

function getCsrfToken() {
  const metaTag = document.querySelector('meta[name="csrf-token"]');
  return metaTag ? metaTag.content : '';
}

export default function Register() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await registerUser({
        email,
        name,
        password,
      });

      console.log(response);

      if (response) {
        swal('Success', response.message || 'Registration Successful', 'success', {
          buttons: false,
          timer: 2000,
        }).then(() => {
          // Redirect to login after successful registration
          window.location.href = '/';
        });
      } else {
        swal('Failed', 'Registration Failed', 'error');
      }
    } catch (error) {
      swal('Failed', 'Registration Failed', 'error');
    //   console.error('Registration failed:', error.message);
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
              className="fadeIn second"
              placeholder="User Name"
              value={name}
              onChange={(e) => setName(e.target.value)}
            />
            <input
              type="email"
              className="fadeIn second"
              placeholder="User Email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
            <input
              type="password"
              className="fadeIn third"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
            <input type="submit" className="fadeIn fourth" value="Sign Up" />
          </form>
          <div id="formFooter">
            <a className="underlineHover" href="/login">
              Already have an account? Sign in
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
