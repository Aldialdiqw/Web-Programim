<?php
require_once('C:\xampp\htdocs\Web-Programim\phpDatabase\Database.php');
include('C:\xampp\htdocs\Web-Programim\src\logged-in\phpScripts\check_user.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // USER DETAILS FROM DB
    $db = new Database();
    $conn = $db->getDBConnection();
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $db->closeConnection();
} else {
    echo 'Invalid Request.';
    exit();
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // Submit form via AJAX
        $('.user-form').submit(function(e){
            e.preventDefault(); // Prevent form submission

            // Serialize form data
            var formData = $(this).serialize();

            // AJAX request
            $.ajax({
                url: $(this).attr('action'), // Form action attribute
                type: $(this).attr('method'), // Form method attribute
                data: formData,
                success: function(response){
                    // Handle success response
                    console.log(response);
                    // You can show a success message or perform any other action here
                },
                error: function(xhr, status, error){
                    // Handle error
                    console.error(error);
                    // You can show an error message or perform any other action here
                }
            });
        });
    });
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
                <div class="right-panel">
                    <h2>Update User</h2>
                    <form class="user-form" method="POST" action="/Web-Programim/src/logged-in/phpScripts/update-process.php">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <label for="text">Name:</label><br>
                        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br>
                        <label for="text">Username:</label><br>
                        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><br>
                        <label for="password">Email:</label><br>
                        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" placeholder="Enter new password"><br>
                        <label for="text">Role:</label><br>
                        <input type="text" id="role" name="role" value="<?php echo $user['role']; ?>"><br>
                        <button type="submit" name="updateUser">Update User</button>
                    </form>
                </div>

              <?php 
              ?>
            </div>
    

    
</div>
</div>
</body>
</html>
