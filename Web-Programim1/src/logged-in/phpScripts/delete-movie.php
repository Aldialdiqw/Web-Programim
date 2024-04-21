<?php
require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/Movies.php');

if (isset($_POST['deleteButton'])) {
    $movieId = $_POST['movie_id'];

    $db = new Database();
    $movies = new Movies($db);

    if ($movies->deleteMovie($movieId)) {
        echo 'Movie Deleted Successfully';
        header("Location: /Web-Programim/src/logged-in/adminPages/movietv_dashboard.php");
        exit();

    } else {
        echo "Error deleting movie.";
    }
}
?>
