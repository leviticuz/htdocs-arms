<?php
include("../../config/database.php");


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = $_GET['type'] ?? '';

$table = $type === 'Officer' ? 'officer_records' : 'enlistment_records';
$stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = ?");
$stmt->execute([$id]);
$personnel = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtSocials = $pdo->prepare("SELECT platform, account_name FROM personnel_socials WHERE personnel_id = ?");
$stmtSocials->execute([$personnel['id']]);
$socials = $stmtSocials->fetchAll(PDO::FETCH_ASSOC);

$stmtDeps = $pdo->prepare("SELECT * FROM personnel_dependents WHERE personnel_id = ?");
$stmtDeps->execute([$personnel['id']]);
$dependents = $stmtDeps->fetchAll(PDO::FETCH_ASSOC);


if (!$personnel) {
    exit('<p class="text-danger">Personnel not found.</p>');
}
?>



<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit Personnel</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="../api/update_personnel.php" method="POST" enctype="multipart/form-data" id="editPersonnelForm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($personnel['id']) ?>">
        <input type="text" name="entry_type" id="entryType" value="<?= htmlspecialchars($type) ?>">
        <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
            <!-- BEGIN FULL FORM -->
            <!-- A. Personal Details -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">First Name</label>
                    <input type="text" class="form-control" name="first_name"
                        value="<?= htmlspecialchars($personnel['first_name']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Middle Name</label>
                    <input type="text" class="form-control" name="middle_name"
                        value="<?= htmlspecialchars($personnel['middle_name']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Last Name</label>
                    <input type="text" class="form-control" name="last_name"
                        value="<?= htmlspecialchars($personnel['last_name']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Birthday</label>
                    <input type="date" class="form-control" name="birthday"
                        value="<?= htmlspecialchars($personnel['birthday']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Birthplace</label>
                    <input type="text" class="form-control" name="birthplace"
                        value="<?= htmlspecialchars($personnel['birthplace']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Gender</label>
                    <select class="form-select" name="gender">
                        <option <?= $personnel['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option <?= $personnel['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                        <option <?= $personnel['gender'] === 'Prefer Not to Say' ? 'selected' : '' ?>>Prefer Not to Say
                        </option>
                    </select>
                </div>
            </div>
            <!-- B. Contact Details -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Contact Number</label>
                    <input type="text" class="form-control" name="contact_number"
                        value="<?= htmlspecialchars($personnel['contact_number']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="email"
                        value="<?= htmlspecialchars($personnel['email']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" class="form-control" name="address"
                        value="<?= htmlspecialchars($personnel['address']) ?>">
                </div>
            </div>
            <!-- C. Physical Details -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Height (cm)</label>
                    <input type="text" class="form-control" name="height"
                        value="<?= htmlspecialchars($personnel['height']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Weight (kg)</label>
                    <input type="text" class="form-control" name="weight"
                        value="<?= htmlspecialchars($personnel['weight']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Blood Type</label>
                    <input type="text" class="form-control" name="blood_type"
                        value="<?= htmlspecialchars($personnel['blood_type']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Eye Color</label>
                    <input type="text" class="form-control" name="eye_color"
                        value="<?= htmlspecialchars($personnel['eye_color']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hair Color</label>
                    <input type="text" class="form-control" name="hair_color"
                        value="<?= htmlspecialchars($personnel['hair_color']) ?>">
                </div>
            </div>
            <!-- D. Social Media Accounts -->
            <h6 class="text-center">D. Social Media Accounts</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Platform <?= $i + 1 ?></label>
                        <input type="text" class="form-control" name="socials[<?= $i ?>][type]"
                            value="<?= htmlspecialchars($socials[$i]['platform'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account Name <?= $i + 1 ?></label>
                        <input type="text" class="form-control" name="socials[<?= $i ?>][name]"
                            value="<?= htmlspecialchars($socials[$i]['account_name'] ?? '') ?>">
                    </div>
                <?php endfor; ?>
            </div>



            <!-- Upload Photo -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Upload Photo</label>
                    <input type="file" class="form-control" name="photo" accept="image/*">
                </div>
            </div>
            <!-- E. Identification and Status -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Rank</label>
                    <input type="text" class="form-control" name="rank"
                        value="<?= htmlspecialchars($personnel['rank']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Military ID Number</label>
                    <input type="text" class="form-control" name="militaryidenumber"
                        value="<?= htmlspecialchars($personnel['militaryidenumber']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Physical Profile</label>
                    <input type="text" class="form-control" name="physicalprofile"
                        value="<?= htmlspecialchars($personnel['physical_profile']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Grade/AFPSN/BOS</label>
                    <input type="text" class="form-control" name="grade"
                        value="<?= htmlspecialchars($personnel['grade']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Rating</label>
                    <input type="text" class="form-control" name="rating"
                        value="<?= htmlspecialchars($personnel['rating']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">CSC Eligibility</label>
                    <input type="text" class="form-control" name="csc_eligibility"
                        value="<?= htmlspecialchars($personnel['csc_eligibility']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">TIN Number</label>
                    <input type="text" class="form-control" name="tin"
                        value="<?= htmlspecialchars($personnel['tin']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Philhealth Number</label>
                    <input type="text" class="form-control" name="philhealth"
                        value="<?= htmlspecialchars($personnel['philhealth']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">PagIbig Number</label>
                    <input type="text" class="form-control" name="pagibig"
                        value="<?= htmlspecialchars($personnel['pagibig']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Passport Number</label>
                    <input type="text" class="form-control" name="passport"
                        value="<?= htmlspecialchars($personnel['passport']) ?>">
                </div>
            </div>
            <!-- F. Military Service Timeline -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date Entered Mil Service</label>
                    <input type="date" class="form-control" name="date_entered_mil_service"
                        value="<?= htmlspecialchars($personnel['date_entered_mil_service']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date Enlist/CAD</label>
                    <input type="date" class="form-control" name="date_enlist_cad"
                        value="<?= htmlspecialchars($personnel['date_enlist_cad']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">CAD Status</label>
                    <input type="text" class="form-control" name="cad_status"
                        value="<?= htmlspecialchars($personnel['cad_status']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Source of Commission</label>
                    <input type="text" class="form-control" name="source_of_commission"
                        value="<?= htmlspecialchars($personnel['source_of_commission']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date Appointed</label>
                    <input type="date" class="form-control" name="date_appointed"
                        value="<?= htmlspecialchars($personnel['date_appointed']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date Enlisted</label>
                    <input type="date" class="form-control" name="date_enlisted"
                        value="<?= htmlspecialchars($personnel['date_enlisted']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date of Last Reenlistment</label>
                    <input type="date" class="form-control" name="date_last_reenlistment"
                        value="<?= htmlspecialchars($personnel['date_last_reenlistment']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date of Last Promex</label>
                    <input type="date" class="form-control" name="date_last_promex"
                        value="<?= htmlspecialchars($personnel['date_last_promex']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date of Last Promotion</label>
                    <input type="date" class="form-control" name="date_last_promotion"
                        value="<?= htmlspecialchars($personnel['date_last_promotion']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date Optional Retirement</label>
                    <input type="date" class="form-control" name="date_optional_retirement"
                        value="<?= htmlspecialchars($personnel['date_optional_retirement']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date Compulsary Retirement</label>
                    <input type="date" class="form-control" name="date_compulsory_retirement"
                        value="<?= htmlspecialchars($personnel['date_compulsory_retirement']) ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">ETE</label>
                    <input type="date" class="form-control" name="ete"
                        value="<?= htmlspecialchars($personnel['ete']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Midyear</label>
                    <input type="date" class="form-control" name="midyear"
                        value="<?= htmlspecialchars($personnel['midyear']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Length of Service</label>
                    <input type="text" class="form-control" name="length_of_service"
                        value="<?= htmlspecialchars($personnel['length_of_service']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Authority/Effectively</label>
                    <input type="text" class="form-control" name="authority_effectively"
                        value="<?= htmlspecialchars($personnel['authority_effectively']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Nr. of Years Long Pay</label>
                    <input type="number" class="form-control" name="years_long_pay"
                        value="<?= htmlspecialchars($personnel['years_long_pay']) ?>">
                </div>
            </div>
            <!-- G. Assignment Information -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Present Duty Primary</label>
                    <input type="text" class="form-control" name="present_duty_primary"
                        value="<?= htmlspecialchars($personnel['present_duty_primary']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Collateral Duty 1</label>
                    <input type="text" class="form-control" name="present_duty_collateral1"
                        value="<?= htmlspecialchars($personnel['present_duty_collateral1']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Collateral Duty 2</label>
                    <input type="text" class="form-control" name="present_duty_collateral2"
                        value="<?= htmlspecialchars($personnel['present_duty_collateral2']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Collateral Duty 3</label>
                    <input type="text" class="form-control" name="present_duty_collateral3"
                        value="<?= htmlspecialchars($personnel['present_duty_collateral3']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Collateral Duty 4</label>
                    <input type="text" class="form-control" name="present_duty_collateral4"
                        value="<?= htmlspecialchars($personnel['present_duty_collateral4']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Collateral Duty 5</label>
                    <input type="text" class="form-control" name="present_duty_collateral5"
                        value="<?= htmlspecialchars($personnel['present_duty_collateral5']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Collateral Duty 6</label>
                    <input type="text" class="form-control" name="present_duty_collateral6"
                        value="<?= htmlspecialchars($personnel['present_duty_collateral6']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Position/Designation</label>
                    <input type="text" class="form-control" name="position_designation"
                        value="<?= htmlspecialchars($personnel['position_designation']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Losing Unit</label>
                    <input type="text" class="form-control" name="losing_unit"
                        value="<?= htmlspecialchars($personnel['losing_unit']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nr. of Yrs Sea Duty</label>
                    <input type="number" class="form-control" name="sea_duty_years"
                        value="<?= htmlspecialchars($personnel['sea_duty_years']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Total Field Duty</label>
                    <input type="number" class="form-control" name="field_duty_total"
                        value="<?= htmlspecialchars($personnel['field_duty_total']) ?>">
                </div>
            </div>
            <!-- H. Education & Training -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Mil Career Course</label>
                    <input type="text" class="form-control" name="mil_career_course"
                        value="<?= htmlspecialchars($personnel['mil_career_course']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Civilian Course</label>
                    <input type="text" class="form-control" name="civilian_course"
                        value="<?= htmlspecialchars($personnel['civilian_course']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Last PFT Result</label>
                    <input type="text" class="form-control" name="last_pft_result"
                        value="<?= htmlspecialchars($personnel['last_pft_result']) ?>">
                </div>
            </div>
            <!-- I. Reporting Details -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label fw-bold">EDRD</label>
                    <input type="date" class="form-control" name="edrd"
                        value="<?= htmlspecialchars($personnel['edrd']) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Date Actual Report</label>
                    <input type="date" class="form-control" name="date_actual_report"
                        value="<?= htmlspecialchars($personnel['date_actual_report']) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Date Carried MR</label>
                    <input type="date" class="form-control" name="date_carried_mr"
                        value="<?= htmlspecialchars($personnel['date_carried_mr']) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Authority</label>
                    <input type="text" class="form-control" name="authority"
                        value="<?= htmlspecialchars($personnel['authority']) ?>">
                </div>
            </div>
            <!-- J. Promotion & Orders -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">FOS</label>
                    <input type="text" class="form-control" name="fos"
                        value="<?= htmlspecialchars($personnel['fos']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">FOS Order</label>
                    <input type="text" class="form-control" name="fos_order"
                        value="<?= htmlspecialchars($personnel['fos_order']) ?>">
                </div>
            </div>
            <!-- K. Dependents -->
            <h6 class="fw-bold">K. Dependents</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <?php for ($i = 0; $i < 10; $i++): ?>
                    <div class="row mb-3 gx-2 gy-1 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Full Name <?= $i + 1 ?></label>
                            <input type="text" class="form-control" name="dependents[<?= $i ?>][name]"
                                value="<?= htmlspecialchars($dependents[$i]['name'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="dependents[<?= $i ?>][address]"
                                value="<?= htmlspecialchars($dependents[$i]['address'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Birthdate</label>
                            <input type="date" class="form-control" name="dependents[<?= $i ?>][birthdate]"
                                value="<?= htmlspecialchars($dependents[$i]['birthdate'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" name="dependents[<?= $i ?>][contactnumber]"
                                value="<?= htmlspecialchars($dependents[$i]['contactnumber'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Relationship</label>
                            <input type="text" class="form-control" name="dependents[<?= $i ?>][relationship]"
                                value="<?= htmlspecialchars($dependents[$i]['relationship'] ?? '') ?>">
                        </div>
                    </div>
                <?php endfor; ?>
            </div>


            <!-- Upload Photo -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Upload Photo</label>
                    <input type="file" class="form-control" name="photo" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const data = <?= json_encode($personnel) ?>;
        for (const [key, value] of Object.entries(data)) {
            const input = document.querySelector(`#editPersonnelForm [name="${key}"]`);
            if (input) {
                if (input.type === 'date') {
                    input.value = value ? new Date(value).toISOString().split('T')[0] : '';
                } else {
                    input.value = value;
                }
            }
        }
    });
</script>