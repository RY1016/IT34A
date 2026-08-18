<?php
function logActivity($pdo,$user_id,$email,$action,$status='success') {
    

    try{

       //Get Clients IPAdd
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
       //String into Array
        if (strpos($ip, ',') !== false) {
            $ip = trim(explode(',', $ip)[0]);
        }

        //Gets user agent (Browser)
        $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'unknown', 0, 255);

        //Query
        $stmt = $pdo->prepare\
        ("
        INSERT INTO activity_logs (
        user_id,
        email, 
        action, 
        status, 
        ip_address, 
        user_agent
        
        ) VALUES (?, ?, ?, ?, ?, ?)"
        );

    } catch (PDOException $e) {
        error_log("activity log error: " . $e->getMessage());
        return false;
    }


}
?>