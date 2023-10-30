import React, { Component } from 'react';

class UpdateSong extends Component {
  constructor(props) {
    super(props);
    this.state = {
      songId: props.songId,
      artist: '', // Initialize these with the current values
      song: '',
      rating: 1, // Initialize with the current rating
    };
  }

  handleUpdate = () => {
    // Send a PUT request to your API to update the song with this.state.songId
    // Include this.state.artist, this.state.song, and this.state.rating in the request body
    // Handle the response accordingly
  };

  render() {
    return (
      <div>
        <h2>Update Song</h2>
        <input
          type="text"
          placeholder="Artist"
          value={this.state.artist}
          onChange={(e) => this.setState({ artist: e.target.value })}
        />
        <input
          type="text"
          placeholder="Song"
          value={this.state.song}
          onChange={(e) => this.setState({ song: e.target.value })}
        />
        <input
          type="number"
          placeholder="Rating (1-5)"
          value={this.state.rating}
          onChange={(e) => this.setState({ rating: e.target.value })}
        />
        <button onClick={this.handleUpdate}>Update Song</button>
      </div>
    );
  }
}

export default UpdateSong;
