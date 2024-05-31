<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $tmdbId = $_POST['tmdb_id']; // Change 'movie_id' to 'tmdb_id'
    $imageUrl = $_POST['poster_path'];

    require_once 'C:\xampp\htdocs\Web-Programim\phpDatabase\Movies.php';
    require_once 'C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php';

    $db = new Database();
    $movies = new Movies($db);

    // Check if the movie exists in the database
    if ($movies->movieExistsByTMDBId($tmdbId)) {
        // Get the movie ID from the database based on the TMDB ID
        $movieId = $movies->getMovieIdByTMDBId($tmdbId);

        // Check if the movie is already in the user's watchlist
        if ($movies->isInWatchlist($userId, $movieId)) {
            $response = array(
                'status' => 'error',
                'message' => 'This movie is already in the watchlist!'
            );
        } else {
            // Add the movie to the watchlist
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
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Movie does not exist in the database.'
        );
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
