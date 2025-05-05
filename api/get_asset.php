<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/AssetsController.php';

$filters = [
    'entry_type'     => $_GET['entry_type'] ?? null,
    'rank'           => $_GET['rank'] ?? null,
    'gender'         => $_GET['gender'] ?? null,
    'birthday_from'  => $_GET['birthday_from'] ?? null,
    'birthday_to'    => $_GET['birthday_to'] ?? null,
];

try {
    $controller = new AssetsController($pdo);
    $assets = $controller->getPersonnel($filters);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
