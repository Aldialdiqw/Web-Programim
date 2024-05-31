<?php 
class Movies {
    private $mov;

    public function __construct($mov) {
        $this->mov = $mov;
    }


    public function addMovie($movieId, $title, $imageUrl) {


        if ($this->movieExists($movieId)) {
            echo "Movie already exists: $title\n";
            return true; 
        }

        $sql = "INSERT INTO movies (tmdb_id, title, image_url) VALUES (?,?,?)";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("iss", $movieId, $title, $imageUrl);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }


        $stmt->close();
    }



    public function updateMovie($movies) {
    
        foreach($movies as $movie) {
            $tmdbMovieId = $movie['id'];
            $title = $movie['title'];
            $imageUrl = $movie['poster_path'];
    
    
            $sql = "INSERT INTO movies (tmdb_id, title, image_url) VALUES (?, ? , ?) ON DUPLICATE KEY UPDATE title = VALUES(title),image_url = VALUES(image_url)";
            $stmt = $this->mov->getDBConnection()->prepare($sql);
            $stmt->bind_param("iss",$tmdbMovieId, $title, $imageUrl,); 
            $stmt->execute();
    
            $stmt->close();
            
        }
    
        
        $this->mov->closeConnection();
    
    }


    private function movieExists($movieId) {
        $sql = "SELECT COUNT(*) AS count FROM movies WHERE tmdb_id = ?";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['count'] > 0;
    }




    public function getAllMovies() {
        $sql = "SELECT * FROM movies";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
    
        if ($stmt === false) {
            die('Error preparing statement');
        }
    
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $movies = [];
    
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    
        $stmt->close();
    
        return $movies;
    }




    public function deleteMovie($movieId) {
        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $movieId);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }




    public function addToWatchlist($userId, $movieId, $imageUrl) {
        $sql = "INSERT INTO watchlist (user_id, movie_id, image_url) VALUES (?, ?, ?)";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("iis", $userId, $movieId, $imageUrl);

        if($stmt->execute()) {
            return true;
        } else {
            
            return false;
        }
        $stmt->close();
       
    }


    public function isInWatchlist($userId, $movieId) {
        $sql = "SELECT COUNT(*) AS count FROM watchlist WHERE user_id = ? AND movie_id = ?";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("ii", $userId, $movieId);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['count'] > 0;
    }
    
    public function movieExistsByTMDBId($tmdbId) {
        $sql = "SELECT COUNT(*) AS count FROM movies WHERE tmdb_id = ?";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $tmdbId);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['count'] > 0;
    }
    
    public function getMovieIdByTMDBId($tmdbId) {
        $sql = "SELECT id FROM movies WHERE tmdb_id = ?";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $tmdbId);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['id'];
    }
    


    public function getUserWatchlist($userId) {
        $sql = "SELECT movies.title, movies.tmdb_id, watchlist.movie_id, watchlist.image_url FROM movies
                INNER JOIN watchlist ON movies.id = watchlist.movie_id
                WHERE watchlist.user_id = ?";
        $stmt = $this->mov->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $watchlist = [];
        while ($row = $result->fetch_assoc()) {
            $watchlist[] = $row;
        }
    
        $stmt->close();
    
        return $watchlist;
    }
    
    

}



