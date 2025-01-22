<?php
session_start();
error_reporting(0);
require_once "../../database/db.php";

if (!isset($_SESSION['user']) || count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}


$pageTitle = "Products";
$styles = ["product.css"];
$scripts = ["product.js"];
$cdnCss = ["//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css"];
$cdnJs = ["//cdn.datatables.net/2.2.1/js/dataTables.min.js"];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";
?>

<div class="container mt-5 " style="min-height:60vh">
    <h2 class="add-title txt-color mb-4">Products</h2>
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
                    <th>Category</th>
                    <th>Available</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $query = "SELECT products.id as product_id, products.name as product_name, products.price as price, products.image as image, products.available, products.create_at, products.update_at , category.name as cat_name
                              FROM products 
                              INNER JOIN category ON products.category_id = category.id ";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product) {
                        echo "<tr>
                            <td>" . htmlspecialchars($product['product_id']) . "</td>
                            <td>" . htmlspecialchars($product['product_name']) . "</td>
                            <td>$" . htmlspecialchars($product['price']) . "</td>
                            <td><img src='../../" . htmlspecialchars($product['image']) . "' alt='Product Image' style='width: 50px; height: 50px;'></td>
                            <td>" . htmlspecialchars($product['cat_name']) . "</td>
                            <td>" . ($product['available'] ? 'Yes' : 'No') . "</td>
                            <td>" . htmlspecialchars($product['create_at']) . "</td>
                            <td>" . htmlspecialchars($product['update_at']) . "</td>
                            <td>
                                <button class='btn btn-sm btn-warning edit-product' data-id='" . $product['product_id'] . "'>Edit</button>
                                <button class='btn btn-sm btn-danger delete-product' data-id='" . $product['product_id'] . "'>Delete</button>
                            </td>
                        </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='9' class='text-center'>Error fetching products: " . $e->getMessage() . "</td></tr>";
                }
                ?>
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
                    <form id="addProductForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="productCategory">Category</label>
                            <select class="form-control" id="productCategory" name="productCategory" required>
                                <?php
                                try {
                                    $query = "SELECT * FROM category";
                                    $stmt = $conn->prepare($query);
                                    $stmt->execute();
                                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($categories as $category) {
                                        echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['name']) . "</option>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<option value=''>Error loading categories</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productPicture">Product Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="productPicture" name="productPicture" accept="image/*" required>
                                <label class="custom-file-label" for="productPicture">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" form="addProductForm">Reset</button>
                    <button type="button" class="btn " id="saveUserBtn">Save product</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>