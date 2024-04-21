<?php

// CHECK IF TYPE IS IN URL
if (isset($_GET['type'])) {
    $type = $_GET['type'];

    $apiKey = '93c03bed3114307866a4b78a224fca1e';

    // FETCH BASED ON TYPE
    function fetchDetails($id, $type, $apiKey) {
        $detailsURL = "https://api.themoviedb.org/3/{$type}/{$id}?api_key=93c03bed3114307866a4b78a224fca1e";
        $response = file_get_contents($detailsURL);
        return json_decode($response, true);
    }

    // CHECK IF ID PARAM IN URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $details = fetchDetails($id, $type, $apiKey);

        $title = $details['title'] ?? $details['name'];
        $description = $details['overview'];
        $genres = $details['genres'];
        $voteCount = $details['vote_count'];
        $originCountry = $details['original_language'];
        $posterPath = $details['poster_path'];
        $voteAverage = $details['vote_average'];

        // GENRE NAMES
        $genreNames = array_map(function($genre) {
            return $genre['name'];
        }, $genres);

        $genresString = implode(', ', $genreNames);

        // TRAILER VIDS
        $videosURL = "https://api.themoviedb.org/3/{$type}/{$id}/videos?api_key={$apiKey}";
        $videosResponse = file_get_contents($videosURL);
        $videosData = json_decode($videosResponse, true);

        $trailers = [];

        // FILTER FOR TRAILER ONLY
        foreach ($videosData['results'] as $video) {
            if ($video['type'] === 'Trailer') {
                $trailers[] = $video;
            }
        }
    } else {
        echo 'Failed!';
        exit;
    }
} else {
    echo 'Failed!';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="movieStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    
    <!-- FONTSs -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jolly-Lodger">
</head>
<body>

    <!-- HEADER PHP  -->
    <?php include '/xampp/htdocs/Web-Programim/phpGlobal/header.php';?>




      <div class="movie">
        <div class="container">
            <div class="poster">
                <img src="https://image.tmdb.org/t/p/w500<?= $posterPath ?>" alt="<?= $title ?>">
            </div>

            <div class="movie-details">
                <div class="movie-title">
                    <h2><?= $title ?></h2>
                    <p><?= $genresString ?></p>
                </div>


                
                <div class="movie-buttons">
                    <ul class="button-list">
                        <li>
                        <a href="<?= isset($trailers[0]) ? 'https://www.youtube.com/watch?v=' . $trailers[0]['key'] : '#' ?>" class="trailer">Play Trailer</a>
                        </li>
                    </ul>
                </div>



                <div class="movie-description">
                    <h3>Overview</h3>
                    <p><?= $description ?></p>
                </div>

                <h3>More Info</h3>
                <div class="credits">
                    <p>Average Rating : <?= $voteAverage ?></p>
                    <p>Vote Count : <?= $voteCount ?></p>
                    <p>Language : <?= $originCountry ?></p>
                </div>
            </div>
          </div>
        </div>



        <div class="reviews">
        <div class="submit-review">
            <h2 id="reviewHeader">Leave A Review!</h2>
            <form class="submit-form" action="/Web-Programim/phpDatabase/testReview.php?type=movie&id=<?= $id ?>" method="POST">
                <input type="text" name="rating" placeholder="Rating">
                <textarea name="comment" placeholder="Your comment"></textarea>
                <button type="submit">Submit Review</button>
            </form>
        </div>

            <div class="container">
              <!-- NAV BAR START -->
              <div class="reviewNavContainer">
                <div class="nav-review">
                  <a href="">New Reviews</a>
                </div>
              </div>
      
           
              <!-- NAV BAR END -->
             
          <div class="reviewBoxContainer">
          <?php
                require_once '/xampp/htdocs/Web-Programim/phpDatabase/Database.php';
                require_once '/xampp/htdocs/Web-Programim/phpDatabase/Review.php';
                require_once '/xampp/htdocs/Web-Programim/phpDatabase/User.php';

                $db = new Database();
                $review = new Review($db);
                $user = new User($db);


                // Get user reviews
                $userReviews = $review->getAllReviews(10);


                // Display user reviews
                foreach ($userReviews as $userReview) {
                    echo '<div class="reviewBox">';
                    echo '<div class="account-nav">';
                    echo '<img src="/Web-Programim/src/imgs/icons/account-pfp.jpg" alt="pfp" style="height: 30px;">';
                    
                    // Display the username
                    echo '<p id="account" style="display: inline;">' . $userReview['username']  . '</p>';
                    
                    echo '</div>';
                    echo '<div class="review-bottom">';
                    echo '<p id="reviewText">' . $userReview['comment'] . '</p>';
                    echo '<button><i class="fa fa-thumbs-up"></i></button>';
                    echo '<button><i class="fa fa-thumbs-down"></i></button>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
    
  
          </div>
        </div>
        
        
      </div>
    </div>
      
      
      
      
        
              </div>
              
            </div>
          </div>

        
        





        <!--FOOTER PHP-->
        <?php include '/xampp/htdocs/Web-Programim/phpGlobal/footer.php';?>

        <!-- SEARCH BAR -->
        <script src="/Web-Programim/jsGlobal/searchbar.js"></script>


        
     <!-- DISPLAY  ACCOUNT -->
     <script src="/Web-Programim/jsGlobal/displayacc.js"></script>


  
<!-- Hamburger Menu Script-->
<script src="/Web-Programim/jsGlobal/hamburger-menu.js"></script>
</body>
</html>