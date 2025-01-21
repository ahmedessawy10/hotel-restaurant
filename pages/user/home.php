<?php
session_start();
// error_reporting(0);
require_once "../../database/db.php";

if (!isset($_SESSION['user']) || count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

$pageTitle = "Home";
$styles = ["home.css"];
$scripts = ["users/home.js"];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";
?>

<<<<<<< HEAD

<?php
session_start();
error_reporting(0);
require_once "../../database/db.php";

if (isset($_SESSION['user']) && count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    $_SESSION['cart'][] = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice
    ];
}

try {
    $stmt = $conn->query("SELECT * FROM products");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

=======
>>>>>>> 98a866243b62380493983f97739b1472731dbf21
<div class="container my-4">
    <div class="row">
        <aside class="col-lg-3 mb-4">
            <div class="bg-light p-3 rounded">
                <h5>Search</h5>
                <form id="searchForm" method="get" onsubmit="getproductsbysearch(); return false;">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..." id="search">
                        <button type="submit" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <h5>Categories</h5>
                <ul class="list-unstyled d-flex flex-column align-items-center" id="categoryList"></ul>
            </div>
        </aside>

        <main class="col-lg-6 mb-4 order-2 order-lg-0">
            <h4 class="mb-3">Menu</h4>
<<<<<<< HEAD
            <div class="row g-4">
                <!-- Menu Items -->
                <?php foreach ($menuItems as $item): ?>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="card-body text-center">
                            <h6 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h6>
                            <p class="card-text">$<?php echo htmlspecialchars($item['price']); ?></p>
                            <form method="POST" action="">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['t1']); ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($item['name']); ?>">
                                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($item['price']); ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Choose</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
=======
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === "admin") { ?>
                <label for="user">user</label>
                <select name="user" id="user" class="form-control my-2">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'user'");
                    $stmt->execute();
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($users as $usr) {
                        echo "<option value='" . $usr['id'] . "'>" . $usr['name'] . " </option>";
                    } ?>
                </select>
            <?php } ?>
            <label for="room">room</label>
            <select name="room" id="room" class="form-control my-2">
                <?php

                // if ($_SESSION['user']['role'] === "admin") {
                $stmt = $conn->prepare("SELECT * FROM rooms");
                // } else {
                //     $stmt = $conn->prepare("SELECT * FROM rooms,room_booking WHERE room_booking.id = rooms.room_id AND room_booking.user_id = :uid ORDER BY check_in DESC LIMIT 1");
                //     $stmt->bindParam(':uid', $_SESSION['user']['id'], PDO::PARAM_INT);
                // }
                $stmt->execute();
                $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rooms as $room) {
                    echo "<option value='" . $room['room_id'] . "'>" . $room['room_name'] . " </option>";
                } ?>
            </select>

            <div class="row g-4" id="productsList">
                <!-- Menu Items will be loaded here -->
>>>>>>> 98a866243b62380493983f97739b1472731dbf21
            </div>
        </main>

        <aside class="col-lg-3 mb-4 order-1 order-lg-0">
            <div class="bg-light p-3 rounded sticky-top">
                <h5>Cart</h5>
<<<<<<< HEAD
                <ul id="cart-items" class="list-unstyled">
                    <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                        <li><?php echo htmlspecialchars($cartItem['name']); ?> - $<?php echo htmlspecialchars($cartItem['price']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn btn-success w-100">Checkout</button>
=======
                <div id="cartlist" class="w-100"></div>
                <div class="d-flex justify-content-between py-3">
                    <span>Total:</span>
                    <span><span id="cartTotal">0</span> EGY</span>
                </div>
                <button class="btn btn-success w-100" onclick="sendToSave()">Checkout</button>
>>>>>>> 98a866243b62380493983f97739b1472731dbf21
            </div>
        </aside>
    </div>
</div>
<<<<<<< HEAD
<?php include "../../includes/footer.php";  ?>
=======

<?php include "../../includes/footer.php"; ?>
>>>>>>> 98a866243b62380493983f97739b1472731dbf21
