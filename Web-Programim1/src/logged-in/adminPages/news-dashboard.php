<?php 
session_start();

require_once('/xampp/htdocs/Web-Programim/phpDatabase/Database.php');
require_once('/xampp/htdocs/Web-Programim/phpDatabase/User.php'); 
require_once('/xampp/htdocs/Web-Programim/phpDatabase/News.php'); 
include('C:\xampp\htdocs\Web-Programim\src\logged-in\phpScripts\check_user.php');

$db = new Database();
$conn = $db->getDBConnection();

$user = new User($db); 
$news = new News($db);

// Define $allNews variable and initialize it as an empty array
$allNews = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sortButton'])) {
    $sortingMethod = $_POST['sortingMethod'];
    applySorting($sortingMethod);
} else {
    // If no sorting is applied, fetch all news
    $allNews = $news->getAllNews();
}

// Function to compare news titles for sorting
function compareNewsTitles($a, $b) {
    return strcmp($a['title'], $b['title']);
}

// Function to apply sorting based on selected method
function applySorting($method) {
    global $news, $allNews;
    
    $allNews = $news->getAllNews(); // Refresh news list
    
    switch ($method) {
        case 'sort':
            sort($allNews);
            break;
        case 'rsort':
            rsort($allNews);
            break;
        case 'asort':
            asort($allNews);
            break;
        case 'ksort':
            ksort($allNews);
            break;
        case 'arsort':
            arsort($allNews);
            break;
        case 'krsort':
            krsort($allNews);
            break;
        default:
            // Default to sorting alphabetically by title
            usort($allNews, 'compareNewsTitles');
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
                <h2>News Panel</h2>    
                
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
                
                <!-- Display News -->
                <table class="greyGridTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <!-- Add more columns if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allNews as $newsItem) : ?>
                            <tr>
                                <td><?= $newsItem['id'] ?></td>
                                <td><?= $newsItem['title'] ?></td>
                                <!-- Add more columns if needed -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>


            <!-- RIGHT PANNEL  -->
            <div class="right-panel">
                <div class="tableContainer">
                <h2>News Panel</h2>
                <a href="\Web-Programim\src\logged-in\phpScripts\add-news.php" id="addUser">Add News</a>
                <?php
                $news->fetchNews();
                ?>
                </div>
                

                
            </div>
        </div>


    </body>
    </html>