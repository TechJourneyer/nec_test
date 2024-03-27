<?php 

require_once '../config/config.php';
require_once ROOTDIR . 'classes/DBManager.php';

if (!isSessionValid()) {
    response(false, "Please login first");
}
try{
    $file = $_FILES['file'];
    $temp = $file['tmp_name'];
    $original_name = $file['name'];
    $ext = pathinfo($original_name, PATHINFO_EXTENSION);
    $saveFileName = 'files/' . uniqid() . '_' . time()  .".". $ext;
    $saveFilepath = ROOTDIR .  $saveFileName;
    
    move_uploaded_file($temp, $saveFilepath);
    $user_id = $_SESSION['user_id'];

    $dbm = new DBManager(HOST, USERNAME, PASSWORD, DBNAME);
    $dbm->connect();
    $insert = $dbm->query("INSERT INTO files (filename, filepath,user_id) VALUES ('$original_name', '$saveFileName' , '$user_id')");
    if(!$insert){
        throw new Exception("Failed to upload file. Please try again.");
    }
    response(true, "File uploaded successfully", $saveFileName);
}
catch(Exception $e){
    response(false, $e->getMessage());
}