<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .container {
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-6">
        <a href="../index.php" class="btn btn-sm btn-info">Go Back</a>
        <br>
        <br>
        <div class="card">
          <div class="card-header">
            Login
          </div>
          <div class="card-body">
            <form id="loginForm" method="POST" action="login.php">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <p class="text-danger error_messages" id="username_error" style="display:none"></p>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <p class="text-danger error_messages" id="password_error" style="display:none"></p>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
              <p class="text-danger error_messages" id="form_error" style="display:none"></p>
              <p class="text-danger error_messages" id="form_success" style="display:none"></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery for form validation -->
  <script>
    $(document).ready(function(){
      $('#loginForm').submit(function(e){
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        $('.error_messages').hide();
        // Simple validation
        if(username.length == 0 || password.length == 0) {
          alert('Please fill in all fields');
          return;
        }

        // Add additional validation for username 
        if (username.length < 4 || username.length > 20) {
          $("#username_error").show();
          $("#username_error").text("Username must be between 4 and 20 characters long");
        }

        // Add additional validation for password
        if (password.length < 8) {
          $("#password_error").show();
          $("#password_error").text("Password must be at least 8 characters long");
        }


        // If all fields are filled, submit the form
        $.ajax({
          type: 'POST',
          url: '../includes/login.php',
          data: $(this).serialize(),
          success: function (data) {
            data = JSON.parse(data);
            if (data.success ) {
              $("#form_success").show();
              $("#form_success").text(data.message);
              // Redirect to main page in 2 seconds
              setTimeout(function () {
                window.location.href = 'upload.php';
              } , 2);
            }
            else {
              $("#form_error").show();
              $("#form_error").text(data.message);
            }
          }
        });
      });
    });
  </script>
</body>
</html>
