<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="\Web-Programim\src\logged-in\adminPages\global-styles.css">
    <link rel="stylesheet" href="\Web-Programim\src\logged-in\adminPages\user-dashboard-styles.css">
</head>
<body>
    
    <div class="mainContainer">

        <!-- LEFT PANEL  -->
        <?php 
            include('C:\xampp\htdocs\Web-Programim\src\logged-in\adminPages\global-dashboard.php');
        ?>

        <!-- RIGHT PANEL  -->
        <div class="right-panel">
            <h2>Add News</h2>    
            <form class="user-form" method="POST" action="\Web-Programim\src\logged-in\phpScripts\submit-news.php" target="_self" onsubmit="return validateForm()">
                <fieldset>
                    <label for="text">Title:</label><br>
                    <input type="text" id="title" name="title"><br>
                    <label for="text">Content:</label><br>
                    <textarea id="content" name="content" rows="4"></textarea><br>
                    <label for="text">Image Path:</label><br>
                    <input type="text" id="image_path" name="image_path"><br>
                    <button type="submit">Add News</button>
                </fieldset>
            </form>
        </div>
    </div>


    <script>
         function validateForm() {
            var title = document.getElementById('title').value.trim();
            var content = document.getElementById('content').value.trim();
            var imagePath = document.getElementById('image_path').value.trim();

            if (title === '' || content === '' || imagePath === '') {
                alert('Please fill in all fields');
                return false;
            }
            return true;
        }


    </script>
</body>
</html>
