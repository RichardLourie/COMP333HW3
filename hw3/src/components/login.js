import React, { Component } from 'react';
import axios from 'axios';

class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: '',
      signingUp: false,
    };
  }

//   handleLogin = () => {
//     const { username, password } = this.state;
//     console.log('Username:', username);
//     console.log('Password:', password);
  
//     // Replace with your API endpoint for authentication
//     axios
//     //   .post(`http://localhost/index.php/user/verify?username=${username}&password=${password}`)
//       .post(`http://localhost/index.php/user/verify?username=RichieOneThousand&password=passwordpassword`)
//       .then((response) => {
//         console.log('Response Data:', response.data);
//         const data = response.data;
//         if (data && data.response === true) {
//           // Login was successful, call the parent component's function to update the state
//           this.props.onLoginSuccess();
//         } else {
//           // Handle login failure, show an error message, etc.
//         }
//       })
//       .catch((error) => {
//         console.error('Error during login:', error);
//       });
//   };
  
  handleLogin = () => {
    const { username, password } = this.state;
    console.log('Username:', username);
    console.log('Password:', password);
  
    // Replace with your API endpoint for authentication
    axios
  .post(`http://localhost/index.php/user/verify?username=${username}&password=${password}`)
  .then((response) => {
    console.log('Response Data:', response.data);
    const data = JSON.parse(response.data); // Parse the JSON string into an object
    console.log('data: ', data);
    console.log('success: ', data.success);
    if (data && data.success === true) {
      // Login was successful, call the parent component's function to update the state
      console.log("logged in successfully");
      this.props.onLoginSuccess();
    } else {
      // Handle login failure, show an error message, etc.
    }
  })
  .catch((error) => {
    console.error('Error during login:', error);
  });
  };

  handleSignup = () => {
    const { username, password } = this.state;
    console.log('Username:', username);
    console.log('Password:', password);
  
    // Replace with your API endpoint for authentication
    axios
  .post(`http://localhost/index.php/user/verify?username=${username}&password=${password}`)
  .then((response) => {
    console.log('Response Data:', response.data);
    const data = JSON.parse(response.data); // Parse the JSON string into an object
    console.log('data: ', data);
    console.log('success: ', data.success);
    if (data && data.success === true) {
      // Login was successful, call the parent component's function to update the state
      console.log("logged in successfully");
      this.props.onLoginSuccess();
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
        {!signingUp && <button onClick={this.handleSignup}>Sign Up</button>}
      </div>
    );
  }
}

export default Login;
