<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";



class SongModel extends Database

{

    public function getSongs($limit)
    {
        return $this->select("SELECT * FROM ratings ORDER BY username ASC LIMIT ?", ["i", $limit]);
    }
    
    public function createRatings($postData) { 
        $response = [
            'success' => false,
            'message' => '',
        ];

        $username = $postData[0];
        $artist = $postData[1];
        $song = $postData[2];
        $rating = (int) $postData[3]; 
        
        $checkUserQuery = "SELECT username FROM users WHERE username = ?";
        $stmt = $this->connection->prepare($checkUserQuery);
        $stmt->bind_param('s', $username);
        $result = $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 0) {
            $response['message'] = "Username does not exist in users table!";
            return json_encode($response);
        }

        // Check if the song by the same artist already exists for the user
        $songExistsQuery = "SELECT song FROM ratings WHERE username = ? AND artist = ? AND song = ?";
        $songExistsStmt = $this->connection->prepare($songExistsQuery);
        $songExistsStmt->bind_param('sss', $username, $artist, $song);
        $songExistsStmt->execute();
        $result = $songExistsStmt->execute();
        $songExistsStmt->store_result();
        $songCount = $songExistsStmt->num_rows;
        $songExistsStmt->close();

        if ($songCount > 0) {
            $response['message'] = "Cannot add a duplicate!";
            return json_encode($response);
        }

        $insertUserQuery = "INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($insertUserQuery);
        $stmt->bind_param('sssi', $username, $artist, $song, $rating);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Song add successful!";
        } else {
            $response['message'] = "Song add failed";
        }
        
        return json_encode($response);  
    }

    public function updateRatings($postData) { 
        $response = [
            'success' => false,
            'message' => '',
        ];

        $ratingId = (int) $postData[0];
        $newArtist = $postData[1];
        $newSong = $postData[2];
        $newRating = (int) $postData[3];

        // Construct an SQL query to update the rating
        $updateQuery = "UPDATE ratings SET artist = ?, song = ?, rating = ? WHERE id = ?";

        // Prepare and execute the SQL query
        $stmt = $this->connection->prepare($updateQuery); 
        $stmt->bind_param("ssii", $newArtist, $newSong, $newRating, $ratingId);

        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            $response['success'] = true;
            $response['message'] = "Successfully updated rating!";
            return json_encode($response);
        } else {
            // Update failed
            $response['message'] = "failure";
            return json_encode($response);
        }

        // Close the prepared statement
        $stmt->close();

    }

}