<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/functions.php';

$login = 'admin';
$pass = 'admin123';

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_username = :login OR user_email = :login");
$stmt->execute([':login' => $login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<h3 style='color:red;'>1. Database Error: User 'admin' was NOT found in the database.</h3>";
} else {
    echo "<h3 style='color:blue;'>1. User found in DB.</h3>";
    echo "Stored hash in DB: <code>[" . $user['user_password'] . "]</code><br>";

    if (password_verify($pass, $user['user_password'])) {
        echo "<h2 style='color:green;'>2. SUCCESS: password_verify() matched!</h2>";
    } else {
        echo "<h2 style='color:red;'>2. FAILED: password_verify() rejected the password. Check if there are extra spaces in your hash.</h2>";
    }
}
?>