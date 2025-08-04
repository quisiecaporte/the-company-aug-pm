<?php
require_once "../classes/User.php"; // import User class

// Create an object
$user = new User;

// Call the method
$user->login($_POST);
?>