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
                                            <td><?= htmlspecialchars($asset['last_name']) . ", " . htmlspecialchars($asset['first_name']) . " " . htmlspecialchars($asset['middle_name']) ?></td>
                                            <td><?= htmlspecialchars($asset['entry_type']) ?></td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-success btn-sm view-details"
                                                   data-id="<?= $asset['id'] ?>" data-type="<?= $asset['entry_type'] ?>">
                                                    <i class="bi bi-eye"></i> View
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
        <div class="modal fade" id="addPersonnelModal" tabindex="-1" aria-labelledby="addPersonnelModalLabel" aria-hidden="true">
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
    </main>
</div>

<script src="../assets/js/assets.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.view-details').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                const type = btn.getAttribute('data-type');
                const modal = new bootstrap.Modal(document.getElementById('personnelDetailsModal'));
                fetch(`modals/personnel_details.php?id=${id}&type=${type}`)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('personnelDetailsContent').innerHTML = html;
                        modal.show();
                    });
            });
        });
    });
</script>
</body>
</html>
