<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) AS total_users FROM user";
        $result = $this->db->getDBConnection()->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total_users'];
        }

        return 0;
    }

    public function registerUser($name, $username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (name, username, email, password) VALUES (?,?,?,?)";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("ssss", $name, $username, $email, $passwordHash);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }


    public function userEmailExist($email) {
        $total=0;
        $sql = "SELECT COUNT(*) AS total FROM user WHERE email = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();
        return $total > 0;
    }
    



    public function getUserId() {
        return $this->db->getDBConnection()->insert_id;
    }


    




    // USER AUTHENTICATION 
    public function authenticateUser($email, $password) {
        $userId=0;
        $hashedPassword="";
        $sql = "SELECT id, password FROM user WHERE email = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                // Password is correct
                return $userId;
            }
        }

        // Authentication failed
        return false;
    }


    public function getUserName($email) {
        $username="";
        $sql = "SELECT username FROM user WHERE email = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($username);

        if($stmt->fetch()) {
            return $username;
        }
        return false;
    }


    public function getUserRole($email) {
        $role="user";
        $sql = "SELECT role FROM user WHERE email = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($role);

        if($stmt->fetch()) {
            return $role;   
        }
        return false;
    }


    // FETCH USER FOR USER-DASHBOARD
    public function fetchUser() {
        $sql = "SELECT * from user";
        $result = $this->db->getDBConnection()->query($sql);

        if($result->num_rows > 0) {
            echo '<table class="greyGridTable">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Username</th>';
            echo '<th>Email</th>';
            echo '<th>Role</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td>' . $row["username"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row["role"] . '</td>';
                echo '<td>';
                echo '<form method="POST" action="update-dashboard.php">';
                echo '<input type="hidden" name="user_id" value="' . $row["id"] . '">';
                echo '<button type="submit" name="updateButton" id="updateButton">Update</button>';
                echo '</form>';        
                echo '<form method="POST" action="\Web-Programim\src\logged-in\phpScripts\delete-user.php">';
                echo '<input type="hidden" name="user_id" value="' . $row["id"] . '">';
                echo '<button type="submit" name="deleteButton" id="deleteButton">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
        }


    }


   
   
}
?>
