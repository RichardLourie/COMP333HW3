import React, { Component } from 'react';
import UpdateSong from './updateSong'; // Use PascalCase for component names
import ViewSong from './viewSong'; // Use PascalCase for component names
import AddSong from './addSong';
import axios from 'axios';

class SongList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      songs: [],
      editingSong: null, // State for editing a song
      viewingSong: null, // State for viewing a song
      addingSong: false,
      user: props.user,
    };
  }

  componentDidMount() {
    // Fetch the list of songs when the component mounts
    axios.get('http://localhost/index.php/song/list?limit=20')
      .then((response) => {
        // Check if the response was successful
        if (response.status === 200) {
          // Assuming the response data is an array of songs
          const songs = response.data;
          this.setState({ songs });
          console.log('songs:', songs)
        }
      })
      .catch((error) => {
        console.error('Error fetching songs:', error);
      });
  }

  render() {
    const { songs, editingSong, viewingSong , addingSong, user} = this.state;

    return (
      <div>
        <h2>Song List</h2>
        <p>you are logged in as: {user}</p>
        <table>
          <thead>
            <tr>
              <th>Username</th>
              <th>Artist</th>
              <th>Song</th>
              <th>Rating</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {songs.map((song) => (
              <tr key={song.id}>
                {/* <td>{song.username}</td> */}
                <td>{song.username}</td>
                <td>{song.artist}</td>
                <td>{song.song}</td>
                <td>{song.rating}</td>
                <td>
                  {user === song.username && <button onClick={() => this.handleDelete(song.id)}>Delete</button>}
                  {user === song.username && <button onClick={() => this.handleEdit(song)}>Edit</button>}
                  <button onClick={() => this.handleView(song)}>View</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
        {!editingSong && !viewingSong && !addingSong && <button onClick={() => this.setState({ addingSong: true })}>Add Song</button>}
        {editingSong && <UpdateSong song={editingSong} onCancel={this.handleCancel} onSongUpdated={this.handleSongUpdated}/>} {/* Render UpdateSong if a song is selected for editing */}
        {viewingSong && <ViewSong song={viewingSong} onCancel={this.handleCancel}/>} {/* Render ViewSong if a song is selected for viewing */}
        {addingSong && <AddSong user = {user} onCancel={this.handleCancel} onSongAdded={this.handleSongAdded}/>}
      </div>
    );
  }

  // Add functions for handling delete, edit, and view actions
  handleDelete = (songId) => {
    // Send an HTTP DELETE request to delete the song
    fetch(`/api/songs/${songId}`, { method: 'DELETE' })
      .then((response) => {
        if (response.status === 200) {
          // Song deleted successfully, show a notification
          // You can use a notification library or create a custom notification component
        //   showNotification('Song deleted successfully', 'success');
          // Update your song list to reflect the changes
          // For example, fetch the updated song list from the server
        } else {
        //   showNotification('Error deleting song', 'error');
        }
      })
      .catch((error) => {
        console.error('Error deleting song:', error);
        // showNotification('Error deleting song', 'error');
      });
  };

  handleEdit = (song) => {
    this.setState({ editingSong: song, viewingSong: null, addingSong: false}); // Clear the viewingSong
  };

  handleView = (song) => {
    this.setState({ viewingSong: song, editingSong: null, addingSong: false}); // Clear the editingSong
  };
  handleAdd = () => {
    this.setState({ viewingSong: null, editingSong: null, addingSong: true}); // Clear the editingSong
  };
  handleCancel = () => {
    this.setState({ viewingSong: null, editingSong: null, addingSong: null}); // Clear the editingSong
  };
  handleSongUpdated = (updatedSongData) => {
    // Find the index of the updated song in the songs array
    // console.log("on song update function started")
    const updatedSongIndex = this.state.songs.findIndex((song) => song.id === updatedSongData.id);
    // console.log("index:", updatedSongIndex)
    // console.log("song data:", updatedSongData)
  
    if (updatedSongIndex !== -1) {
    //   console.log("condition satisfied")
      // Replace the old song data with the updated data
      const updatedSongs = [...this.state.songs];
      updatedSongs[updatedSongIndex] = updatedSongData;
    //   console.log("new info: ",updatedSongs[updatedSongIndex])
  
      // Update the state with the updated songs array
      this.setState({ songs: updatedSongs, viewingSong: null, editingSong: null, addingSong: false});
    }
  };
  handleSongAdded = (updatedSongData) => {

    const updatedSongs = [...this.state.songs];
    updatedSongs.push(updatedSongData);
    //   console.log("new info: ",updatedSongs[updatedSongIndex])
      // Update the state with the updated songs array
    this.setState({ songs: updatedSongs, viewingSong: null, editingSong: null, addingSong: false});
  };
}

export default SongList;
