<?php

require_once 'config/config.php';
if(isSessionValid()){
  header('Location: pages/upload.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="card">
          <div class="card-header">
            Welcome
          </div>
          <div class="card-body">
            <h5 class="card-title">Choose an option:</h5>
            <a href="pages/login.php" class="btn btn-primary">Login</a>
            <a href="pages/register.php" class="btn btn-success">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
