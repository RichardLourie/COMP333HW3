// components/Login.js
import React, { Component } from 'react';

class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: '',
    };
  }

  handleLogin = () => {
    this.state.loggedIn = true;
    // Implement your login logic here
    // Send a request to your backend for authentication
    const { username, password } = this.state;

    // Example: You can use the Fetch API for sending login requests
    fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ username, password }),
    })
      .then((response) => response.json())
      .then((data) => {
        // Check if login was successful
        if (data.success) {
          // Perform actions after successful login
          // For example, you can store the user's session or token
        } else {
          // Handle login failure, show an error message, etc.
        }
      })
      .catch((error) => {
        console.error('Error during login:', error);
      });
  };

  render() {
    return (
      <div>
        <h2>Login</h2>
        <input
          type="text"
          placeholder="Username"
          value={this.state.username}
          onChange={(e) => this.setState({ username: e.target.value })}
        />
        <input
          type="password"
          placeholder="Password"
          value={this.state.password}
          onChange={(e) => this.setState({ password: e.target.value })}
        />
        <button onClick={this.handleLogin}>Login</button>
      </div>
    );
  }
}

export default Login;
