<?php 
   require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
   require_once('/xampp/htdocs/Web-Programim/phpDatabase/User.php'); 
   require_once('/xampp/htdocs/Web-Programim/src/APIRequest.php');
   include('C:\xampp\htdocs\Web-Programim\src\logged-in\phpScripts\check_user.php');
   


   $db = new Database();
   $user = new User($db);
   $apiRequest = new APIRequest('93c03bed3114307866a4b78a224fca1e');
 ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="dashboard-styles.css">
    </head>
    <body>
        
        <div class="mainContainer">

           <!-- LEFT PANEL  -->
       <?php
       include('global-dashboard.php');
       ?>






            <!-- RIGHT PANNEL  -->
            <div class="right-panel">
            <form action="#" id="dashboard-form">
                <div class="registered-users">
                    <label for="">Total Users:</label>
                    <?php

                    $totalUsers = $user->getTotalUsers();

                    echo '<span>' . $totalUsers . '</span>';
                    ?>
                </div>

                <div class="active-users">
                    <label for="">API Requests</label>
                    <?php  
                    $trendingMovies = $apiRequest->getTrendingMovies();
 
 
                    echo '<p>' . ($trendingMovies !== false ? 'True' : 'False') . '</p>';
 
                    
                    
                    ?>
                </div>
            </form>

                
            </div>
        </div>


    </body>
    </html>