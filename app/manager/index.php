<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/functions.php';

requireRole('manager');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
</head>
<body>
    <h1>Hello Manager</h1>
    <a href="../auth/signout.php">Sign-out</a>
</body>
</html>