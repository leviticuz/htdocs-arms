<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$id = $_POST['id'] ?? null;
$type = $_POST['type'] ?? '';

if (!$id || !in_array($type, ['Officer', 'Enlistment'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid ID or type.']);
    exit;
}

$table = $type === 'Officer' ? 'officer_records' : 'enlistment_records';

try {
    // Delete dependent and socials first to maintain FK constraint
    $pdo->prepare("DELETE FROM personnel_dependents WHERE personnel_id = ?")->execute([$id]);
    $pdo->prepare("DELETE FROM personnel_socials WHERE personnel_id = ?")->execute([$id]);
    $pdo->prepare("DELETE FROM `$table` WHERE id = ?")->execute([$id]);

    echo json_encode(['status' => 'success', 'message' => 'Personnel deleted successfully.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Deletion failed: ' . $e->getMessage()]);
}
