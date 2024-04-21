<?php 
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: /Web-Programim/src/index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registation</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
        
  <a href="/Web-Programim/src/index.php" class="homeAnchor "style="margin-top: -670px;margin-right: -30px; text-decoration: none; color: #FFF;"><b>< Home</b></a>
    <div class="wrapper">
        <form action="/Web-Programim/phpDatabase/process_registration.php" method="post" id="registrationForm">
            <div class="page-buttons">
                <button type="submit"><a href="/Web-Programim/register-login/LoginForm.php">LOG IN</a></button>
                <button type="submit" id="registerButton"><a href="/Web-Programim/register-login/RegistationForm.php">REGISTER</a></button>
            </div>
            
            <div class="container">
                
    
                <div class="left-section">
                    <div class="title">
                        <h1 style="margin-bottom: -5px;">
                            <span style="color: #FFF; margin-left: -350px; font-size: 30px;">Create</span>
                          <span style="color: #A98F76; font-size: 30px;">Account</span>
                        </h1>
                    </div>




                    <div class="input-box">
                        <div class="name-surname">
                          <div class="input-field">
                            <input type="text" placeholder="Name" id="name" name="name" required>
                            <i class='bx bxs-user'></i>
                            <div class="error-box" id="nameError"></div>
                          </div>
                          <div class="input-field">
                            <input type="text" placeholder="Username" id="username" name="username" required>
                            <i class='bx bxs-user'></i>
                            <div class="error-box" id="usernameError"></div>
                          </div>
                        </div>
                      
                        <div class="emails">
                          <div class="input-field">
                            <input type="text" placeholder="Email" id="email" name="email" required>
                            <i class='bx bxs-user'></i>
                            <div class="error-box" id="emailError"></div>
                          </div>
                          <div class="input-field">
                            <input type="email" placeholder="Confirm Email" id="confirmEmail" required>
                            <i class='bx bxs-envelope'></i>
                            <div class="error-box" id="confirmEmailError"></div>
                          </div>
                        </div>
                      
                        <div class="password-cnfPassowrd">
                          <div class="input-field">
                            <input type="password" placeholder="Password" id="password" name="password" required>
                            <i class='bx bxs-lock-alt'></i>
                            <div class="error-box" id="passwordError"></div>
                          </div>
                          <div class="input-field">
                            <input type="password" placeholder="Confirm Password" id="confirmPassword" required>
                            <i class='bx bxs-lock-alt'></i>
                            <div class="error-box" id="confirmPasswordError"></div>
                          </div>
                        </div>
                      
                        <div class="submit-section">
                          <input type="checkbox" required><span style="color: #FFF; margin-left: 15px;" required>I agree to the terms and conditions</span>
                          <button type="submit" class="btn" id="submit-btn">Register</button>
                           <div id="emailExistsError" style="color: red; margin-top: 10px; <?php echo isset($_SESSION['registration_error']) ? 'display: block;' : 'display: none;'; ?>">
        <?php echo isset($_SESSION['registration_error']) ? $_SESSION['registration_error'] : ''; ?>
    </div>
                        </div>
                      </div>
                </div>


                <div class="right-section">
                    <div class="social-icons">
                        <h2>Get Connected With</h2>
                        <a href="https://mail.google.com/" target="_blank"><img src="/Web-Programim/register-login/imgs-loginform/gmail.png" alt="gmail"></a>
                        <a href="https://www.facebook.com/" target="_blank"><img src="/Web-Programim/register-login/imgs-loginform/fb.png" alt="facebook"></a>
                        <a href="https://twitter.com/" target="_blank"><img src="/Web-Programim/register-login/imgs-loginform/x.png" alt="x"></a>
                        
                    </div>
                </div>
               
            </div>
            
           
        </form>
    </div>


    <!-- VALIDIMI -->
    <script src="validimi.js"></script>
      
</body>
</html>