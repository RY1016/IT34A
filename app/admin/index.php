<?php
// Step out of admin/ and app/ to reach config/
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/functions.php';

requireRole('admin');

logActivity(
    $pdo,
    $_SESSION['user_id'],
    $_SESSION['user_username'],
    'login',
    'success'
);

#Query #3 Get All Activity Logs
$stmt = $pdo->query("
    SELECT * 
    FROM activity_logs
    ORDER BY activity_log_created_at DESC
");

$activityLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello Admin</h1>
    <a href="../auth/signout.php">Sign Out</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Action</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>        
            <?php foreach ($activityLogs as $activity): ?>

                <tr>
                    <td><?= htmlspecialchars(
                        $activity['activity_log_id']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['user_id']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['user_email']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['activity_log_action']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['activity_log_status']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['activity_log_ip_address']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['activity_log_user_agent']) ?>
                    </td>
                    <td><?= htmlspecialchars(
                        $activity['activity_log_created_at']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

</body>
</html>