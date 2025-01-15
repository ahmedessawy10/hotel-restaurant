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

?>

<div class="container mt-5">
    <h2 class="add-title txt-color mb-4">Product Management</h2>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">
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
            </tbody>
        </table>
    </div>

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
                    <form id="addProductForm">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" class="form-control" id="productPrice" placeholder="Enter price" required>
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



<?php include "../../includes/footer.php";  ?>