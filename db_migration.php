<?php
// Include the database configuration file
require_once 'config/config.php';
require_once ROOTDIR . 'classes/DBManager.php';

$dbm = new DBManager(HOST, USERNAME, PASSWORD, DBNAME);
$dbm->connect();

// SQL query to create the user table
$sqlUser = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// SQL query to create the files table
$sqlFiles = "CREATE TABLE IF NOT EXISTS files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

// Execute the queries
if ($dbm->query($sqlUser) === TRUE && $dbm->query($sqlFiles) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $dbm->error();
}

// Close the database connection
$dbm->close();