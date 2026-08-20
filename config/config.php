<?php
session_start();

require_once('includes/activity-logger.php');
//define('', '');

define('BASE_URL', 'http://localhost/it34a');

define('DB_HOST', 'localhost');
define('DB_NAME', 'it34a_lab_db');
define('DB_USER', 'root');
define('DB_PASS', '');      

$user_id = "root" ?? null;
$user_email = "root" ?? null;

try {

    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, 
        DB_USER, 
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        echo "Connected successfully";
        logActivity($pdo,$user_id,$user_email,'connect_db','success');

    }catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
        echo "Connection failed: " . $e->getMessage();
    } 



?>