<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /path/to/login.php');
    exit();
}

require_once ('C:\xampp\htdocs\Web-Programim\phpDatabase\Movies.php');
require_once ('C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php');

$db = new Database();
$movies = new Movies($db);

$userWatchlist = $movies->getUserWatchlist($_SESSION['user_id']);


$db->closeConnection();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="watchlist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jolly-Lodger">
</head>
<body>
    
    <!-- HEADER PHP -->
    <?php include '/xampp/htdocs/Web-Programim/phpGlobal/header.php';?>
    
    <p class="home">Watchlist</p>
      
    <div class="mainContainer">
        <div class="movies-list">
            <div class="container">
                <div class="images-row">
                    <?php foreach ($userWatchlist as $movie): ?>
                
                        <div class="img">
                            <a href="/Web-Programim/src/movie-description/movie.php?type=movie&id=<?php echo $movie['movie_id']; ?>">
                         
                                <img src="<?php echo $movie['image_url']; ?>" alt="<?php echo $movie['title']; ?>">
                            </a>
                            <p><?php echo $movie['title']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER PHP -->
    <?php include '/xampp/htdocs/Web-Programim/phpGlobal/footer.php';?>

    <!-- SEARCH BAR -->
    <script src="/Web-Programim/jsGlobal/searchbar.js"></script>

    <!-- Hamburger Menu Script -->
    <script src="/Web-Programim/jsGlobal/hamburger-menu.js"></script>

    <!-- DISPLAY ACCOUNT -->
    <script src="/Web-Programim/jsGlobal/displayacc.js"></script>
</body>
</html>
