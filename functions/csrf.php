<?php 

function generateCsrfToken(){
    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(
            random_bytes(32)
        );
    }
    return $_SESSION['csrf_token'];

}

function verifyCsrfToken($token){
    if (
        empty($_SESSION['csrf_token']) ||
        empty($token)
    ){
        return false;
    }
    return hash_equals(
        $_SESSION['csrf_token'],
        $token
    );
}


function requireCsrfToken(){
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        return;
    }

    $token = $_POST['csrf_token'] ?? '';

    if(!verifyCsrfToken($token)){
        http_response_code(403);
        die('Invalid CSRF token');
    }
}

?>