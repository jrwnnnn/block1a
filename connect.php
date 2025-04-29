<?php

require_once __DIR__ . '/vendor/autoload.php';
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASS'] ?? '';
$name = $_ENV['DB_NAME'] ?? 'test'; 

$conn = new mysqli($host, $user, $pass, $name);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}
?>