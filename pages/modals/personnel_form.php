<style>
    .modal-step {
        transition: opacity 0.3s ease-in-out;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
</style>
<form action="../api/create_asset.php" method="POST" id="multiStepForm" enctype="multipart/form-data">
    <div class="row mb-3 justify-content-end">
        <div class="col-md-4 text-end">
            <label for="entryType" class="form-label fw-bold">Entry Type</label>
            <select class="form-select" name="entry_type" id="entryType" required>
                <option value="" selected disabled>Select Entry Type</option>
                <option value="Officer">Officer</option>
                <option value="Enlistment">Enlistment</option>
            </select>
        </div>
    </div>
    <div class="p-3">
        <!-- Step 1 -->
        <div class="modal-step" data-step="1">
            <h6>A. Personal Details</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date of Birth</label>
                        <input type="date" class="form-control" name="birthday">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Place of Birth</label>
                        <input type="text" class="form-control" name="birthplace" required>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option selected disabled value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Prefer Not to Say">Prefer Not to Say</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Religion</label>
                        <input type="text" class="form-control" name="religion" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Ethnic Group</label>
                        <input type="text" class="form-control" name="ethnic_group" required>
                    </div>
                    <div class="col-md-4">
                        <label for="maritalstatus" class="form-label fw-bold">Marital Status</label>
                        <select class="form-select" id="maritalstatus" name="marital_status" required>
                            <option selected disabled value="">Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                </div>
            </div>
            <h6>B. Contact Details</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Present Home Address</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Email Address</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Contact Number</label>
                    <input type="text" class="form-control" name="contact_number" required>
                </div>
            </div>
            <h6>C. Physical Details</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Height(in cm)</label>
                        <input type="number" class="form-control" name="height" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Weight(in kgs)</label>
                        <input type="number" class="form-control" name="weight" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Blood Type</label>
                        <select class="form-select" name="blood_type" required>
                            <option value="" selected disabled>Select blood type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Color of Eyes</label>
                        <input type="text" class="form-control" name="eye_color" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Color of Hair</label>
                        <input type="text" class="form-control" name="hair_color" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="complexion" class="form-label fw-bold">Complexion</label>
                        <select class="form-select" id="complexion" name="complexion" required>
                            <option selected disabled value="">Select Complexion</option>
                            <option value="Fair">Fair</option>
                            <option value="Light Brown">Light Brown</option>
                            <option value="Brown">Brown</option>
                            <option value="Dark">Dark</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="bodybuilt" class="form-label fw-bold">Body Built</label>
                        <select class="form-select" id="bodybuilt" name="body_built" required>
                            <option selected disabled value="">Select Body Built</option>
                            <option value="Slim">Slim</option>
                            <option value="Medium">Medium</option>
                            <option value="Athletic">Athletic</option>
                            <option value="Heavy">Heavy</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Other Markings</label>
                        <input type="text" class="form-control" name="other_markings">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Shoes Fit</label>
                        <input type="text" class="form-control" name="shoes_fit">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">T Shirt/Jacket Size</label>
                        <input type="text" class="form-control" name="tshirt_size">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Shorts Size</label>
                        <input type="text" class="form-control" name="shorts_size">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Waist Line</label>
                        <input type="text" class="form-control" name="waistline">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Head Gear Size</label>
                        <input type="text" class="form-control" name="headgear_size">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Combat Boots Size</label>
                        <input type="text" class="form-control" name="combatboots_size">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">SBDU Size</label>
                        <input type="text" class="form-control" name="sbdu_size">
                    </div>
                </div>
            </div>
            <h6>D. Social Media Accounts</h6>
            <h6 class="text-center">D. Social Media Accounts</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="col-md-4 mb-3 mx-auto text-center">
                    <label class="form-label fw-bold w-100">Number of Accounts</label>
                    <select class="form-select text-center" id="socialMediaCount">
                        <option selected disabled value="">Select number</option>
                        <option value="1">1 Account</option>
                        <option value="2">2 Accounts</option>
                        <option value="3">3 Accounts</option>
                        <option value="4">4 Accounts</option>
                        <option value="5">5 Accounts</option>
                    </select>
                </div>

                <div id="socialMediaFields" class="row g-3 mt-2"></div>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="modal-step d-none" data-step="2">
            <h6>E. Identification and Status</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Rank</label>
                        <input type="text" class="form-control" name="rank" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Military ID Number</label>
                        <input type="text" class="form-control" name="militaryidenumber" required>
                    </div>
                    <div class="col-md-4">
                        <label for="physicalprofile" class="form-label fw-bold">Physical Profile</label>
                        <select class="form-select" id="physicalprofile" name="physical_profile" required>
                            <option selected disabled value="">Select Profile</option>
                            <option value="P1">P1</option>
                            <option value="P2">P2</option>
                            <option value="P3">P3</option>
                            <option value="P4">P4</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Grade/AFPSN/BOS</label>
                        <input type="text" class="form-control" name="grade" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Rating</label>
                        <input type="text" class="form-control" name="rating" required>
                    </div>
                    <div class="col-md-4">
                        <label for="csceligibility" class="form-label fw-bold">CSC Eligibility</label>
                        <select class="form-select" id="csceligibility" name="csc_eligibility" required>
                            <option selected disabled value="">Select CSC Eligibility</option>
                            <option value="None">None</option>
                            <option value="CSC Pro">CSC Pro</option>
                            <option value="CSC Sub-Pro">CSC Sub-Pro</option>
                            <option value="CSC Executive">CSC Executive</option>
                            <option value="Penology Officer">Penology Officer</option>
                            <option value="Fire Officer">Fire Officer</option>
                            <option value="Foreign Service Officer">Foreign Service Officer</option>
                            <option value="Bar/Board Eligibility (RA 1080)">Bar/Board Eligibility (RA 1080)</option>
                            <option value="Honor Graduate Eligibility (PD 907)">Honor Graduate Eligibility (PD 907)
                            </option>
                            <option value="Barangay Official Eligibility (RA 7160)">Barangay Official Eligibility (RA
                                7160)
                            </option>
                            <option value="Barangay Health Worker Eligibility (RA 7883)">Barangay Health Worker
                                Eligibility
                                (RA 7883)</option>
                            <option value="Barangay Nutrition Scholar Eligibility (PD 1569)">Barangay Nutrition Scholar
                                Eligibility (PD 1569)</option>
                            <option value="Sanggunian Member Eligibility (RA 10156)">Sanggunian Member Eligibility (RA
                                10156)</option>
                            <option value="Electronic Data Processing Specialist Eligibility (CSC Reso No. 90-083)">
                                Electronic Data Processing Specialist Eligibility (CSC Reso No. 90-083)</option>
                            <option value="Foreign School Honor Graduate Eligibility (CSC Reso No. 1302714)">Foreign
                                School
                                Honor Graduate Eligibility (CSC Reso No. 1302714)</option>
                            <option value="Scientific and Technological Specialist Eligibility (PD 997)">Scientific and
                                Technological Specialist Eligibility (PD 997)</option>
                            <option value="Skills Eligibility – Category II (CSC MC 11, s. 1996, as Amended)">Skills
                                Eligibility – Category II (CSC MC 11, s. 1996, as Amended)</option>
                            <option value="Veteran Preference Rating (EO 132/790)">Veteran Preference Rating (EO
                                132/790)
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">TIN Number</label>
                        <input type="text" class="form-control" name="tin" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Philhealth Number</label>
                        <input type="text" class="form-control" name="philhealth" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">PagIbig Number</label>
                        <input type="text" class="form-control" name="pagibig" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Passport Number</label>
                        <input type="text" class="form-control" name="passport" required>
                    </div>
                </div>
            </div>
            <h6>F. Military Service Timeline</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date Entered Mil Service</label>
                        <input type="date" class="form-control" name="date_entered_mil_service" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date Enlist/CAD</label>
                        <input type="date" class="form-control" name="date_enlist_cad" required>
                    </div>
                    <div class="col-md-4" id="cadStatusField">
                        <label class="form-label fw-bold">CAD Status</label>
                        <input type="text" class="form-control" name="cad_status">
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Source of Commission</label>
                        <input type="text" class="form-control" name="source_of_commission" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date Appointed</label>
                        <input type="date" class="form-control" name="date_appointed" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date Enlisted</label>
                        <input type="date" class="form-control" name="date_enlisted" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date of Last Reenlistment</label>
                        <input type="date" class="form-control" name="date_last_reenlistment" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date of Last Promex</label>
                        <input type="date" class="form-control" name="date_last_promex" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date of Last Promotion</label>
                        <input type="date" class="form-control" name="date_last_promotion" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date Optional Retirement</label>
                        <input type="date" class="form-control" name="date_optional_retirement" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date Compulsory Retirement</label>
                        <input type="date" class="form-control" name="date_compulsory_retirement" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">ETE</label>
                        <input type="text" class="form-control" name="ete" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Current ETE</label>
                        <input type="text" class="form-control" name="current_ete" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Length of Service</label>
                        <input type="text" class="form-control" name="length_of_service" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Authority/Effectively</label>
                        <input type="text" class="form-control" name="authority_effectively" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nr. of Years Long Pay</label>
                        <input type="number" class="form-control" name="years_long_pay" required>
                    </div>
                </div>
            </div>

            <h6>G. Assignment Information</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <!-- Section Title -->
                <div class="col-12 text-center">
                    <h6 class="fw-bold m-0">Present Duty Assignment</h6>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Primary</label>
                        <input type="text" class="form-control" name="present_duty_primary" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Collateral</label>
                        <input type="text" class="form-control" name="present_duty_collateral1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Collateral</label>
                        <input type="text" class="form-control" name="present_duty_collateral2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Collateral</label>
                        <input type="text" class="form-control" name="present_duty_collateral3">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Collateral</label>
                        <input type="text" class="form-control" name="present_duty_collateral4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Collateral</label>
                        <input type="text" class="form-control" name="present_duty_collateral5">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Collateral</label>
                        <input type="text" class="form-control" name="present_duty_collateral6">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Position/Designation</label>
                        <input type="text" class="form-control" name="position_designation" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Losing Unit</label>
                        <input type="text" class="form-control" name="losing_unit" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nr. of Yrs Sea Duty</label>
                        <input type="number" min="0" class="form-control" name="sea_duty_years" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Total Field Duty</label>
                        <input type="number" min="0" class="form-control" name="field_duty_total" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-step">Back</button>
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="modal-step d-none" data-step="3">
            <h6>H. Education & Training</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Mil Career Course</label>
                        <input type="text" class="form-control" name="mil_career_course">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Civilian Course</label>
                        <input type="text" class="form-control" name="civilian_course">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Last PFT Result</label>
                        <input type="text" class="form-control" name="last_pft_result">
                    </div>
                </div>
            </div>

            <h6>I. Reporting Details</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">EDRD</label>
                        <input type="date" class="form-control" name="edrd">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Date Actual Report</label>
                        <input type="date" class="form-control" name="date_actual_report">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Date Carried MR</label>
                        <input type="date" class="form-control" name="date_carried_mr">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Authority</label>
                        <input type="text" class="form-control" name="authority">
                    </div>
                </div>
            </div>

            <h6>J. Promotion & Orders</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="row">
                    <div class="col-md-6" id="fosField">
                        <label class="form-label fw-bold">FOS</label>
                        <input type="text" class="form-control" name="fos">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">FOS Order</label>
                        <input type="text" class="form-control" name="fos_order">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-step">Back</button>
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>
        </div>

        <!-- Final Step -->
        <div class="modal-step d-none" data-step="4">
            <h6>K. Dependents</h6>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div id="dependents-container" class="row g-3"></div>

                <div class="col-12 mt-3">
                    <button type="button" class="btn btn-outline-primary w-100" id="add-dependent-btn">
                        <i class="bi bi-plus-circle me-2"></i>Add Dependent
                    </button>
                </div>
            </div>
            <div class="row mb-3 border rounded shadow-sm p-3">
                <div class="col-md-12 text-center">
                    <label class="form-label fw-bold">Upload Photo</label>
                    <input type="file" class="form-control" name="photo" accept="image/*" required>
                </div>
            </div>
            <button type="button" class="btn btn-secondary prev-step">Back</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentStep = 0;
        const modal = document.getElementById('addPersonnelModal');
        const toastContainer = document.createElement("div");
        toastContainer.style.position = "fixed";
        toastContainer.style.top = "20px";
        toastContainer.style.right = "20px";
        toastContainer.style.zIndex = "1055";
        document.body.appendChild(toastContainer);

        function showStep(index) {
            const steps = modal.querySelectorAll('.modal-step');
            steps.forEach((step, i) => {
                step.classList.toggle('d-none', i !== index);
            });
            scrollToTop();
        }

        function scrollToTop() {
            const scrollTarget = modal.querySelector('.modal-body');
            if (scrollTarget) {
                scrollTarget.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function showToast(message) {
            const toast = document.createElement("div");
            toast.className = "toast align-items-center text-white bg-danger border-0 show mb-2";
            toast.setAttribute("role", "alert");
            toast.setAttribute("aria-live", "assertive");
            toast.setAttribute("aria-atomic", "true");
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            toastContainer.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        document.body.addEventListener('click', function (event) {
            const steps = modal.querySelectorAll('.modal-step');

            if (event.target.classList.contains('next-step')) {
                const currentStepEl = steps[currentStep];
                const inputs = currentStepEl.querySelectorAll('input, select, textarea');
                let allValid = true;

                inputs.forEach((input) => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                        allValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!allValid) {
                    const firstInvalid = currentStepEl.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    showToast("Please complete all required fields before proceeding.");
                    return;
                }

                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            if (event.target.classList.contains('prev-step')) {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            }
        });

        modal.addEventListener('shown.bs.modal', function () {
            currentStep = 0;
            showStep(currentStep);
        });

        // SOCIAL MEDIA DYNAMIC FIELDS
        const countSelector = document.getElementById("socialMediaCount");
        const fieldsContainer = document.getElementById("socialMediaFields");

        countSelector.addEventListener("change", function () {
            const count = parseInt(this.value, 10);
            fieldsContainer.innerHTML = "";

            for (let i = 0; i < count; i++) {
                const typeInput = `
                <div class="col-md-6">
                    <label class="form-label">Platform ${i + 1}</label>
                    <input type="text" class="form-control" name="socials[${i}][type]" placeholder="e.g. Facebook" required>
                </div>`;
                const nameInput = `
                <div class="col-md-6">
                    <label class="form-label">Account Name ${i + 1}</label>
                    <input type="text" class="form-control" name="socials[${i}][name]" placeholder="e.g. John Doe" required>
                </div>`;
                fieldsContainer.insertAdjacentHTML("beforeend", typeInput + nameInput);
            }
        });

        // DEPENDENT DYNAMIC FIELDS
        const container = document.getElementById("dependents-container");
        const addBtn = document.getElementById("add-dependent-btn");

        let dependentIndex = 0;

        addBtn.addEventListener("click", () => {
            const fieldSet = document.createElement("div");
            fieldSet.className = "row mb-3 border rounded shadow-sm gx-2 gy-1 align-items-end dependent-set";

            fieldSet.innerHTML = `
                <div class="col-md-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="dependents[${dependentIndex}][name]" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="dependents[${dependentIndex}][address]" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Birthdate</label>
                    <input type="date" class="form-control" name="dependents[${dependentIndex}][birthdate]" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="dependents[${dependentIndex}][contactnumber]" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Relationship</label>
                    <input type="text" class="form-control" name="dependents[${dependentIndex}][relationship]" required>
                </div>
                <div class="col-md-1 d-flex flex-column justify-content-end mb-1">
                    <button type="button" class="btn btn-danger w-100 align-self-center remove-dependent">
                        Remove
                    </button>
                </div>
            `;

            container.appendChild(fieldSet);
            dependentIndex++;
        });

        container.addEventListener("click", function (e) {
            if (e.target.closest(".remove-dependent")) {
                e.target.closest(".dependent-set").remove();
            }
        });

        const entryTypeSelect = document.getElementById("entryType");
        const cadStatusField = document.getElementById("cadStatusField");
        const fosField = document.getElementById("fosField");

        function updateVisibilityByEntryType() {
            const isOfficer = entryTypeSelect.value === "Officer";

            // Toggle visibility
            cadStatusField.style.display = isOfficer ? "block" : "none";
            fosField.style.display = isOfficer ? "block" : "none";

            // Clear or enforce required
            cadStatusField.querySelector('input').required = isOfficer;
            fosField.querySelector('input').required = isOfficer;
        }

        // Initial visibility
        updateVisibilityByEntryType();

        entryTypeSelect.addEventListener("change", updateVisibilityByEntryType);

    });
</script>