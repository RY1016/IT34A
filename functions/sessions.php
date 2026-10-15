<?php

//Start User Session
function startUserSession($pdo){
   if (!isset($_SESSION['user_id'])) {
        return false;
    }

    $user_id = $_SESSION['user_id'];

    $session_id = session_id();

        $stmt = $pdo->prepare("
        INSERT INTO user_sessions(
            user_id, 
            session_start
        ) 
        VALUES(
        :user_id, NOW()
        )
    ");

        $stmt->execute([
            ':user_id' => $user_id,
        ]);

        return $pdo->lastInsertId();
    }

    //End User Session
    function endUserSession($pdo){

        if (!isset($_SESSION['session_id'])) {
            return false;
        }
        $session_id = $_SESSION['session_id'];

        $stmt = $pdo->prepare("
            UPDATE user_sessions
            SET 

            session_end = NOW(),
            session_duration = TIMESTAMPDIFF(
            SECOND, 
            session_start, 
            NOW()
            )

            WHERE session_id = :session_id
        ");

        $stmt->execute([
            
            ':session_id' => $session_id,
        ]);

        return true;
    }

// Function check user for active session
function hasActiveUserSession($pdo, $user_id){

    $stmt = $pdo->prepare("
        SELECT session_id
        FROM user_sessions
        WHERE user_id = :user_id
        AND session_end IS NULL
        LIMIT 1
    ");

    $stmt->execute([
        'user_id' => $user_id
    ]);

    return (bool) $stmt->fetchColumn();
}

?>