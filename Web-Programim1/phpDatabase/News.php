<?php
class News {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllNews() {
        $sql = "SELECT * FROM news";
        $result = $this->db->getDBConnection()->query($sql);

        $news = [];
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }

        return $news;
    }


    public function fetchNews() {
        $news = $this->getAllNews();
    
        if (!empty($news)) {
            echo '<table class="greyGridTable">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>User ID</th>';
            echo '<th>Title</th>';
            echo '<th>Content</th>';
            echo '<th>Image Path</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            foreach ($news as $item) {
                echo '<tr>';
                echo '<td>' . $item["id"] . '</td>';
                echo '<td>' . $item["user_id"] . '</td>';
                echo '<td>' . $item["title"] . '</td>';
                echo '<td>' . $item["content"] . '</td>';
                echo '<td>' . $item["image_path"] . '</td>';
                echo '<td>';
                
                // Add form for delete button
                echo '<form method="POST" action="\Web-Programim\src\logged-in\phpScripts\delete-news.php">';
                echo '<input type="hidden" name="news_id" value="' . $item["id"] . '">';
                echo '<button type="submit" name="deleteButton" id="deleteButton">Delete</button>';
                echo '</form>';
                
                echo '</td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No news available.';
        }
    }
    


    public function insertNews($userId, $title, $content, $imagePath) {
        $sql = "INSERT INTO news (user_id, title, content, image_path) VALUES (?,?,?,?)";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("isss", $userId, $title, $content, $imagePath);

        return $stmt->execute();
    }


    public function deleteNews($newsId) {
        $sql = "DELETE FROM news WHERE id = ?";
        $stmt = $this->db->getDBConnection()->prepare($sql);
        $stmt->bind_param("i", $newsId);

        return $stmt->execute();
    }



    
}

