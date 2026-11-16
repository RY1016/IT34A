<?php
$password_input = "password123"; 
$db_hash = '$2y$10$tZ9.V.4e7dZlV6kK.y5P1u.zT5Wl.sK/n1X5D6l1lU9Xy5k8E4C4u';

echo "Verification check: ";
var_dump(password_verify($password_input, $db_hash));
echo "<br>String length of input: " . strlen($password_input);
?>