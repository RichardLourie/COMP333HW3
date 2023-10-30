import React, { Component } from 'react';
import UpdateSong from './updateSong';

class SongList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      songs: [],
      editingSong: null,
      viewingSong: null,
    };
  }

  componentDidMount() {
    // Fetch the list of songs when the component mounts
    // Replace 'YOUR_API_ENDPOINT/songs' with your actual API endpoint
    fetch('YOUR_API_ENDPOINT/songs')
      .then((response) => response.json())
      .then((data) => this.setState({ songs: data }));
  }

  render() {
    const { songs } = this.state;

    return (
    <div>
     <h2>Song List</h2>
      <table>
        <thead>
          <tr>
            <th>Artist</th>
            <th>Song</th>
            <th>Rating</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {songs.map((song) => (
            <tr key={song.id}>
              <td>{song.artist}</td>
              <td>{song.title}</td>
              <td>{song.rating}</td>
              <td>
                <button onClick={() => this.handleDelete(song.id)}>Delete</button>
                <button onClick={() => this.handleEdit(song.id)}>Edit</button>
                <button onClick={() => this.handleView(song.id)}>View</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      {editingSong && <UpdateSongSong song={selectedSong} />} {/* Render EditSong if a song is selected */}
      {viewingSong && <viewSong song={selectedSong} />} {/* Render EditSong if a song is selected */}
    </div>
    );
  }

  // Add functions for handling delete and edit actions
  handleDelete = (songId) => {
      // Send an HTTP DELETE request to delete the song
  fetch(`/api/songs/${songId}`, { method: 'DELETE' })
  .then((response) => {
    if (response.status === 200) {
      // Song deleted successfully, show a notification
      // You can use a notification library or create a custom notification component
      showNotification('Song deleted successfully', 'success');
      // Update your song list to reflect the changes
      // For example, fetch the updated song list from the server
    } else {
      showNotification('Error deleting song', 'error');
    }
  })
  .catch((error) => {
    console.error('Error deleting song:', error);
    showNotification('Error deleting song', 'error');
  });
  };

  handleEdit = (songId) => {
    this.setState({ editingSong: song });
  };

  handleView = (songId) => {
    this.setState({ viewingSong: song });
  };
}

export default SongList;
