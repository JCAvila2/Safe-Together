<?php
    $server = 'localhost';
    $username = 'hecker';
    $password = '1234';
    $database = "safe_together";

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $error) {
        die("Connetion failed: ".$error->getMesagge());
    } 


?>