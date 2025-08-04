<?php
require_once "Database.php"; // import Database class

class User extends Database {

    // CREATE
    // inserts a record in users table
    public function store($request){ // $request is equal to $_POST
        $first_name = $request['first_name'];
        $last_name  = $request['last_name'];
        $username   = $request['username'];
        $password   = $request['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`)
                VALUES ('$first_name', '$last_name', '$username', '$password')";

        if($this->conn->query($sql)){
            header('location: ../views');   // go to index.php
            exit;                           // same as die
        }else{
            die('Error creating the user: ' . $this->conn->error);
        }
    }

    // READ
    // authenticate the user details
    public function login($request){
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);
        // print_r($result);

        // Check the username
        if($result->num_rows == 1){
            // Check if the password is correct
            $user = $result->fetch_assoc();
            // print_r($user);
            // Array ( [id] => 1 [first_name] => Mary [last_name] => Watson [username] => mary [password] => $2y$10$rSpf5rKGO/sDmy96WRd2nuRiQI8Q3MvuXLHfjzqo/H3F4aXZ3iLWe [photo] => )

            if(password_verify($password, $user['password'])){
                // Create session variables for future use
                session_start();
                $_SESSION['id']         = $user['id'];
                $_SESSION['username']   = $user['username'];
                $_SESSION['full_name']  = $user['first_name'] . " " . $user['last_name'];

                header('location: ../views/dashboard.php');
                exit;
            }else{
                die('Password is incorrect');
            }
        }else{
            die('Username not found.');
        }
    }

    // logouts the user and remove user details
    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header('location: ../views');
        exit;
    }

    // READ
    // retrieve all users from the database
    public function getAllUsers(){
        $sql = "SELECT * FROM users";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die('Error retrieving all users: ' . $this->conn->error);
        }
    }

    // READ
    // get the details of the logged in user
    public function getUser($id){
        $sql = "SELECT * FROM users WHERE id = $id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc(); // expecting one record
        }else{
            die('Error retrieving the user: ' . $this->conn->error);
        }
    }

    // UPDATE
    // update user details
    public function update($request, $files){
        session_start();
        $id         = $_SESSION['id'];
        $first_name = $request['first_name'];
        $last_name  = $request['last_name'];
        $username   = $request['username'];
        $photo      = $files['photo']['name'];
        $tmp_photo  = $files['photo']['tmp_name'];

        $sql = "UPDATE users
                SET first_name  = '$first_name',
                    last_name   = '$last_name',
                    username    = '$username'
                WHERE id = $id";

        if($this->conn->query($sql)){
            $_SESSION['username'] = $username;
            $_SESSION['full_name'] = "$first_name $last_name";

            // If there is an uploaded photo, save it to the database and save the file to images folder
            if($photo){
                $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                $destination = "../assets/images/$photo";

                // 1. Save the image name to database
                if($this->conn->query($sql)){
                    // 2. Save the file to images folder
                    if(move_uploaded_file($tmp_photo, $destination)){
                        header('location: ../views/dashboard.php');
                        exit;
                    }else{
                        die('Error moving the photo.');
                    }
                }else{
                    die("Error uploading photo: " . $this->conn->error);
                }
            }

            header('location: ../views/dashboard.php');
            exit;
        }else{
            die('Error updating the user: ' . $this->conn->error);
        }
    }

    // DELETE
    // deletes the user account
    public function delete(){
        session_start();
        $id = $_SESSION['id'];

        $sql = "DELETE FROM users WHERE id = $id";

        if($this->conn->query($sql)){
            $this->logout();
        }else{
            die('Error deleting your account: ' . $this->conn->error );
        }
    }
}
?>

<!-- sample -->