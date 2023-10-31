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

    /**
    public function createRatings($postData)
    { 
        
        $username= $postData[0];
        $artist = $postData[1];
        $song = $postData[2];
        $rating = (int) $postData[3]; 

        // Check if the username exists in the users table
        $userExistsQuery = "SELECT username FROM users WHERE username = ?";
        $userExistsStmt = $this->connection->prepare($userExistsQuery);
        $userExistsStmt->bind_param('s', $username);
        $result = $userExistsStmt->execute();
        $userExistsStmt->store_result();

        if ($userExistsStmt->num_rows == 0) {
            echo "Username does not exist in users table!";
            exit();
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
            echo "can't add a duplicate!";
            echo '<br /><a href="ratingsPage.php">Go Back</a>';
            exit();
        }

        $insertUserQuery = "INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($insertUserQuery);

        $stmt->bind_param('sssi', $username, $artist, $song, $rating)

        if ($stmt->execute()) {
            echo "song add successful!";
            echo '<br /><a href="ratingsPage.php" class="back-link">back to ratings</a>';
        } else {
            echo "song add failed";
            echo '<br /><a href="ratingsPage.php" class="back-link">Retry</a>';
        }
    
    }*/
    /**
    public function returnUser($userData)

    { 
        $insertUserQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->connection->prepare($insertUserQuery);

        if ($stmt === false) {
            // Handle error, the statement could not be prepared
            return false;
        }

        $username = $userData[0];
        $password = $userData[1];

        $result = $stmt->bind_param('ss', $username, $password);

        if ($result === false) {
            // Handle error, the parameters could not be bound
            return false;
        }

        return $stmt->execute();

    }*/

}