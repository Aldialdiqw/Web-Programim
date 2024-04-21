<?php 
session_start();

require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/User.php'); 
include('C:\xampp\htdocs\Web-Programim\src\logged-in\phpScripts\check_user.php');

$db = new Database();
$conn = $db->getDBConnection();

$user = new User($db); 

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
       <?php
            include('global-dashboard.php');
       ?>






            <!-- RIGHT PANNEL  -->
            <div class="right-panel">
                <div class="tableContainer">
                    <h2>User Panel</h2>    
                    
                    <a href="\Web-Programim\src\logged-in\phpScripts\add-user.php" id="addUser">Add User</a>

                  <?php 
                    // include('C:\xampp\htdocs\Web-Programim\src\logged-in\phpScripts\fetch-users.php'); 
                    $user->fetchUser();
                  ?>
                </div>
                

                
            </div>
        </div>


    </body>
    </html>