<?php

$apiKey = '93c03bed3114307866a4b78a224fca1e';

$apiUrl = "https://api.themoviedb.org/3/trending/tv/week?api_key=93c03bed3114307866a4b78a224fca1e";
$response = file_get_contents($apiUrl);
$tvShows = json_decode($response, true)['results'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="tvshow-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- FONTSs -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jolly-Lodger">


     <!-- SWEET ALERT LIB  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <!-- HEADER PHP  -->
    <?php include '/xampp/htdocs/Web-Programim/phpGlobal/header.php';?>
    

      
      <div class="mainContainer">
        <div class="leftSection">
            <div class="container">
                <div class="genres">
                    <h3>Genre</h3>
                    <div class="genre-list">
                        <ul class="listUnordered">
                            <li><a class="genre-link" data-genre="28">Action</a></li>
                            <li><a class="genre-link" data-genre="14">Fantasy</a></li>
                            <li><a class="genre-link" data-genre="53">Thriller</a></li>
                            <li><a class="genre-link" data-genre="35">Comedy</a></li>
                            <li><a class="genre-link" data-genre="18">Drama</a></li>
                            <li><a class="genre-link" data-genre="878">Sci-fi</a></li>
                            <li><a class="genre-link" data-genre="27">Horror</a></li>
                        </ul>
                    </div>
                </div>
    
    
    
               
    
    
                
            </div>
          </div>






          <div class="movies-list">
            <div class="container">
                <div class="images-row">

                <?php foreach ($tvShows as $tvshow) : ?>
                     
                    <div class="img" data-genre-ids="<?= implode(',', $tvshow['genre_ids']) ?>">
                    <a href="/Web-Programim/src/movie-description/movie.php?type=tv&id=<?= $tvshow['id'] ?>">
                            <img src="https://image.tmdb.org/t/p/w500<?= $tvshow['poster_path'] ?>" alt="<?= $tvshow['name'] ?>">
                        </a>
                         
                         <p class="movie-title" style="width: 30vh;"><?= $tvshow['name'] ?></p>
                         <div class="overlay">
                         <?php
                            // Check if user is logged in
                            if (isset($_SESSION['user_id'])) :
                            ?>
                            <form method="post" action="/Web-Programim/src/movies-page/watchlist.php" class="watchlist-form">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                <input type="hidden" name="movie_id" value="<?= $tvshow['id'] ?>">
                                <input type="hidden" name="poster_path" value="https://image.tmdb.org/t/p/w500<?= $tvshow['poster_path'] ?>">
                                <button type="submit" class="add-to-watchlist" title="Add to Watchlist" id="watchListBTN">+</button>
                            </form>
                            <?php else : ?>
                            <button class="add-to-watchlist" title="Add to Watchlist"><a style="text-decoration: none;"href="/Web-Programim/register-login/LoginForm.php">+</a></button>
                            <?php endif; ?>
                         </div>
                     </div>
                    <?php endforeach; ?>
                </div>
            </div>
          </div>
        
      </div>









         <!--Footer-->
         <?php include '/xampp/htdocs/Web-Programim/phpGlobal/footer.php';?>



      
       <!-- SEARCH BAR -->
       <script src="/Web-Programim/jsGlobal/searchbar.js"></script>


        
<!-- DISPLAY  ACCOUNT -->
<script src="/Web-Programim/jsGlobal/displayacc.js"></script>



<!-- Hamburger Menu Script-->
<script src="/Web-Programim/jsGlobal/hamburger-menu.js"></script>



     <!-- ALERT MESSAGE  -->
     <script src="/Web-Programim/jsGlobal/sweetalert.js"></script>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all genre links
        var genreLinks = document.querySelectorAll('.genre-link');

        // Get all TV show elements
        var tvShowElements = document.querySelectorAll('.img');

        genreLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                
                var selectedGenre = link.getAttribute('data-genre');

                // show/hide TV shows based on the selected genre
                tvShowElements.forEach(function (tvShow) {
                    var tvShowGenres = tvShow.getAttribute('data-genre-ids');
                    if (tvShowGenres.includes(selectedGenre)) {
                        tvShow.style.display = 'block';
                    } else {
                        tvShow.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

</body>
</html>