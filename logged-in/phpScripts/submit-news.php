<?php
session_start();
require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/User.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/News.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CHECK IF USER LOGGED IN
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        $title = $_POST['title'];
        $content = $_POST['content'];
        $imagePath = $_POST['image_path'];

        $db = new Database();
        $news = new News($db);

        // Insert news
        if ($news->insertNews($userId, $title, $content, $imagePath)) {
            header("Location: /Web-Programim/src/logged-in/adminPages/news-dashboard.php");
            exit();
        } else {
            echo 'Error adding news';
        }
    } else {
        echo 'User not logged in';
    }
}
?>
