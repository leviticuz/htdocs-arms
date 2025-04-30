<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/AssetsController.php';
try {
    // Prepare SQL query
    $controller = new AssetsController($pdo);
    $assets = $controller->getPersonnel();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>
