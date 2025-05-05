<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

$id = $_POST['id'] ?? null;
$entryType = $_POST['entry_type'] ?? null;

if (!$id || !$entryType || !in_array($entryType, ['Officer', 'Enlistment'])) {
    $_SESSION['message'] = ["type" => "error", "text" => "Invalid ID or entry type."];
    header("Location: /../pages/assets.php");
    exit;
}

$table = $entryType === 'Officer' ? 'officer_records' : 'enlistment_records';

try {
    $pdo->beginTransaction();

    // Updatable fields
    $fields = [
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'birthplace',
        'gender',
        'contact_number',
        'email',
        'address',
        'height',
        'weight',
        'blood_type',
        'eye_color',
        'hair_color',
        'rank',
        'militaryidenumber',
        'physical_profile',
        'grade',
        'rating',
        'csc_eligibility',
        'tin',
        'philhealth',
        'pagibig',
        'passport',
        'date_entered_mil_service',
        'date_enlist_cad',
        'cad_status',
        'source_of_commission',
        'date_appointed',
        'date_enlisted',
        'date_last_reenlistment',
        'date_last_promex',
        'date_last_promotion',
        'date_optional_retirement',
        'date_compulsory_retirement',
        'ete',
        'midyear',
        'length_of_service',
        'authority_effectively',
        'years_long_pay',
        'present_duty_primary',
        'present_duty_collateral1',
        'present_duty_collateral2',
        'present_duty_collateral3',
        'present_duty_collateral4',
        'present_duty_collateral5',
        'present_duty_collateral6',
        'position_designation',
        'losing_unit',
        'sea_duty_years',
        'field_duty_total',
        'mil_career_course',
        'civilian_course',
        'last_pft_result',
        'edrd',
        'date_actual_report',
        'date_carried_mr',
        'authority',
        'fos',
        'fos_order',
    ];

    $updates = [];
    $params = [];
    foreach ($fields as $field) {
        $updates[] = "$field = :$field";
        $params[":$field"] = $_POST[$field] ?? null;
    }

    // Handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new Exception('Invalid image format.');
        }

        $newFileName = uniqid('photo_', true) . '.' . $fileExtension;
        $uploadDir = __DIR__ . '/../uploads/photos/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $destPath = $uploadDir . $newFileName;
        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            throw new Exception('Failed to save uploaded photo.');
        }

        $updates[] = "photo = :photo";
        $params[':photo'] = $newFileName;
    }

    $params[':id'] = $id;
    $sql = "UPDATE `$table` SET " . implode(', ', $updates) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Update socials
    $pdo->prepare("DELETE FROM personnel_socials WHERE personnel_id = ?")->execute([$id]);
    if (!empty($_POST['socials']) && is_array($_POST['socials'])) {
        $stmtSocial = $pdo->prepare("INSERT INTO personnel_socials (personnel_id, platform, account_name) VALUES (?, ?, ?)");
        foreach ($_POST['socials'] as $social) {
            $platform = trim($social['type'] ?? '');
            $account = trim($social['name'] ?? '');

            if ($platform === '' && $account === '') {
                continue; // Skip blank social media fields
            }

            $stmtSocial->execute([$id, $platform, $account]);
        }

    }

    // Update dependents
    $pdo->prepare("DELETE FROM personnel_dependents WHERE personnel_id = ?")->execute([$id]);
    if (!empty($_POST['dependents']) && is_array($_POST['dependents'])) {
        $stmtDep = $pdo->prepare("INSERT INTO personnel_dependents (personnel_id, name, address, birthdate, contact_number, relationship) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($_POST['dependents'] as $dep) {
            if (
                empty(trim($dep['name'])) &&
                empty(trim($dep['address'])) &&
                empty(trim($dep['birthdate'])) &&
                empty(trim($dep['contactnumber'])) &&
                empty(trim($dep['relationship']))
            ) {
                continue; // Skip empty dependent blocks
            }
            $stmtDep->execute([
                $id,
                $dep['name'],
                $dep['address'],
                $dep['birthdate'],
                $dep['contactnumber'],
                $dep['relationship']
            ]);
        }

    }

    $pdo->commit();
    $_SESSION['message'] = ["type" => "success", "text" => "$entryType record successfully updated."];
    header("Location: /../pages/assets.php");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['message'] = ["type" => "error", "text" => "Update failed: " . $e->getMessage()];
    header("Location: /../pages/assets.php");
    exit;
}
