<?php

$host = "localhost";
$db_name = "navmetoc-arms";
$test_db_name = "test-database-arms";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$test_db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    die("Connection Failed". $e->getMessage());
}

?>