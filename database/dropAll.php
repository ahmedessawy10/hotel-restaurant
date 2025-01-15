<?php
// Database connection
$host = '127.0.0.1';
$db   = 'cafetaria';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Disable foreign key checks
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

// List of tables to truncate
$tables = [
    'category',
    'products',
    'users',
    'orders',
    'orders_items',
    'rooms',
    'room_booking'
];

// Truncate each table
foreach ($tables as $table) {
    try {
        $pdo->exec("TRUNCATE TABLE $table");
        echo "Table $table truncated successfully.<br>";
    } catch (PDOException $e) {
        echo "Error truncating table $table: " . $e->getMessage() . "<br>";
    }
}

// Re-enable foreign key checks
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

echo "All tables truncated successfully!";
