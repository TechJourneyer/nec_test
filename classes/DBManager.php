<?php
class DBManager {
    private $dbHost;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $conn;

    // Constructor to initialize database connection parameters
    public function __construct($dbHost, $dbUsername, $dbPassword, $dbName) {
        $this->dbHost = $dbHost;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
    }

    
    // Connect to the database
    public function connect() {
        $this->conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Set UTF-8 character set to ensure proper encoding
        $this->conn->set_charset("utf8mb4");

        return $this->conn;
    }

    // Close database connection
    public function close() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // Execute SQL query
    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result;
    }

    // Prepare and execute parameterized SQL statement
    public function execute($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error preparing statement: " . $this->conn->error);
        }

        // Bind parameters
        if ($params) {
            $types = str_repeat('s', count($params)); // Assume all parameters are strings
            $stmt->bind_param($types, ...$params);
        }

        // Execute statement
        $success = $stmt->execute();
        if (!$success) {
            die("Error executing statement: " . $stmt->error);
        }

        // Close statement
        $stmt->close();

        return $success;
    }

    public function error() {
        return $this->conn->error;
    }

    public function get_row_result($query){
        $result = $this->query($query);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function get_result($query){
        $result = $this->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function real_escape_string($str){
        return $this->conn->real_escape_string($str);
    }
}
