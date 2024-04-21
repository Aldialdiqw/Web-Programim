<?php 


class Review {
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function addReview($userId, $tmdbMovieId, $rating, $comment) {
        if (!$this->movieExists($tmdbMovieId)) {
            echo "Movie does not exist.";
            return false;
        }
    
        $sqlGeneral = "INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmtGeneral = $this->db->getDBConnection()->prepare($sqlGeneral);
        $stmtGeneral->bind_param("iiss", $userId, $tmdbMovieId, $rating, $comment);
    
        if (!$stmtGeneral->execute()) {
            return false;
        }
    
        $reviewId = $stmtGeneral->insert_id;
    
        $sqlUserReview = "INSERT INTO user_reviews (user_id, review_id) VALUES (?, ?)";
        $stmtUserReview = $this->db->getDBConnection()->prepare($sqlUserReview);
        $stmtUserReview->bind_param("ii", $userId, $reviewId);
    
        if ($stmtUserReview->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function getUserReviews($userId) {
        $sql = "SELECT r.movie_id, r.rating, r.comment FROM reviews r JOIN user_reviews ur ON r.id = ur.review_id WHERE ur.user_id = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $reviews = array();
        while($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }

        return $reviews;
    }


    public function getAllReviews($limit) {
        $sql = "SELECT r.*, u.username FROM reviews r JOIN user u ON r.user_id = u.id LIMIT ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();

        $result = $stmt->get_result();

        $reviews = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
        }

        return $reviews;
    }


    private function movieExists($movieId) {
        $sql = "SELECT COUNT(*) AS count FROM movies WHERE tmdb_id = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
    
        $result = $stmt->get_result();  
        $row = $result->fetch_assoc();
    
        return $row['count'] > 0;
    }
    
}


