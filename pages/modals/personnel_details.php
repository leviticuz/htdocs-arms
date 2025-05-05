<?php
require_once __DIR__ . '/../../config/database.php';

$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? null;

if (!$id || !in_array($type, ['Officer', 'Enlistment'])) {
    exit('<div class="p-3 text-danger">Invalid or missing ID/type.</div>');
}
$table = $type === 'Officer' ? 'officer_records' : 'enlistment_records';

$stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = ?");
$stmt->execute([$id]);
$person = $stmt->fetch();

$socials = $pdo->prepare("SELECT * FROM personnel_socials WHERE personnel_id = ?");
$socials->execute([$id]);
$socialMedia = $socials->fetchAll();

$dependents = $pdo->prepare("SELECT * FROM personnel_dependents WHERE personnel_id = ?");
$dependents->execute([$id]);
$dependentsData = $dependents->fetchAll();

if (!$person)
    exit('<div class="p-3 text-danger">Personnel not found.</div>');

function col($label, $value)
{
    echo "<div class='col-md-4'><strong>$label:</strong> " . strtoupper(htmlspecialchars($value ?? '')) . "</div>";
}
?>


<style>
    .bg-navy {
        background: linear-gradient(90deg, #002B5C, #11315A);
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #fff;
    }
</style>

<div class="modal-header bg-navy text-white align-items-center">
    <h5 class="modal-title flex-grow-1">
        <?= strtoupper($type === 'Enlistment' ? 'Enlisted Personnel' : $type) ?> PROFILE -
        <?= strtoupper(htmlspecialchars($person['first_name'] . ' ' . $person['last_name'])) ?>
    </h5>
    <?php if (!empty($person['photo'])): ?>
        <img src="/uploads/photos/<?= htmlspecialchars($person['photo']) ?>" alt="Profile Photo" class="profile-photo ms-3">
    <?php endif; ?>
    <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body bg-light p-4 text-uppercase" style="max-height: 70vh; overflow-y: auto;">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">A. PERSONAL DETAILS</div>
        <div class="card-body row g-3">
            <?php col('First Name', $person['first_name']);
            col('Last Name', $person['last_name']);
            col('Middle Name', $person['middle_name']); ?>
            <?php col('Date of Birth', $person['birthday']);
            col('Place of Birth', $person['birthplace']);
            col('Gender', $person['gender']); ?>
            <?php col('Religion', $person['religion']);
            col('Ethnic Group', $person['ethnic_group']);
            col('Marital Status', $person['marital_status']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">B. CONTACT DETAILS</div>
        <div class="card-body row g-3">
            <?php col('Address', $person['address']);
            col('Email', $person['email']);
            col('Contact Number', $person['contact_number']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">C. PHYSICAL DETAILS</div>
        <div class="card-body row g-3">
            <?php col('Height', $person['height']);
            col('Weight', $person['weight']);
            col('Blood Type', $person['blood_type']); ?>
            <?php col('Eye Color', $person['eye_color']);
            col('Hair Color', $person['hair_color']);
            col('Complexion', $person['complexion']); ?>
            <?php col('Body Built', $person['body_built']);
            col('Other Markings', $person['other_markings']); ?>
            <?php col('Shoes Fit', $person['shoes_fit']);
            col('T-Shirt Size', $person['tshirt_size']);
            col('Shorts Size', $person['shorts_size']); ?>
            <?php col('Waistline', $person['waistline']);
            col('Headgear Size', $person['headgear_size']);
            col('Combat Boots Size', $person['combatboots_size']); ?>
            <?php col('SBDU Size', $person['sbdu_size']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">D. SOCIAL MEDIA ACCOUNTS</div>
        <div class="card-body">
            <?php if (count($socialMedia) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Platform</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($socialMedia as $s): ?>
                                <tr>
                                    <td><?= strtoupper(htmlspecialchars($s['platform'])) ?></td>
                                    <td><?= strtoupper(htmlspecialchars($s['account_name'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-muted">No social media accounts listed.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">E. IDENTIFICATION AND STATUS</div>
        <div class="card-body row g-3">
            <?php col('Rank', $person['rank']);
            col('Military ID', $person['militaryidenumber']);
            col('Physical Profile', $person['physical_profile']); ?>
            <?php col('Grade', $person['grade']);
            col('Rating', $person['rating']);
            col('CSC Eligibility', $person['csc_eligibility']); ?>
            <?php col('TIN', $person['tin']);
            col('PhilHealth', $person['philhealth']);
            col('Pag-IBIG', $person['pagibig']); ?>
            <?php col('Passport No.', $person['passport']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">F. MILITARY SERVICE TIMELINE</div>
        <div class="card-body row g-3">
            <?php col('Date Entered Service', $person['date_entered_mil_service']);
            col('Date Enlist/CAD', $person['date_enlist_cad']); ?>
            <?php if ($type === 'Officer')
                col('CAD Status', $person['cad_status']); ?>
            <?php col('Source of Commission', $person['source_of_commission']);
            col('Date Appointed', $person['date_appointed']);
            col('Date Enlisted', $person['date_enlisted']); ?>
            <?php col('Date Last Reenlistment', $person['date_last_reenlistment']);
            col('Date Last Promex', $person['date_last_promex']);
            col('Date Last Promotion', $person['date_last_promotion']); ?>
            <?php col('Date Optional Retirement', $person['date_optional_retirement']);
            col('Date Compulsory Retirement', $person['date_compulsory_retirement']); ?>
            <?php col('ETE', $person['ete']);
            col('Midyear', $person['midyear']);
            col('Length of Service', $person['length_of_service']); ?>
            <?php col('Authority/Effectively', $person['authority_effectively']);
            col('Years Long Pay', $person['years_long_pay']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">G. ASSIGNMENT INFORMATION</div>
        <div class="card-body row g-3">
            <?php
            col('Primary Duty', $person['present_duty_primary']);
            // Collateral Duties
            col('Collateral Duty 1', $person['present_duty_collateral1']);
            col('Collateral Duty 2', $person['present_duty_collateral2']);
            col('Collateral Duty 3', $person['present_duty_collateral3']);
            col('Collateral Duty 4', $person['present_duty_collateral4']);
            col('Collateral Duty 5', $person['present_duty_collateral5']);
            col('Collateral Duty 6', $person['present_duty_collateral6']);
            col('Position', $person['position_designation']);
            col('Losing Unit', $person['losing_unit']);
            col('Years Sea Duty', $person['sea_duty_years']);
            col('Total Field Duty', $person['field_duty_total']);

            ?>
        </div>
    </div>


    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">H. EDUCATION & TRAINING</div>
        <div class="card-body row g-3">
            <?php col('Military Course', $person['mil_career_course']);
            col('Civilian Course', $person['civilian_course']);
            col('Last PFT Result', $person['last_pft_result']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">I. REPORTING DETAILS</div>
        <div class="card-body row g-3">
            <?php col('EDRD', $person['edrd']);
            col('Date Actual Report', $person['date_actual_report']);
            col('Date Carried MR', $person['date_carried_mr']); ?>
            <?php col('Authority', $person['authority']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">J. PROMOTION & ORDERS</div>
        <div class="card-body row g-3">
            <?php if ($type === 'Officer')
                col('FOS', $person['fos']); ?>
            <?php if ($type === 'Officer')
                col('FOS Order', $person['fos_order']); ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">K. DEPENDENTS</div>
        <div class="card-body">
            <?php if (count($dependentsData) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>Birthdate</th>
                                <th>Contact Number</th>
                                <th>Relationship</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dependentsData as $d): ?>
                                <tr>
                                    <td><?= strtoupper($d['name']) ?></td>
                                    <td><?= strtoupper($d['address']) ?></td>
                                    <td><?= $d['birthdate'] ?></td>
                                    <td><?= strtoupper($d['contact_number']) ?></td>
                                    <td><?= strtoupper($d['relationship']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-muted">No dependents listed.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">L. META INFO</div>
        <div class="card-body row g-3">
            <?php col('Date Created', $person['created_at']); ?>
        </div>
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-outline-primary" onclick="window.print()">Print</button>
</div>