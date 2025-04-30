<?php
if (isset($_GET['password'])) {
    echo "Password: " . htmlspecialchars($_GET['password']) . "<br>";
    echo "Hash: " . password_hash($_GET['password'], PASSWORD_DEFAULT);
} else {
    echo "No password provided.";
}
?>
