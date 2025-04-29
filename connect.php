<?php

$autoloader = __DIR__ . '/vendor/autoload.php';
$dotenvPath = __DIR__;
$dotenvFile = $dotenvPath . '/.env';

if (file_exists($autoloader)) {
    require_once $autoloader;

    if (file_exists($dotenvFile)) {
        $dotenv = Dotenv\Dotenv::createImmutable($dotenvPath);
        $dotenv->load();
    } else {
        die(json_encode(['error' => '.env file not found']));
    }
}

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

$conn = new mysqli($host, $user, $pass, $name);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}
