<?php
session_start();
$pageTitle = 'ARMS Login';
include("header.php");

// Check if error message exists
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);  // Clear after showing once
}

if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Logged Out',
        text: 'You have been successfully logged out.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
    </script>";
}
?>


<main class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light">

    <!-- Login Card -->
    <div class="card shadow-lg p-4" style="width: 350px;">
        <h2 class="text-center">Login</h2>

        <?php if (isset($error)): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: '<?= htmlspecialchars($error) ?>',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <form action="api/confirm.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for components like modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</main>
</body>

</html>