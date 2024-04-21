<?php
session_start();

require_once('Database.php');
require_once('User.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();   
    $user = new User($db);


    $userId = $user->authenticateUser($email, $password);

    if($userId) {
    
        $_SESSION['user_id'] = $userId;

        $userRole = $user->getUserRole($email);
        $_SESSION['role'] = $userRole;

        $username = $user->getUserName($email);
        $_SESSION['username'] = $username;

        if($userRole === 'admin') {
            header("Location: /Web-Programim/src/index.php");
        } else {
            header("Location: /Web-Programim/src/index.php");
        }

        exit();
    } else {
        $_SESSION['login_error'] = 'Invalid Email/Password combination.';
        header("Location: /Web-Programim/register-login/LoginForm.php");
        exit();

    }

    $db->closeConnection();
} else {
    echo 'Invalid request method';
}


