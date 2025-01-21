<?php
session_start();
require_once "../../database/db.php";

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('location:../logout.php');
    exit;
}

$user = $_SESSION['user'];

try {
    // Read the raw input from the request body
    $jsonData = file_get_contents('php://input');

    // Decode the JSON data into an associative array
    $data = json_decode($jsonData, true);

    // Check if the cart data is present
    if (isset($data['cart'])) {
        $cart = $data['cart']; // Cart data
        $userId = $user['id']; // Default to the logged-in user's ID

        // If the user is an admin and a specific user is provided, use that user's ID
        if (isset($data['user']) && !empty($data['user']) && $user['role'] === "admin") {
            $userId = intval($data['user']);
        }

        // Validate room selection
        if (!isset($data['room']) || empty($data['room'])) {
            echo json_encode(['error' => 'Failed to place order, please select a room']);
            exit;
        }

        $roomId = intval($data['room']);

        // Calculate the total order amount
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $status = "processing";
        $query = "INSERT INTO orders (order_by, room_id, status, total) VALUES (:user_id, :room_id, :status, :total)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':room_id', $roomId, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $orderId = $conn->lastInsertId();
            foreach ($cart as $item) {
                $query = "INSERT INTO orders_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                $addproducts = $conn->prepare($query);
                $addproducts->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $addproducts->bindParam(':product_id', $item['id'], PDO::PARAM_INT);
                $addproducts->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
                $addproducts->bindParam(':price', $item['price'], PDO::PARAM_STR);
                $addproducts->execute();
            }

            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['error' => 'Failed to place order']);
            exit;
        }
    } else {
        echo json_encode(['error' => 'Cart data is missing']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
