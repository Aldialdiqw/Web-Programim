<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $movieId = $_POST['movie_id'];
    $imageUrl = $_POST['poster_path'];

    require_once 'C:\xampp\htdocs\Web-Programim\phpDatabase\Movies.php';
    require_once 'C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php';

    $db = new Database();
    $movies = new Movies($db);

    if ($movies->isInWatchlist($userId, $movieId, $imageUrl)) {
        $response = array(
            'status' => 'error',
            'message' => 'This movie is already in the watchlist!'
        );
    } else {
        if ($movies->addToWatchlist($userId, $movieId, $imageUrl)) {
            $response = array(
                'status' => 'success',
                'message' => 'Movie added to watchlist successfully!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error adding movie to watchlist.'
            );
        }
    }

    $db->closeConnection();

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method!'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
