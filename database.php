<?php
    $server = 'localhost';
    $username = 'id18771849_cronox';
    $password = '88r%2C!gH=K{R3YT';
    $database = "id18771849_safetogether";

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $error) {
        die("Connetion failed: ".$error->getMesagge());
    } 


?>
