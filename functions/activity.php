<?php

function logActivity($pdo, $user_id, $user_email, $action, $status = 'success')
{
    try {

        // Get IP address
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        // Get browser information
        $user_agent = substr(
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            0,
            255
        );

        // SQL query
        $stmt = $pdo->prepare("
            INSERT INTO activity_logs (
                user_id,
                user_email,
                activity_log_action,
                activity_log_status,
                activity_log_ip_address,
                activity_log_user_agent
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        // Execute query
        $success = $stmt->execute([
            $user_id,
            $user_email,
            $action,
            $status,
            $ip,
            $user_agent
        ]);

        return $success;

    } catch (PDOException $e) {

        error_log("Activity log error: " . $e->getMessage());

        return false;
    }
}

?>