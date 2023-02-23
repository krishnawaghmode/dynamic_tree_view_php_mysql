<?php
//Date time
date_default_timezone_set("Asia/Kolkata");
$current_date = date("Y-m-d h:i:s", time());

$user = "root"; //username
$pass = ""; //password
$database_name = "krishna"; //Database Name

$dsn = "mysql:host=localhost;dbname=" . $database_name;

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting. " . $e->getMessage());
}
?>
