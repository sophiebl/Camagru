<?php

class User extends Database {

    public function getAllUsers() {
        $stmt = $this->connect()->query("SELECT * FROM users");
        while ($row = $stmt->fetch()) {
            $uid = $row['id'];
            $name = $row['username'];
            return $name;
        }
    }

    public function getUsersWithCountCheck() {
        $id = 2;
        $username = "Test";

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE id=? AND username=?");    
        $stmt->execute([$id, $username]);

        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                return $row['username'];
            }
        }
    }
} 
