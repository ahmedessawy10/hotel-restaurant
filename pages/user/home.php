<?php
session_start();
error_reporting(0);
require_once "../../database/db.php";

if (isset($_SESSION['user']) && count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

$pageTitle = "products";
$styles = ["product.css"];
$scripts = ["product.js"];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";


// Fetch products from the database
try {
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $stmt = $conn->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching products: " . $e->getMessage());
}
?>

    <main class="container mt-5">
        <h2 class="add-title txt-color mb-4">Product Management</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add Product
        </button>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="productTable">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category ID</th>
                        <th>Available</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td>$<?= htmlspecialchars($product['price']) ?></td>
                            <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="50"></td>
                            <td><?= htmlspecialchars($product['category_id']) ?></td>
                            <td><?= htmlspecialchars($product['available']) ?></td>
                            <td><?= htmlspecialchars($product['created_at']) ?></td>
                            <td><?= htmlspecialchars($product['updated_at']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $product['id'] ?>">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $product['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title txt-color" id="addProductModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" action="../../controller/product.php?action=add" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice">Price</label>
                                <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter price" required>
                            </div>
                            <div class="mb-3">
                                <label for="productCategory">Category</label>
                                <select class="form-control" id="productCategory" name="category_id" required>
                                    <option value="">Select category</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productPicture">Product Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="productPicture" name="image" required>
                                    <label class="custom-file-label" for="productPicture">Choose file</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" form="addProductForm">Reset</button>
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include "../../includes/footer.php";  ?>