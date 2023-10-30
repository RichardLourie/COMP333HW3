<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";



class SongModel extends Database

{

    public function getSongs($limit)
    {
        return $this->select("SELECT * FROM ratings ORDER BY username ASC LIMIT ?", ["i", $limit]);
    }
    
    /*
    public function createUser($postData)
    { 

        $insertUserQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->connection->prepare($insertUserQuery);

        if ($stmt === false) {
            // Handle error, the statement could not be prepared
            return false;
        }

        $username = $postData[0];
        $password = $postData[1];

        $result = $stmt->bind_param('ss', $username, $password);

        if ($result === false) {
            // Handle error, the parameters could not be bound
            return false;
        }

        return $stmt->execute();

    }
    */
    /*
    public function createUser($postData)
    { 
        
        $username= $postData[0];
        $password = $postData[1];
        $verifyPassword = $postData[2];

        if ($password === $verifyPassword && strlen($password) >= 10) {
            // Use password_hash to securely hash the user's password.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if the user already exists.
            
            $checkUserQuery = "SELECT username FROM users WHERE username = ?";
            $stmt = $this->connection->prepare($checkUserQuery);
            $stmt->bind_param('s', $username);
            $result = $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0){
                $response['error'] = "User with this username already exists. Please login or choose a different username.";
            } else {
                // Insert the new user into the users table.
                $insertUserQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt = $this->connection->prepare($insertUserQuery);
                $stmt->bind_param('ss', $username, $hashedPassword);
                $result = $stmt->execute();

                if ($result) {
                    $response['success'] = "User registration successful!";         
                } else {
                    $response['error'] = "User registration failed!";   
                }
            }
        } else {
            $response['error'] = "Password and confirm password do not match or are less than 10 characters long.";
        }

        return $response;
    
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