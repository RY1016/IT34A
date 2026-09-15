<?php
require __DIR__ . '/config/config.php';
require __DIR__ . '/config/functions.php';




// Ensure session_start(); is called (here or in config.php)
if(isset($_SESSION['user_id'])){
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    
    
    if ($login==='' || $password==='') {
        $error = 'Invalid login credentials';
        logActivity(
            $pdo, 
            $login, 
            'login',
            'failed',
        );

    } else {
        if(loginUser($pdo, $login, $password)){
        
            logActivity(
                $pdo, 
                $_SESSION['user_id'], 
                $_SESSION['user_username'], 
                'login', 
                'success'
            );

            header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
            exit;
        }
    }

    if (loginUser($pdo, $login, $password)){
        header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
        exit;
    }
 
    $error = 'Invalid login credentials';

    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
            <?php if ($error): ?>
                <p><?= htmlspecialchars($error)?></p>
            <?php endif; ?>
                
        <h1>User Login</h1>
            <form method="POST">
            <label>User or email</label>
            <input type="text"
                    name="login"
                    required
            >

                <br>
                <label>Password</label>
                <input type="password"
                        name="password"
                        required
                >

            <br>
            <button type="submit"> Sign-In</button>
            </form>
    </body>
</html>