<?php
session_start();
require_once('Database.php');
require_once('User.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // DB Connection
    $db = new Database();

    // User object
    $user = new User($db);

    // Check if email exists
    if($user->userEmailExist($email)) {
        $_SESSION['registration_error'] = "Email already exists!";
        header("Location: /Web-Programim/register-login/RegistationForm.php");
        exit();
    }

    // Register user
    if($user->registerUser($name, $username, $email, $password)) {
        $userID = $user->getUserId();
        setcookie("user_id", $userID, time() + 3600, "/");
        header("Location: /Web-Programim/register-login/LoginForm.php");
        $cookies = $_COOKIE;


$to = $email;
$subject = 'IMDB-Clone';
$message = 'Your account has been created';
$headers = "From: aldi.keka@gmail.com\r\n"; // Gmail requires a valid sender address

if (mail($to, $subject, $message, $headers)) {
    echo "SUCCESS";
} else {
    echo "ERROR";
}

        exit();
    } else {
        echo 'Error : Registration Failed!';
    }

    // Close DB Connection
    $db->closeConnection();
} else {
    echo 'Invalid request method';
}

