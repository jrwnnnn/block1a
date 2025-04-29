<?php

$autoloader = __DIR__ . '/vendor/autoload.php';
$dotenvPath = __DIR__;
$dotenvFile = $dotenvPath . '/.env';

if (file_exists($autoloader)) {
    require_once $autoloader;
    if (class_exists(Dotenv\Dotenv::class) && file_exists($dotenvFile)) {
        try {
            $dotenv = Dotenv\Dotenv::createImmutable($dotenvPath);
            $dotenv->load();
        } catch (\Throwable $e) {
        }
    }
}

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$name = getenv('DB_NAME') ?: 'test';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($host, $user, $pass, $name);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}
?>
?>