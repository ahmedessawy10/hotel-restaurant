<?php
session_start();
error_reporting(0);
require_once "../../database/db.php";

if (isset($_SESSION['user']) && count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}
$pageTitle = "Home";
$styles = ["../../assets/css/home.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";
?>


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

<div class="container my-4">
    <div class="row">
        <aside class="col-lg-3 mb-4">
            <div class="bg-light p-3 rounded">
                <h5>Search</h5>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="search" class="form-control" placeholder="Search...">
                </div>
                <h5>Categories</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none">Hot Drinks</a></li>
                    <li><a href="#" class="text-decoration-none">Cold Drinks</a></li>
                    <li><a href="#" class="text-decoration-none">Food</a></li>
                    <li><a href="#" class="text-decoration-none">Cheese</a></li>
                </ul>
            </div>
        </aside>

        <main class="col-lg-6 mb-4">
            <h4 class="mb-3">Menu</h4>
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
            </div>
        </main>

        <aside class="col-lg-3 mb-4">
            <div class="bg-light p-3 rounded sticky-top">
                <h5>Cart</h5>
                <ul id="cart-items" class="list-unstyled">
                    <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                        <li><?php echo htmlspecialchars($cartItem['name']); ?> - $<?php echo htmlspecialchars($cartItem['price']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn btn-success w-100">Checkout</button>
            </div>
        </aside>
    </div>
</div>
<?php include "../../includes/footer.php";  ?>