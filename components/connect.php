<?php

$db_name = 'mysql:host=localhost;dbname=blog_db;charset=utf8mb4';
$user_name = 'Paul';
$user_password = 'Boluwatife19';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
   $conn = new PDO($db_name, $user_name, $user_password, $options);
   
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



?>
