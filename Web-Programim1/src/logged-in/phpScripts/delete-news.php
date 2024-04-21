<?php
require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/News.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteButton'])) {
        $newsId = $_POST['news_id'];

        $db = new Database();
        $news = new News($db);

        // Delete news item
        if ($news->deleteNews($newsId)) {
            header("Location: /Web-Programim/src/logged-in/adminPages/news-dashboard.php");
            exit();
        } else {
            echo 'Error deleting news';
        }
    } else {
        echo 'Invalid request';
    }
} else {
    echo 'Invalid request method';
}
?>
