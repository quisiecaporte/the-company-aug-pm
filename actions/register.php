<?php
require_once "../classes/User.php"; // import User class

// Create an object
$user = new User;

// Call the method
$user->store($_POST); // $_POST holds all the data from the form in views/register.php
?>