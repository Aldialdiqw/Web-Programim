<?php
require_once('C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // FORM VALIDATION 
    if(empty($name) || empty($username) || empty($email) || empty($password) || empty($role) ) {
        echo 'Please fill in all of the fields!';
        exit();
    }

    // PASSWORD HASH 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $db = new Database();
    $conn = $db->getDBConnection();

    // Check if email already exists
    $sql_check_email = "SELECT * FROM user WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    if ($result_check_email->num_rows > 0) {
        echo 'Email Already Exists!';
        header("Location: \Web-Programim\src\logged-in\adminPages\users-dashboard.php");
        exit();
       
    }

    // INSERT USER TO DB 
    $sql_insert_user = "INSERT INTO user (name, username, email, password, role) VALUES (?,?,?,?,?)" ;
    $stmt_insert_user = $conn->prepare($sql_insert_user);
    $stmt_insert_user->bind_param("sssss", $name, $username, $email, $hashedPassword, $role);

    if($stmt_insert_user->execute()) {
        header("Location: \Web-Programim\src\logged-in\adminPages\users-dashboard.php");
        exit(); 
    } else {
        echo 'Error adding a user: ' .$stmt_insert_user->error;
    }

    $stmt_insert_user->close();
    $stmt_check_email->close();
    $db->closeConnection();

} else {
    echo 'Invalid Request.';
}
?>
