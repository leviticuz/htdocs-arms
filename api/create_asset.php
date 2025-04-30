<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

$entryType = $_POST['entry_type'] ?? null;
if (!$entryType || !in_array($entryType, ['Officer', 'Enlistment'])) {
    $_SESSION['message'] = ["type" => "error", "text" => "Invalid entry type"];
    header("Location: /../pages/assets.php");
    exit;
}

try {
    $pdo->beginTransaction();

    // Base SQL and fields
    $table = $entryType === 'Officer' ? 'officer_records' : 'enlistment_records';
    $fields = [
        'first_name', 'last_name', 'middle_name', 'birthday', 'birthplace', 'gender', 'religion', 'ethnic_group', 'marital_status',
        'address', 'email', 'contact_number', 'height', 'weight', 'blood_type', 'eye_color', 'hair_color', 'complexion', 'body_built',
        'other_markings', 'shoes_fit', 'tshirt_size', 'shorts_size', 'waistline', 'headgear_size', 'combatboots_size', 'sbdu_size',
        'rank', 'militaryidenumber', 'physical_profile', 'grade', 'rating', 'csc_eligibility', 'tin', 'philhealth', 'pagibig', 'passport',
        'date_entered_mil_service', 'date_enlist_cad', 'source_of_commission', 'date_appointed', 'date_enlisted', 'date_last_reenlistment',
        'date_last_promex', 'date_last_promotion', 'date_optional_retirement', 'date_compulsory_retirement', 'ete', 'current_ete',
        'length_of_service', 'authority_effectively', 'years_long_pay', 'present_duty_primary', 'position_designation', 'losing_unit',
        'sea_duty_years', 'field_duty_total', 'mil_career_course', 'civilian_course', 'last_pft_result', 'edrd', 'date_actual_report',
        'date_carried_mr', 'authority'
    ];

    // Add Officer-only fields
    if ($entryType === 'Officer') {
        $fields[] = 'cad_status';
        $fields[] = 'fos';
        $fields[] = 'fos_order';
    }

    $placeholders = array_map(fn($f) => ":$f", $fields);
    $sql = "INSERT INTO `$table` (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = $pdo->prepare($sql);

    $params = [];
    foreach ($fields as $field) {
        $params[":$field"] = $_POST[$field] ?? null;
    }

    $stmt->execute($params);
    $personnelId = $pdo->lastInsertId();

    // Insert socials
    if (!empty($_POST['socials'])) {
        $stmtSocial = $pdo->prepare("INSERT INTO personnel_socials (personnel_id, platform, account_name) VALUES (?, ?, ?)");
        foreach ($_POST['socials'] as $social) {
            $stmtSocial->execute([$personnelId, $social['type'], $social['name']]);
        }
    }

    // Insert dependents
    if (!empty($_POST['dependents'])) {
        $stmtDep = $pdo->prepare("INSERT INTO personnel_dependents (personnel_id, name, address, birthdate, contact_number, relationship) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($_POST['dependents'] as $dep) {
            $stmtDep->execute([$personnelId, $dep['name'], $dep['address'], $dep['birthdate'], $dep['contactnumber'], $dep['relationship']]);
        }
    }

    $pdo->commit();
    $_SESSION['message'] = ["type" => "success", "text" => "$entryType record successfully added"];
    header("Location: /../pages/assets.php");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['message'] = ["type" => "error", "text" => "Failed to add record: " . $e->getMessage()];
    header("Location: /../pages/assets.php");
    exit;
}
