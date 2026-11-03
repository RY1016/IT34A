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

//Session Timeout
function checkSessionTimeout(){
    global $pdo;

    //Timeout Settings
    //10s for testing
    //1800s for 30min session time
    $timeout = 1800;

    // Check last activity
    if(isset($_SESSION['last_activity'])){

        $inactive = time() - $_SESSION['last_activity'];

        if($inactive >= $timeout){
            // End database session
            endUserSession($pdo);

            // Destroy PHP session
            session_unset();
            session_destroy();

            // Remove the session cookie
            if(ini_get('session.use_cookies')){
                $params = session_get_cookie_params();

                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }

            //Redirect
            header(
                'Location: ' .
                BASE_URL .
                '/index.php?timeout=1'
            );
            exit;
        }
    }

    // Update Last Activity
    $_SESSION['last_activity'] = time();
}

?>