<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database

{

    public function getUsers($limit)
    {

        /*
        *this was a test 

        $userData = array("usrnm", "psrd");
        
        $this->createUser($userData);
        */

        return $this->select("SELECT * FROM users ORDER BY username ASC LIMIT ?", ["i", $limit]);
    }

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