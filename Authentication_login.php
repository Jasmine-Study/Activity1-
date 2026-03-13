<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Input Validation
    if(empty($username) || empty($password)){
        echo "Username and password are required.";
        exit();
    }

    try {

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){

            $_SESSION['user'] = $user['username'];
            echo "Login successful!";

        }else{
            echo "Invalid login credentials.";
        }

    } catch(PDOException $e){
        echo "Login error occurred.";
    }
}
?>