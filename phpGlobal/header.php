<link rel="stylesheet" href="/Web-Programim/phpGlobal/headerStyles.css">
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo '<div class="navBar" id="navbar">
    <nav>
        <div class="navLogo">
            <p><a href="/Web-Programim/src/index.php">fl<span>oat</a></span></p>
            
        </div>

        <div class="lists" id="myTopNav">
            <div class="lists-bg" id="listsBg"></div>

            <a href="/Web-Programim/src/index.php" class="active">Home</a>
            <a href="/Web-Programim/src/movies-page/movies-page.php">Movies</a>
            <a href="/Web-Programim/src/tvshows-page/tvshows.php">TV Shows</a>';

        // CHECK USER IF LOGGED IN
        if (isset($_SESSION['user_id'])) {
            // CHECK USER ROLE
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo '<div class="dropdown">
                            <button class="dropdown-btn">';
            
                // DISPLAY USERNAME (FROM SESSION)
                if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                } else {
                    echo 'Account';
                }
            
                echo '&#9662;</button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="/Web-Programim/src/logged-in/adminPages/admin-dashboard.php">Dashboard</a>
                            <a href="/Web-Programim/phpDatabase/logout.php">Log out</a>
                        </div>
                    </div>';
            } else {
                echo '<div class="dropdown">
                            <button class="dropdown-btn">';
            
                if (isset($_SESSION['username'])) {
                    
                    echo $_SESSION['username'];
                    
                } else {
                    echo 'Account';
                }
            
                echo '&#9662;</button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="/Web-Programim/wtv/Watchlist.php">Watchlist</a>
                            <a href="/Web-Programim/phpDatabase/logout.php">Log out</a>
                        </div>
                    </div>';
            }
        } 
        
        else {
            
            echo '<a href="/Web-Programim/register-login/LoginForm.php">Login</a>
                  <a href="/Web-Programim/register-login/RegistationForm.php">Register</a>';
}

echo '</div>

    <div class="hamburger">
        <span id="openHam" style="color: #FFFF;">&#9776</span>
        <span id="closeHam" style="color: #FFFF;">&#x2716;</span>
    </div>
</nav>
</div>';
?>
