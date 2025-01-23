<?php
session_start();
require_once "../../database/db.php";

if (!isset($_SESSION['user']) || count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

$pageTitle = "checks";
$styles = ["orders.css"];
$scripts = [""];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

// Get filter inputs
$from = isset($_GET['from']) ? $_GET['from'] : null;
$to = isset($_GET['to']) ? $_GET['to'] : null;
$user = isset($_GET['user']) ? $_GET['user'] : null;

// Validate date format (if provided)
if ($from && !DateTime::createFromFormat('Y-m-d', $from)) {
    die("Invalid 'from' date format.");
}
if ($to && !DateTime::createFromFormat('Y-m-d', $to)) {
    die("Invalid 'to' date format.");
}

// Build the SQL query dynamically
$query = "SELECT SUM(orders.total) AS total, users.name AS name, users.email AS email, users.image AS image, users.id AS user_id
          FROM users
          INNER JOIN orders ON users.id = orders.order_by";

$params = [];
$conditions = [];

// Add date filter if provided
if ($from && $to) {
    $conditions[] = "orders.created_at BETWEEN :from AND :to";
    $params['from'] = $from;
    $params['to'] = $to;
} elseif ($from) {
    $conditions[] = "orders.created_at >= :from";
    $params['from'] = $from;
} elseif ($to) {
    $conditions[] = "orders.created_at <= :to";
    $params['to'] = $to;
}

// Add user filter if provided
if ($user) {
    $conditions[] = "orders.order_by = :user";
    $params['user'] = $user;
}

// Combine conditions
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query .= " GROUP BY users.id ORDER BY users.name ASC";

// Fetch user orders from the database
try {
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $user_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Fetch users for the dropdown
try {
    $q = "SELECT id, name FROM users WHERE role = 'user'";
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<div class="container my-4">
    <div class="row">
        <form action="" method="GET">
            <div class="row g-3 align-items-end mb-4">
                <div class="col-12 col-md-3">
                    <label for="from" class="form-label">From</label>
                    <input id="from" name="from" type="date" class="form-control" value="<?php echo $from; ?>" />
                </div>
                <div class="col-12 col-md-3">
                    <label for="to" class="form-label">To</label>
                    <input id="to" name="to" type="date" class="form-control" value="<?php echo $to; ?>" />
                </div>
                <div class="col-12 col-md-3">
                    <label for="user" class="form-label">User</label>
                    <select id="user" name="user" class="form-control">
                        <option value="">All</option>
                        <?php
                        foreach ($users as $userOption) {
                            $selected = ($user == $userOption['id']) ? 'selected' : '';
                            echo "<option value='" . $userOption['id'] . "' $selected>" . $userOption['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary w-100 py-2" style="color: #fff;
    background-color: rgb(214, 195, 169);
    border: none;">Filter</button>
                </div>
            </div>
        </form>

        <main class="col-12">
            <h4 class="mb-4">Orders</h4>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($user_orders)) {
                            foreach ($user_orders as $user_order) {
                                echo "<tr>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <img src='../../" . htmlspecialchars($user_order['image']) . "' alt='User Image' class='rounded-circle me-3' style='width: 45px; height: 45px; object-fit: cover;'>
                                            <div>
                                                <p class='mb-0 fw-bold'>" . htmlspecialchars($user_order['name']) . "</p>
                                                <p class='mb-0 text-muted'>" . htmlspecialchars($user_order['email']) . "</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$" . htmlspecialchars($user_order['total']) . "</td>
                                    <td>
                                        <button class='btn btn-sm btn-outline-primary' type='button' data-bs-toggle='collapse' data-bs-target='#orderItems-" . $user_order['user_id'] . "' aria-expanded='false' aria-controls='orderItems-" . $user_order['user_id'] . "'>
                                            View Orders
                                        </button>
                                    </td>
                                </tr>";

                                // Fetch orders for the user
                                $query = "SELECT id, room_id AS room, total, created_at AS date 
                                          FROM orders 
                                          WHERE order_by = :user_id";
                                $stmt = $conn->prepare($query);
                                $stmt->execute(['user_id' => $user_order['user_id']]);
                                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                echo "<tr class='collapse' id='orderItems-" . $user_order['user_id'] . "'>
                                    <td colspan='3'>
                                        <div class='table-responsive'>
                                            <table class='table table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Room No.</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                        <th>Items</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                foreach ($orders as $order) {
                                    echo "<tr>
                                        <td>" . htmlspecialchars($order['id']) . "</td>
                                        <td>" . htmlspecialchars($order['room']) . "</td>
                                        <td>$" . htmlspecialchars($order['total']) . "</td>
                                        <td>" . htmlspecialchars($order['date']) . "</td>
                                        <td>
                                            <button class='btn btn-sm btn-outline-secondary' type='button' data-bs-toggle='collapse' data-bs-target='#orderDetails-" . $order['id'] . "' aria-expanded='false' aria-controls='orderDetails-" . $order['id'] . "'>
                                                View Items
                                            </button>
                                        </td>
                                    </tr>";

                                    // Fetch order items
                                    $query = "SELECT orders_items.price, orders_items.quantity, products.name, products.image 
                                              FROM orders_items 
                                              INNER JOIN products ON orders_items.product_id = products.id 
                                              WHERE orders_items.order_id = :order_id";
                                    $stmt = $conn->prepare($query);
                                    $stmt->execute(['order_id' => $order['id']]);
                                    $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    echo "<tr class='collapse' id='orderDetails-" . $order['id'] . "'>
                                        <td colspan='5'>
                                            <div class='row g-3'>";
                                    foreach ($order_items as $item) {
                                        echo "<div class='col-md-4'>
                                            <div class='card mb-3'>
                                                <div class='row g-0'>
                                                    <div class='col-md-4'>
                                                        <img src='../../" . htmlspecialchars($item['image']) . "' class='img-fluid rounded-start' alt='" . htmlspecialchars($item['name']) . "' style='width: 100px; height: 100px; object-fit: cover;'>
                                                    </div>
                                                    <div class='col-md-8'>
                                                        <div class='card-body'>
                                                            <h6 class='card-title'>" . htmlspecialchars($item['name']) . "</h6>
                                                            <p class='card-text'>$" . htmlspecialchars($item['price']) . "</p>
                                                            <p class='card-text'>Qty: " . htmlspecialchars($item['quantity']) . "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    echo "</div>
                                        </td>
                                    </tr>";
                                }
                                echo "</tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>No orders found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>