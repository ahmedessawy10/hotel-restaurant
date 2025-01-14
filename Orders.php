<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $products = $_POST['products']; // Array of products with 'name', 'quantity', 'price'

    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Calculate total amount
        $total_amount = 0;
        foreach ($products as $product) {
            $total_amount += $product['quantity'] * $product['price'];
        }

        // Insert into orders table
        $orderSql = "INSERT INTO orders (user_id, total_amount) VALUES (:user_id, :total_amount)";
        $orderStmt = $pdo->prepare($orderSql);
        $orderStmt->execute(['user_id' => $user_id, 'total_amount' => $total_amount]);

        // Get the last inserted order ID
        $order_id = $pdo->lastInsertId();

        // here we will put every detail about order 
        $detailSql = "INSERT INTO order_details (order_id, product_name, quantity, price) VALUES (:order_id, :product_name, :quantity, :price)";
        $detailStmt = $pdo->prepare($detailSql);

        foreach ($products as $product) {
            $detailStmt->execute([
                'order_id' => $order_id,
                'product_name' => $product['name'],
                'quantity' => $product['quantity'],
                'price' => $product['price']
            ]);
        }

        // Commit transaction
        $pdo->commit();
        echo "Order placed successfully.";
    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Failed to place order: " . $e->getMessage();
    }
}
?>
