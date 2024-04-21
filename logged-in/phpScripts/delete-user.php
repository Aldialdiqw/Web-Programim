<?php
require_once('C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];


    $db = new Database();
    $conn = $db->getDBConnection();

    // DELETE USER FROM DB
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo 'User deleted successfully';
        header("Location: /Web-Programim/src/logged-in/adminPages/users-dashboard.php");
        exit();
        

    } else {
        echo 'Error deleting user: ' . $stmt->error;
    }

    $stmt->close();
    $db->closeConnection();
} else {
    echo 'Invalid Request.';
}
?>
