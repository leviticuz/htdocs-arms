<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Enable during development
ini_set('log_errors', 1);
ini_set('error_log', '../logs/php-error.log');

session_start();
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    try {
        $stmt = $pdo->prepare("SELECT password FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            if (password_verify($password, $row["password"])) {
                $_SESSION["username"] = $username;

                echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Redirecting...</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>
                <body>
                <script>
                Swal.fire({
                    icon: "success",
                    title: "Welcome!",
                    text: "Login Successful",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "../index.php";
                });
                </script>
                </body>
                </html>';

                exit();
            } else {
                $_SESSION['error'] = "Invalid password!";
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "User not found!";
            header("Location: ../login.php");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "A server error occurred.";
        header("Location: ../login.php");
        exit();
    }
}
?>