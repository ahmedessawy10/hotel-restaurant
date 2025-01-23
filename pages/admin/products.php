<?php
session_start();
// error_reporting(0);
require_once "../../database/db.php";

if (!isset($_SESSION['user']) || count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}

$pageTitle = "products";
$styles = ["product.css"];
$scripts = ["product.js"];
$cdnCss = ["//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css"];
$cdnJs = ["//cdn.datatables.net/2.2.1/js/dataTables.min.js"];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";
?>




<main class="container mt-5">
    <h2 class="add-title txt-color mb-4">Product Management</h2>
    <button type="button" class="btn btn-primary mb-3 add-product" data-bs-toggle="modal" data-bs-target="#addProductModal">
        Add Product
    </button>

    <!-- Product Table -->
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
                <!-- Rows will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title txt-color" id="addProductModalLabel">Add/Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" enctype="multipart/form-data">
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                        </div>

                        <!-- Product Price -->
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter price" required>
                        </div>

                        <!-- Product Image -->
                        <div class="mb-3">
                            <label for="productPicture" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productPicture" name="image">
                            <small class="text-muted">Upload a new image to replace the current one.</small>
                        </div>

                        <!-- Category ID -->
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-control" id="productCategory" name="category_id" required>
                                <?php
                                $query = "SELECT * FROM category";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>

                        <!-- Availability -->
                        <div class="mb-3">
                            <label for="productAvailable" class="form-label">Availability</label>
                            <select class="form-control" id="productAvailable" name="available" required>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>

                        <!-- Created At (Read-only for Edit Mode) -->
                        <div class="mb-3">
                            <label for="productCreatedAt" class="form-label">Created At</label>
                            <input type="text" class="form-control" id="productCreatedAt" name="created_at" readonly>
                        </div>

                        <!-- Updated At (Read-only for Edit Mode) -->
                        <div class="mb-3">
                            <label for="productUpdatedAt" class="form-label">Updated At</label>
                            <input type="text" class="form-control" id="productUpdatedAt" name="updated_at" readonly>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveProduct">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include "../../includes/footer.php"; ?>