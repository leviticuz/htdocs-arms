<?php
$plain_password = trim('navmetoc-01-2025!@#');  // make sure manually typed
$hashed_password = '$2y$10$MuAGULbASJ3sDnio42Ow7Om.OSvqwxnBjVmI7H6XN/92gG7CFlmUu';

if (password_verify($plain_password, $hashed_password)) {
    echo "Password matches!";
} else {
    echo "Password does not match!";
}
?>
