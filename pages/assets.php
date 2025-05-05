<?php
session_start();
include("../header.php");
include("../config/database.php");
include("../api/get_asset.php");
?>
<style>
    .page-wrapper {
        margin-left: 250px;
        padding-top: 20px;
        padding-right: 20px;
        padding-left: 20px;
    }
</style>
<?php if (isset($_SESSION['message'])): ?>
    <?php
    $messageType = $_SESSION['message']['type'];
    $messageText = $_SESSION['message']['text'];
    unset($_SESSION['message']);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: "<?php echo $messageType; ?>",
                title: "<?php echo ucfirst($messageType); ?>!",
                text: "<?php echo $messageText; ?>",
            });
        });
    </script>
<?php endif; ?>

<div class="page-wrapper">
    <main class="pt-5 pb-4 px-3">
        <div class="container">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="input-group w-50">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search personnel">
                            <button id="searchButton" class="btn btn-primary">Search</button>
                        </div>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPersonnelModal">
                            Add Personnel
                        </button>
                    </div>
                    <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterPanel">
                        Show Filters
                    </button>
                    <div class="collapse" id="filterPanel">
                        <div class="card card-body mb-3">
                            <form id="filterForm" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Entry Type</label>
                                    <select class="form-select" name="entry_type">
                                        <option value="">All</option>
                                        <option value="Officer">Officer</option>
                                        <option value="Enlistment">Enlistment</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Rank</label>
                                    <input type="text" class="form-control" name="rank">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select" name="gender">
                                        <option value="">All</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Birthday (From)</label>
                                    <input type="date" class="form-control" name="birthday_from">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Birthday (To)</label>
                                    <input type="date" class="form-control" name="birthday_to">
                                </div>
                                <!-- Add more filters as needed -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="tableContainer" class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th style="width: 3%;">#</th>
                                    <th style="width: 10%;">AFPSN</th>
                                    <th style="width: 60%;">Name</th>
                                    <th style="width: 5%;">Type</th>
                                    <th style="width: 5%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php $ctr = 1; ?>
                                <?php if (!empty($assets)): ?>
                                    <?php foreach ($assets as $asset): ?>
                                        <tr>
                                            <td><?= $ctr++ ?></td>
                                            <td><?= htmlspecialchars($asset['contact_number']) ?></td>
                                            <td><?= htmlspecialchars($asset['last_name']) . ", " . htmlspecialchars($asset['first_name']) . " " . htmlspecialchars($asset['middle_name']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($asset['entry_type'] === 'Enlistment' ? 'Enlisted Personnel' : $asset['entry_type']) ?>
                                            </td>

                                            <!-- Updated Actions Column in Table -->
                                            <td class="text-center">
                                                <a href="#" class="btn btn-success btn-sm view-details"
                                                    data-id="<?= $asset['id'] ?>" data-type="<?= $asset['entry_type'] ?>">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm edit-details"
                                                    data-id="<?= $asset['id'] ?>" data-type="<?= $asset['entry_type'] ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm delete-personnel"
                                                    data-id="<?= $asset['id'] ?>" data-type="<?= $asset['entry_type'] ?>">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-muted text-center">No records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Add Personnel -->
        <div class="modal fade" id="addPersonnelModal" tabindex="-1" aria-labelledby="addPersonnelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addPersonnelModalLabel">Add New Personnel</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php include("modals/personnel_form.php"); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: View Personnel -->
        <div class="modal fade" id="personnelDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content" id="personnelDetailsContent"></div>
            </div>
        </div>

        <!-- Modal: Edit Personnel -->
        <div class="modal fade" id="editPersonnelModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content" id="editPersonnelContent"></div>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/assets.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('tableContainer').addEventListener('click', function (e) {
            const btn = e.target.closest('.view-details');
            if (!btn) return;

            e.preventDefault();

            const id = btn.getAttribute('data-id');
            const type = btn.getAttribute('data-type');

            if (!id || !type) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Data',
                    text: 'Personnel ID or Type is missing.',
                });
                return;
            }

            fetch(`modals/personnel_details.php?id=${encodeURIComponent(id)}&type=${encodeURIComponent(type)}&t=${Date.now()}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('personnelDetailsContent').innerHTML = html;
                    new bootstrap.Modal(document.getElementById('personnelDetailsModal')).show();
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Could not load personnel details.', 'error');
                });
        });
    });

</script>

<!-- JavaScript for handling Edit button -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.edit-details').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                const type = btn.getAttribute('data-type');
                const modal = new bootstrap.Modal(document.getElementById('editPersonnelModal'));

                fetch(`modals/edit_personnel_form.php?id=${id}&type=${type}`)
                    .then(res => res.text())
                    .then(html => {
                        const container = document.getElementById('editPersonnelContent');
                        container.innerHTML = html;

                        // ✅ Re-evaluate all <script> tags manually
                        const scripts = container.querySelectorAll("script");
                        scripts.forEach((oldScript) => {
                            const newScript = document.createElement("script");
                            if (oldScript.src) {
                                newScript.src = oldScript.src;
                            } else {
                                newScript.textContent = oldScript.textContent;
                            }
                            document.body.appendChild(newScript);
                            oldScript.remove();
                        });

                        modal.show();
                    });
            });
        });
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.delete-personnel').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                const type = btn.getAttribute('data-type');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the personnel record.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('../api/delete_personnel.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${id}&type=${type}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    icon: data.status,
                                    title: data.status.charAt(0).toUpperCase() + data.status.slice(1),
                                    text: data.message,
                                }).then(() => location.reload());
                            });
                    }
                });
            });
        });
    });
</script>


</body>

</html>