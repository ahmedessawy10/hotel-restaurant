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

// Function to generate random date
function randomDate($startDate, $endDate)
{
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
    return date('Y-m-d H:i:s', $randomTimestamp);
}

// Seed users table
$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, phone, image) VALUES (?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 10; $i++) {
    $name = "User" . ($i + 1);
    $email = "user" . ($i + 1) . "@example.com";
    $password = md5("123");
    $role = ($i % 2 == 0) ? 'user' : 'admin';
    $phone = "010" . rand(10000000, 99999999);
    $image = "assets/images/upload/products" . rand(1000000000, 9999999999) . ".jpg";
    $stmt->execute([$name, $email, $password, $role, $phone, $image]);
}

// Seed category table
$stmt = $pdo->prepare("INSERT INTO category (name, created_at, update_at) VALUES (?, ?, ?)");
$cate = ["Burger", "Hot Drink", "Cold Drink", "Ice Cream", "Soup", "Main Dash"];
for ($i = 0; $i < 6; $i++) {
    $name = $cate[$i];
    $created_at = randomDate('2024-01-01', '2024-12-31');
    $update_at = randomDate($created_at, '2024-12-31');
    $stmt->execute([$cate[$i], $created_at, $update_at]);
}

// Seed rooms table
$stmt = $pdo->prepare("INSERT INTO rooms (room_name, floor, bed_number) VALUES (?, ?, ?)");
for ($i = 0; $i < 10; $i++) {
    $room_name = "Room" . ($i + 1);
    $floor = rand(1, 5);
    $bed_number = rand(1, 4);
    $stmt->execute([$room_name, $floor, $bed_number]);
}

// Seed products table
$stmt = $pdo->prepare("INSERT INTO products (name, price, image, category_id, available, create_at, update_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 20; $i++) {
    $name = "Product" . ($i + 1);
    $price = rand(10, 100);
    $image = "assets/images/products/" . rand(1000000000, 9999999999) . ".jpg";
    $category_id = rand(1, 5);
    $available = rand(0, 1);
    $create_at = randomDate('2024-01-01', '2024-12-31');
    $update_at = randomDate($create_at, '2024-12-31');
    $stmt->execute([$name, $price, $image, $category_id, $available, $create_at, $update_at]);
}

// Seed orders table
$stmt = $pdo->prepare("INSERT INTO orders (order_by, room_id, notes, status, total, created_at) VALUES (?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 15; $i++) {
    $order_by = rand(1, 10);
    $room_id = rand(1, 10);
    $notes = "Order notes " . ($i + 1);
    $status = ['processing', 'out for delivery', 'done'][rand(0, 2)];
    $total = rand(50, 500);
    $created_at = randomDate('2024-01-01', '2024-12-31');
    $stmt->execute([$order_by, $room_id, $notes, $status, $total, $created_at]);
}

// Seed orders_items table
$stmt = $pdo->prepare("INSERT INTO orders_items (product_id, order_id, price, quantity) VALUES (?, ?, ?, ?)");
$usedCombinations = []; // Track used combinations of product_id and order_id
for ($i = 0; $i < 30; $i++) {
    do {
        $product_id = rand(1, 20);
        $order_id = rand(1, 15);
        $combination = "$product_id-$order_id";
    } while (isset($usedCombinations[$combination])); // Ensure the combination is unique

    $usedCombinations[$combination] = true; // Mark this combination as used
    $price = rand(10, 100);
    $quantity = rand(1, 5);
    $stmt->execute([$product_id, $order_id, $price, $quantity]);
}

// Seed room_booking table
$stmt = $pdo->prepare("INSERT INTO room_booking (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)");
for ($i = 0; $i < 10; $i++) {
    $user_id = rand(1, 10);
    $room_id = rand(1, 10);
    $check_in = randomDate('2024-01-01', '2024-12-31');
    $check_out = randomDate($check_in, '2024-12-31');
    $stmt->execute([$user_id, $room_id, $check_in, $check_out]);
}

echo "Seeders executed successfully!";
