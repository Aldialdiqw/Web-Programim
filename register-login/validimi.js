function validateForm() {
    resetErrorMessages();


    let name = document.getElementById('name').value;
    if (name.length < 2 || /\d/.test(name)) {
      showError('nameError', 'Name must be at least 2 characters long and cannot contain numbers.');
      return true;
    }

    
    let username = document.getElementById('username').value;
    if (username.length < 2 || /\d/.test(username)) {
      showError('usernameError', 'Username must be at least 2 characters long and cannot contain numbers.');
      return true;
    }

    
    let email = document.getElementById('email').value;
    let emailRegex =/^[a-zA-Z0-9._]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;

    if (!email.match(emailRegex)) {
      showError('emailError', 'Invalid email format.');
      return true;
    }

    
    let confirmEmail = document.getElementById('confirmEmail').value;
    if (confirmEmail !== email) {
      showError('confirmEmailError', 'Emails do not match.');
      return true;
    }

    
    let password = document.getElementById('password').value;
    if (password.length < 6 || !/\d/.test(password)) {
      showError('passwordError', 'Must be at least 6 characters long and contain at least one number.');
      return true;
    }

    
    let confirmPassword = document.getElementById('confirmPassword').value;
    if (confirmPassword !== password) {
      showError('confirmPasswordError', 'Passwords do not match.');
      return true;
    }

    return false;
  }

  function showError(errorId, errorMessage) {
    let errorElement = document.getElementById(errorId);
    errorElement.textContent = errorMessage;
  }

  function resetErrorMessages() {
    let errorElements = document.querySelectorAll('.error-box');
    errorElements.forEach((element) => {
      element.textContent = '';
    });
  }

  
  document.getElementById('name').addEventListener('input', function () {
    validateForm();
  });

  document.getElementById('username').addEventListener('input', function () {
    validateForm();
  });

  document.getElementById('email').addEventListener('input', function () {
    validateForm();
  });

  document.getElementById('confirmEmail').addEventListener('input', function () {
    validateForm();
  });

  document.getElementById('password').addEventListener('input', function () {
    validateForm();
  });

  document.getElementById('confirmPassword').addEventListener('input', function () {
    validateForm();
  });



  // AJAX 

  document.getElementById('submit-btn').addEventListener('click', function(event){
    event.preventDefault(); 

    // Validate form
    if (validateForm()) {
        console.log('Form has errors. Please fix them!');
        return; 
    }

    var xhr = new XMLHttpRequest();
    var form = document.getElementById('registrationForm');
    var formData = new FormData(form);

    xhr.open('POST', '/Web-Programim/phpDatabase/process_registration.php', true);
    xhr.onload = function() {
        if(xhr.status == 200) {
            console.log(xhr.responseText);
            window.location.href = "/Web-Programim/register-login/LoginForm.php";
        }
    };

    xhr.send(formData);
});
