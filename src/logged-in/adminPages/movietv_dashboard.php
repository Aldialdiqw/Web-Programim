<?php 
session_start();

require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/User.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/Movies.php');
include('C:\xampp\htdocs\Web-Programim\src\logged-in\phpScripts\check_user.php');

$db = new Database();
$conn = $db->getDBConnection();

$user = new User($db); 
$movies = new Movies($db);

// Define $allMovies variable and initialize it as an empty array
$allMovies = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sortButton'])) {
    $sortingMethod = $_POST['sortingMethod'];
    applySorting($sortingMethod);
} else {
    // If no sorting is applied, get all movies
    $allMovies = $movies->getAllMovies();
}

// Function to compare titles for sorting
function compareTitles($a, $b) {
    return strcmp($a['title'], $b['title']);
}

function compareTitlesDesc($a, $b) {
    return strcmp($b['title'], $a['title']);
}
// Function to apply sorting based on selected method
function applySorting($method) {
    global $movies, $allMovies;
    
    $allMovies = $movies->getAllMovies(); // Refresh movie list
    
    switch ($method) {
        case 'sort':
            usort($allMovies, 'compareTitles');
            break;
        case 'rsort':
            usort($allMovies, 'compareTitlesDesc');
            break;
        case 'asort':
            asort($allMovies);
            break;
        case 'ksort':
            ksort($allMovies);
            break;
        case 'arsort':
            arsort($allMovies);
            break;
        case 'krsort':
            krsort($allMovies);
            break;
        default:
            // Default to sorting alphabetically by title
            usort($allMovies, 'compareTitles');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="global-styles.css">
    <link rel="stylesheet" href="user-dashboard-styles.css">
</head>
<body>
    
    <div class="mainContainer">

        <!-- LEFT PANEL  -->
        <?php include('global-dashboard.php'); ?>

        <!-- RIGHT PANEL  -->
        <div class="right-panel">
            <div class="tableContainer">
                <h2>Manage Movies/TV Shows</h2>    
                
                <!-- Sorting Form -->
                <form method="POST" action="">
                    <label for="sortingMethod">Sort By:</label>
                    <select name="sortingMethod" id="sortingMethod">
                        <option value="sort">Default (Alphabetical by Title)</option>
                        <option value="rsort">Reverse Alphabetical by Title</option>
                        <option value="asort">Asort</option>
                        <option value="ksort">Ksort</option>
                        <option value="arsort">Arsort</option>
                        <option value="krsort">Krsort</option>
                    </select>
                    <button type="submit" name="sortButton">Sort</button>
                </form>
                
                <!-- Display Movies Table -->
                <table class="greyGridTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image URL</th>
                            <th>Commands</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allMovies as $movie) : ?>
                            <tr>
                                <td><?= $movie['id'] ?></td>
                                <td><?= $movie['title'] ?></td>
                                <td><?= $movie['image_url'] ?></td>
                                <td>
                                    <form method="POST" action="\Web-Programim\src\logged-in\phpScripts\delete-movie.php">
                                        <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
                                        <button type="submit" name="deleteButton" id="deleteButton">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
