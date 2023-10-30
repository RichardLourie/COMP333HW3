import React, { Component } from 'react';

class ViewSong extends Component {
  constructor(props) {
    super(props);
    this.state = {
      songId: props.songId,
      artist: '', // Initialize these with the current values
      song: '',
      rating: 1, // Initialize with the current rating
    };
  }

  componentDidMount() {
    // Fetch song details from your API
    fetch(`/api/songs/${this.state.songId}`)
      .then((response) => response.json())
      .then((data) => {
        this.setState({
          artist: data.artist,
          song: data.song,
          rating: data.rating,
        });
      })
      .catch((error) => {
        console.error('Error fetching song details:', error);
      });
  }

  render() {
    return (
      <div>
        <h2>View Song</h2>
        <p>Artist: {this.state.artist}</p>
        <p>Song: {this.state.song}</p>
        <p>Rating: {this.state.rating}</p>
      </div>
    );
  }
}

export default ViewSong;
