
<?php 

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

class APIRequest {

  public $apiKey = '93c03bed3114307866a4b78a224fca1e';

  public function __construct($apiKey) {
    $this->apiKey = $apiKey;  
  }

  private function isValidApiResponse($data) {
    return isset($data['results']) && !empty($data['results']);
  }


//   TRENDING SECTION INDEX PHP 
  public function getTrendingMovies() {
    $trendingURL = 'https://api.themoviedb.org/3/trending/movie/week?api_key=' . $this->apiKey;

    // GET API REQUEST (file_get_contents)
    $response = file_get_contents($trendingURL);

    // DECODE JSON
    $data = json_decode($response, true);

    $trendingMovies = [];

    // OUTPUT
    if (isset($data['results']) && !empty($data['results'])) {
        $trendingMovies = $data['results'];
    } else {
        echo 'Failed to retrieve data!';
    }

    return $trendingMovies;
  }





//   IMG SLIDER 
public function getSliderMovies() {
    
    
  $trendingURL = 'https://api.themoviedb.org/3/trending/movie/week?api_key=' . $this->apiKey;


      if (!isset($_SESSION['trendingMovies'])) {

          $response = file_get_contents($trendingURL);
      
      
          $data = json_decode($response, true);
      
      
          if (isset($data['results']) && !empty($data['results'])) {
              $_SESSION['trendingMovies'] = $data['results'];
          } else {
              echo 'Failed to retrieve data!';
          }
      }

      $trendingMovies = isset($_SESSION['trendingMovies']) ? $_SESSION['trendingMovies'] : [];

      // LIMIT NR OF MOVIES TO DISPLAy
      $moviesToDisplay = array_slice($trendingMovies, 0, 5);

      // OUTPUT 
      if (!empty($moviesToDisplay)) {
        echo '<div class="imgContainer">';
        echo '<div class="img-slider">';
    
        foreach ($moviesToDisplay as $movie) {
            $videoURL = "https://api.themoviedb.org/3/movie/{$movie['id']}/videos?api_key=9a23cb65445bdb0713ad45e54d8b7096";
            $videoResponse = file_get_contents($videoURL);
            $videoData = json_decode($videoResponse, true);
    
            echo '<div class="slide active">';
            echo '<img loading="lazy" src="https://image.tmdb.org/t/p/w500' . $movie['poster_path'] . '" alt="' . $movie['title'] . '">';
            echo '<div class="info">';
            echo '<h2>' . $movie['title'] . '</h2>';
            echo '<p>' . $movie['overview'] . '</p>';
            echo '<div class="buttons" style="display: flex;">';
    
            if (isset($videoData['results']) && !empty($videoData['results'])) {
                $videoKey = $videoData['results'][0]['key'];
                echo '<button><a href="https://www.youtube.com/watch?v=' . $videoKey . '">Watch Trailer</a></button>';
            } else {
                echo '<button>Trailer not available</button>';
            }
    
            // Check if user is logged in
            if (isset($_SESSION['user_id'])) {
               
               
               
                

                echo '<form method="post"  action="watchlist.php" class="watchlist-form">';
                echo '<input style="display:none;" type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">';
                echo '<input style="display:none;" type="hidden" name="movie_id" value="' . $movie['id'] . '">';
                echo '<input style="display:none;" type="hidden" name="poster_path" value="https://image.tmdb.org/t/p/w500' . $movie['poster_path'] . '">';
                echo '<button type="submit" id="watchBtn">Add to Watch List</button>';
                echo '</form>';
            } else {
                // Redirect to login page if user is not logged in
                echo '<button id="watchBtn"><a href="/Web-Programim/register-login/LoginForm.php" style="color: #FFF">Add to Watch List</a></button>';  
            }
    
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo 'Failed to retrieve trending movies data!';
    }
}







}


?>