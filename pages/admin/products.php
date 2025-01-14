<?php
require_once "../../database/db.php";
$pageTitle = "products";
$styles = ["add_product.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar nav-color">
        <div class="container">
            <span class="navbar-brand admin txt-color">Admin Panel</span>
            <ul class="navbar-nav">
                <li class="nav-item">Home</li>
                <li class="nav-item">Products</li>
                <li class="nav-item">Settings</li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="add-title txt-color">Product Management</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">
            Add Product
        </button>

        <!-- Product Table -->
        <div class="table-responsive">
            <table class="table table-bordered" id="productTable">
                <thead>
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

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title txt-color" id="addProductModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" class="adding">
                            <div class="form-group">
                                <label for="productName">Product</label>
                                <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
                            </div>
                            <div class="form-group">
                                <label for="productCategory">Category</label>
                                <select class="form-control" id="productCategory" required>
                                    <option value="">Select category</option>
                                    <option>Category 1</option>
                                    <option>Category 2</option>
                                    <option>Category 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productPicture">Product Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="productPicture">
                                    <label class="custom-file-label" for="productPicture">Choose file</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" form="addProductForm">Reset</button>
                        <button type="button" class="btn btn-primary" id="saveProduct">Add Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>

    <?php include "../../includes/footer.php";  ?>