<?php 

require_once '../config/config.php';
require_once ROOTDIR . 'classes/DBManager.php';

if (isset($_POST['username']) && isset($_POST['password']) ) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate username
    if (strlen($username) < 4 || strlen($username) > 20) {
        response(false , "Username must be between 4 and 20 characters long");
    }

    // Validate password
    if (strlen($password) < 8) {
        response(false , "Password must be at least 8 characters long");
    }


    // Check if username or email already exists
    $dbm = new DBManager(HOST, USERNAME, PASSWORD, DBNAME);
    $dbm->connect();
    // prevent mysql injection 
    $username = $dbm->real_escape_string( $username);
    $password = $dbm->real_escape_string( $password);
    $user = $dbm->get_row_result("SELECT * FROM users WHERE username = '$username' ");
    if(empty($user)){
        response(false, "Username is not exists. Please create an account first");
    }

    // Validate password
    if ($user['password'] !== md5($password)) {
        response(false, "Password is incorrect");
    }


    // set session variables
    $_SESSION["username"] = $user['username'];
    $_SESSION["user_id"] = $user['id'];


    response(true, "Login successful. Please wait...");
}

