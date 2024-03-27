<?php 

require_once '../config/config.php';
require_once ROOTDIR . 'classes/DBManager.php';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // Validate username
    if (strlen($username) < 4 || strlen($username) > 20) {
        response(false , "Username must be between 4 and 20 characters long");
    }

    // Validate password
    if (strlen($password) < 8) {
        response(false , "Password must be at least 8 characters long");
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        response(false , "Invalid email format");
    }
    
    

    // Check if username or email already exists
    $dbm = new DBManager(HOST, USERNAME, PASSWORD, DBNAME);
    $dbm->connect();
    // prevent mysql injection 
    $username = $dbm->real_escape_string( $username);
    $password = $dbm->real_escape_string( $password);
    $password = md5($password);
    $email = $dbm->real_escape_string( $email);
    $user = $dbm->get_row_result("SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(!empty($user)){
        response(false, "Username or email already exists");
    }

    // Insert user into database
    $insert = $dbm->query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
    if($insert){
        response(true, "Registration successful. Please login.");
    }
    response(false, "Failed to register. Please try again.");
}

