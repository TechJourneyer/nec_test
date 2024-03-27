<?php 

// destroy session
require_once '../config/config.php';
session_destroy();

// redirect 
header('Location: ../');

