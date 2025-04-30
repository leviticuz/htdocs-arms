<?php
session_start();
include("header.php");
require_once __DIR__ . '/config/database.php';

try {
    $total = $pdo->query("SELECT COUNT(*) AS total FROM officer_records")->fetch()['total'];
    $officers = $pdo->query("SELECT COUNT(*) AS total FROM officer_records")->fetch()['total'];
    $enlistments = $pdo->query("SELECT COUNT(*) AS total FROM enlistment_records")->fetch()['total'];
} catch (PDOException $e) {
    $total = $officers = $enlistments = "Error";
    error_log("Failed to fetch counts: " . $e->getMessage());
}
?>

<style>
    .page-wrapper {
        margin-left: 250px;
        padding-top: 50px;
        padding-right: 20px;
        padding-left: 20px;
    }
</style>

<div class="page-wrapper">
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white p-3">
                <h4>Total Officers</h4>
                <p><?= htmlspecialchars($officers) ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h4>Total Enlistments</h4>
                <p><?= htmlspecialchars($enlistments) ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white p-3">
                <h4>Overall Personnel</h4>
                <p><?= htmlspecialchars($officers + $enlistments) ?></p>
            </div>
        </div>
    </div>

    <h3 class="mt-4">Recent Activity</h3>
    <ul class="list-group">
        <li class="list-group-item">User John logged in.</li>
        <li class="list-group-item">Admin updated settings.</li>
        <li class="list-group-item">New user registration: Jane Doe.</li>
    </ul>
</div>
