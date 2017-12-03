<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/queries.php';

session_start();

try {
    $dsn  = "mysql:dbname={$config['schema']};host={$config['host']};charset=utf8mb4";
    $conn = new PDO($dsn, $config['user'], $config['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    exit('Database Error: ' . $e->getMessage());
}

if ( isset($_SESSION['user']) )
    $user = $_SESSION['user'];
else
    $user = null;