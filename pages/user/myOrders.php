<?php
require_once "../../database/db.php";
session_start();
// error_reporting(0);
$pageTitle = "Home";
$styles = ["orders.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";


$query = "SELECT orders.*,products.*,orders_items.* FROM orders , orders_items , products WHERE orders.id = orders_items.order_id AND orders_items.product_id = products.id  AND orders.order_by = :user_id ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute(
    [
        'user_id' => $_SESSION['user']['id']
    ]
);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>My Orders</h1>
<table>
    <thead>
        <tr>
            <th>Order Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo date("Y/m/d h:i A", strtotime($order['created_at'])); ?></td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
                <td><?php echo htmlspecialchars($order['total']); ?> EGP</td>
                <td>
                    <?php if (!empty($order['action'])): ?>
                        <span class="actions"><?php echo htmlspecialchars($order['action']); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include "../../includes/footer.php";  ?>