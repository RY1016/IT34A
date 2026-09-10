<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/functions.php';

$login = 'admin';
$pass = 'admin123';

if (loginUser($pdo, $login, $pass)) {
    echo "<h2 style='color:green;'>SUCCESS: Login logic works!</h2>";
    echo "Session Role: " . $_SESSION['user_role'];
} else {
    echo "<h2 style='color:red;'>FAILED: Login credentials rejected.</h2>";
}
?>  