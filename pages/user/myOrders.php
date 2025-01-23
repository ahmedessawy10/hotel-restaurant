<?php
session_start();
require_once "../../database/db.php";

if (!isset($_SESSION['user']) || count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

$pageTitle = "myorders";
$styles = ["orders.css"];
$scripts = [""];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

// Get date inputs
$from = isset($_GET['from']) ? $_GET['from'] : null;
$to = isset($_GET['to']) ? $_GET['to'] : null;

// Validate date format (if provided)
if ($from && !DateTime::createFromFormat('Y-m-d', $from)) {
    die("Invalid 'from' date format.");
}
if ($to && !DateTime::createFromFormat('Y-m-d', $to)) {
    die("Invalid 'to' date format.");
}

// Build the SQL query dynamically
$query = "SELECT orders.*, users.name AS name, users.email AS email, users.image AS image
          FROM orders 
          INNER JOIN users ON users.id = orders.order_by ";

$params = [];

// Add date filter only if both `from` and `to` are provided
if ($from && $to) {
    $query .= " WHERE orders.created_at BETWEEN :from AND :to AND orders.order_by = :user_id";
    $params['from'] = $from;
    $params['to'] = $to;
    $params['user_id'] = $_SESSION['user']['id'];
} else {
    $query .= " WHERE  orders.order_by = :user_id";
    $params['user_id'] = $_SESSION['user']['id'];
}

$query .= " ORDER BY orders.created_at DESC";

// Fetch orders from the database
try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<div class="container my-4">
    <div class="row">
        <form action="" method="GET">
            <div class="row g-3 align-items-end mb-4">
                <div class="col-12 col-md-4">
                    <label for="from" class="form-label">From</label>
                    <input id="from" name="from" type="date" class="form-control" value="<?php echo $from; ?>" />
                </div>
                <div class="col-12 col-md-4">
                    <label for="to" class="form-label">To</label>
                    <input id="to" name="to" type="date" class="form-control" value="<?php echo $to; ?>" />
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center">
                    <button type="submit" class="btn w-100 py-2" style="color: #fff;
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
                            <th scope="col">Order ID</th>
                            <th scope="col">Room No.</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($orders)) {
                            foreach ($orders as $order) {
                                echo "<tr>
                                    <th scope='row'>#" . htmlspecialchars($order['id']) . "</th>
                                    <td>" . htmlspecialchars($order['room_id']) . "</td>
                                    <td>$" . htmlspecialchars($order['total']) . "</td>
                                    <td><span class='badge bg-" . ($order['status'] == 'completed' ? 'success' : 'warning') . "'>" . htmlspecialchars($order['status']) . "</span></td>
                                    <td>" . htmlspecialchars($order['created_at']) . "</td>
                                    <td>
                                        <button class='btn btn-sm btn-outline-primary' type='button' data-bs-toggle='collapse' data-bs-target='#orderItems-" . $order['id'] . "' aria-expanded='false' aria-controls='orderItems-" . $order['id'] . "'>
                                            View Items
                                        </button>
                                    </td>
                                </tr>";

                                // Fetch order items
                                $query = "SELECT orders_items.price AS price, orders_items.quantity AS quantity, products.image AS image, products.name AS name 
                                          FROM orders_items 
                                          INNER JOIN products ON orders_items.product_id = products.id 
                                          WHERE orders_items.order_id = :order_id";
                                $stmt = $conn->prepare($query);
                                $stmt->execute(['order_id' => $order['id']]);
                                $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                echo "<tr class='collapse' id='orderItems-" . $order['id'] . "'>
                                    <td colspan='6'>
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
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No orders found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>