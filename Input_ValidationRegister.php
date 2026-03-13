<?php
require 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Input validation
    if(strlen($username) < 3){
        echo "Username must be at least 3 characters.";
        exit();
    }

    if(strlen($password) < 6){
        echo "Password must be at least 6 characters.";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try{

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        $stmt->execute();

        echo "User registered successfully.";

    }catch(PDOException $e){
        echo "Registration failed.";
    }
}
?>