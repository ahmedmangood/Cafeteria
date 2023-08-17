<?php

function connect() {
    $host = 'localhost';
    $user = 'root';
    $password = 'mangood1907';
    $database = 'cafe';
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    );
    try{
        // echo 'connect to db successfully';
        return new PDO($dsn, $user, $password, $options);
    }
    catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
}