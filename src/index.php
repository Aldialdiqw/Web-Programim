<?php 
session_start();

require_once 'APIRequest.php';

$apiKeyU = '93c03bed3114307866a4b78a224fca1e';
$apiRequest = new APIRequest($apiKeyU);

$trendingMovies = $apiRequest->getTrendingMovies();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" >
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  

    <!-- FONTSs -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jolly-Lodger">
</head>
<body>  
    
      
    <!--HEADER PHP-->
    <?php include '/xampp/htdocs/Web-Programim/phpGlobal/header.php';?>
    
 
   
      
    <!-- MAIN HEADER (MOVIES , TRENDING SECTION) -->
    <div class="header-home">
  
      
      
      <div class="imgContainer" id="imgContainer">
        <div class="img-slider"> 

        <?php $sliderMovies = $apiRequest->getSliderMovies(); ?>
         
          <div class="navigation">
            <div class="btn" id="prevBtn"><</div>
            <div class="btn" id="nextBtn">></div>
          </div>

        
  
  
        </div>
      </div>
       <!-- MAIN HEADER (MOVIES , TRENDING SECTION) -->

    </div>











  <!-- TOP 100 SECTION START -->


  <!-- TOP 100 SECTION START -->
<div class="top100">
  <p id="paragraph">Trending</p>
  <div class="maincontainer">
  <div class="container">
    <?php foreach ($trendingMovies as $movie) : ?>
      <div class="top100-img">
        <a href="/Web-Programim/src/movie-description/movie.php?type=movie&id=<?= $movie['id'] ?>">
          <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" alt="<?= $movie['title'] ?>">
        </a>
        <h2><?= $movie['title'] ?></h2>
      </div>
    <?php endforeach; ?>
  </div>
  </div>
  
</div>
<!-- TOP 100 SECTION END -->
  





    
      <!-- JOIN US SECTION -->

      <div class="join-section">
        <div class="container">
          <div class="info-joinUs">
            <h2>Join <span style="display: inline; font-family: 'Kanit';">Us</span></h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab, quibusdam?</p>
            <a href="/Web-Programim/register-login/RegistationForm.php">Register Now!</a>
          </div>


          <div class="list-join">
            <ul class="inner-join-list">
              <li>Keep Track of your favorite Movies/TV Shows</li>
              <li>Get news about your favorite Actors and Actresses </li>
              <li>Find your new favorite Movie/TV Show</li>
            </ul>

          </div>


        </div>
      </div>
      
  


      <div class="reviews">
      
      
      <div class="container">
        
        <div class="poster-review">
          <img src="/Web-Programim/src/imgs/icons/barbie-transparent.png" alt="barbie">
        </div>

        


        <div class="review-container">
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




      <div class="slideshow-container" id="news-section">

  <?php
    require_once('\xampp\htdocs\Web-Programim\phpDatabase\News.php');
    require_once('\xampp\htdocs\Web-Programim\phpDatabase\Database.php');
    $db = new Database();
    // Instantiate News class
    $news = new News($db);
    // Fetch all news
    $allNews = $news->getAllNews();

  // Display news dynamically
     foreach ($allNews as $index => $article) {
         echo '<div class="mySlides fade">';
         echo '<div class="numbertext">' . ($index + 1) . ' / ' . count($allNews) . '</div>';
         echo '<img src="' . $article['image_path'] . '" style="width:100%">';
         echo '<div class="text">' . $article['title'] . '</div>';
         echo '<div class="content">' . $article['content'] . '</div>';
         echo '</div>';
     }
  ?>

  <a class="prev" onclick="plusSlidesNews(-1)">❮</a>
  <a class="next" onclick="plusSlidesNews(1)">❯</a>

</div>
<br>

<div style="text-align:center">
  <?php
  // Display dots dynamically
  foreach ($allNews as $index => $article) {
      echo '<span class="dot" onclick="currentSlideNews(' . ($index + 1) . ')"></span>';
  }
  ?>
</div>




    <!--FOOTER PHP-->
    <?php include '/xampp/htdocs/Web-Programim/phpGlobal/footer.php';?>

  



  <!-- SEARCH BAR -->
  <script src="/Web-Programim/jsGlobal/searchbar.js"></script>

  <script>
    let slideIndexNews = 1;
    showSlidesNews(slideIndexNews);

    function plusSlidesNews(n) {
      showSlidesNews(slideIndexNews += n);
    }

    function currentSlideNews(n) {
      showSlidesNews(slideIndexNews = n);
    }

    function showSlidesNews(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndexNews = 1}
        if (n < 1) {slideIndexNews = slides.length}
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndexNews-1].style.display = "block";
        dots[slideIndexNews-1].className += " active";
      }

  </script>



   <!-- IMAGE SLIDER  -->
   <script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var nextBtn = document.getElementById('nextBtn');
    var prevBtn = document.getElementById('prevBtn');
    let currentSlide = 0;


    // Current Slide
    function showSlide(n) {
      slides.forEach((slide) => {
        slide.classList.remove('active');
      });

      currentSlide += n;

      if (currentSlide >= slides.length) {
        currentSlide = 0;
      }   
      else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
      }

      slides[currentSlide].classList.add('active');
    }

    function nextSlide() {
      showSlide(1);
    }

    function prevSlide() {
      showSlide(-1);
    }

  // Start the automatic sliding
    var repeatInterval = setInterval(nextSlide, 8000);

  // Add event listeners to buttons
    nextBtn.addEventListener('click', () => {
      clearInterval(repeatInterval); 
      nextSlide();
      repeatInterval = setInterval(nextSlide, 3000); 
    });

    prevBtn.addEventListener('click', () => {
      clearInterval(repeatInterval); 
      prevSlide();
      repeatInterval = setInterval(nextSlide, 3000);
    });

  </script>




  
    <!-- Hamburger Menu Script-->
    <script src="/Web-Programim/jsGlobal/hamburger-menu.js"></script>

        <!-- DISPLAY  ACCOUNT -->
    <script src="/Web-Programim/jsGlobal/displayacc.js"></script>

  
  

 




   


  


    
    



</body>

</html>