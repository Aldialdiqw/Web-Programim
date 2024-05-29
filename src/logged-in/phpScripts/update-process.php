<?php

require_once('C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
    $userId = $_POST['user_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if the provided email already exists
    $db = new Database();
    $conn = $db->getDBConnection();
    $emailExists = false;
    checkEmailExists($conn, $email, $emailExists);
    if ($emailExists) {
        $_SESSION['update_error'] = "Email already exists!";
        header("Location: /Web-Programim/src/logged-in/adminPages/users-dashboard.php");
        exit();
    }

    // Update user in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    updateUser($conn, $name, $username, $email, $hashedPassword, $role, $userId);

    $db->closeConnection();
} else {
    echo 'Invalid Request.';
}

function checkEmailExists(&$conn, $email, &$exists) {
    $sql_check_email = "SELECT * FROM user WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    $exists = $result_check_email->num_rows > 0;
    $stmt_check_email->close();
}

function updateUser(&$conn, $name, $username, $email, $hashedPassword, $role, $userId) {
    $sql_update_user = "UPDATE user SET name=?, username=?, email=?, password=?, role=? WHERE id=?";
    $stmt_update_user = $conn->prepare($sql_update_user);
    $stmt_update_user->bind_param("sssssi", $name, $username, $email, $hashedPassword, $role, $userId);

    if ($stmt_update_user->execute()) {
        echo 'User updated successfully';
        header("Location: /Web-Programim/src/logged-in/adminPages/users-dashboard.php");
        exit();
    } else {
        echo 'Error updating user: ' . $stmt_update_user->error;
    }

    $stmt_update_user->close();
}
