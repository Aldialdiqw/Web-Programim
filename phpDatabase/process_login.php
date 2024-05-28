<?php
session_start();

// Function to handle custom errors with SweetAlert
function handleCustomErrorWithSweetAlert($errorMessage, $redirectLocation) {

    $_SESSION['custom_error'] = $errorMessage;
   
    $_SESSION['error_type'] = 'sweet_alert';
    // Redirect to the specified location
    header("Location: $redirectLocation");
    exit();
}

require_once('Database.php');
require_once('User.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();
    $user = new User($db);

    $userId = $user->authenticateUser($email, $password);

    if ($userId) {
        $_SESSION['user_id'] = $userId;

        $userRole = $user->getUserRole($email);
        $_SESSION['role'] = $userRole;

        $username = $user->getUserName($email);
        $_SESSION['username'] = $username;

        header("Location: /Web-Programim/src/index.php");
        exit();
    } else {
        handleCustomErrorWithSweetAlert('Email/Fjalëkalim i pavlefshëm.', '/Web-Programim/register-login/LoginForm.php');
    }

    $db->closeConnection();
} else {
    handleCustomErrorWithSweetAlert('Metodë e pavlefshme e kërkesës', '/Web-Programim/register-login/LoginForm.php');
}
?>
