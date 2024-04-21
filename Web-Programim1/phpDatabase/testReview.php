<?php
require_once 'Database.php';
require_once 'Review.php';

$db = new Database();
$review = new Review($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $loggedInUserId = $_SESSION['user_id'] ?? null; 

    if (!$loggedInUserId) {
        echo "User not logged in.";
        exit;
    }

    // FORM DATA RETRIVAL
    $rating = $_POST['rating']; 
    $comment = $_POST['comment'];

    // USE MOVE ID FROM URL
    $movieId = $_GET['id'] ?? null;

    // Check if movieId is available
    if (!$movieId) {
        echo "Movie ID not provided.";
        exit;
    }

    // ADD REVIEW
    $result = $review->addReview($loggedInUserId, $movieId, $rating, $comment);

    if ($result) {
        echo "Review added successfully!";
    } else {
        echo "Failed to add review.";
    }
}
?>