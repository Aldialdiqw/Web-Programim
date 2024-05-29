<?php
require_once('Database.php');
require_once('Movies.php');

$db = new Database();
$moviesObject = new Movies($db);

$apiKey = '93c03bed3114307866a4b78a224fca1e';

$numberOfPages = 5;

// Get a reference to the database connection
$connRef =& $db->getDBConnection();

for ($page = 1; $page <= $numberOfPages; $page++) {
    $apiUrl = "https://api.themoviedb.org/3/trending/all/week?api_key=93c03bed3114307866a4b78a224fca1e&page=$page";
    $response = file_get_contents($apiUrl);
    $items = json_decode($response, true)['results'];

    foreach ($items as $item) {
        $tmdbItemId = $item['id'];
        $title = isset($item['title']) ? $item['title'] : (isset($item['name']) ? $item['name'] : '');
        $imageUrl = $item['poster_path'];

        // Pass the reference to the addMovie method
        $result = $moviesObject->addMovie($tmdbItemId, $title, $imageUrl, $connRef);

        if ($result) {
            echo "Item added successfully: $title\n";
        } else {
            echo "Failed to add item: $title\n";
        }
    }
}

// Close the connection using the reference
$db->closeConnection($connRef);
