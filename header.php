<?php
session_start();
// Page access control
$page = basename($_SERVER['PHP_SELF']);
if ($page != 'login.php' && !isset($_SESSION['username'])) {
    // If NOT logged in, and trying to access a protected page
    header("Location: ../../login.php");  // adjust path depending on your structure
    exit();
}
if ($page == 'login.php' && isset($_SESSION['username'])) {
    // If already logged in and trying to access login page
    header("Location: ../../index.php");  // adjust path depending on your structure
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'ARMS System' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bg-navy {
            background: linear-gradient(90deg, #002B5C, #11315A);
        }

        .bg-linear {
            background-color: #002B5C;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Sticky Header -->
    <header class="fixed-top bg-navy text-white py-3 shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center px-4">
            <div class="fs-4 fw-bold">NAVMETOC Human Resources Management System (HRMS)</div>
            <?php if (isset($_SESSION['username'])): ?>
                <!-- Only show if user is logged in -->
                <div class="dropdown text-end">
                    <button class="btn btn-outline-light dropdown-toggle text-uppercase fw-bold" type="button"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="../api/logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- Sidebar -->
    <?php if (basename($_SERVER['PHP_SELF']) != 'login.php'): ?>
        <nav class="bg-linear text-dark mt-2 p-2 shadow-sm"
            style="width: 250px; height: 100vh; position: fixed; top: 53px;">
            <h4 class="text-center text-white pt-2 pb-2">Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="../../index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../pages/assets.php">Assets Profile</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="duty_profile.php">Duty Profile History</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="personnel_dues.php">Personnel Dues</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="personnel_tracking.php">Personnel Tracking</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="roster.php">Roster of Troops</a></li>
            </ul>
        </nav>
    <?php endif; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>