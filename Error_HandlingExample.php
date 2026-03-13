<?php

try {

    $stmt = $conn->query("SELECT * FROM users");

} catch(PDOException $e){

    error_log($e->getMessage()); // log error
    echo "Something went wrong. Please try again later.";

}

?>