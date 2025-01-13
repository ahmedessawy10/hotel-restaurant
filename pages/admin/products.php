<?php
require_once "../../database/db.php";
$pageTitle = "products";
$styles = ["add_product.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";

?>

<div class="adding container w-50 mt-5">
        <h2 class="add-title">Add Product </h2>
        <form>
            <div class="mb-3">
                <label for="productName" class="form-label">Product</label>
                <input type="text" class="form-control" id="productName" placeholder="Tee">
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="productPrice" placeholder="3.50 EOP" min="0" >
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Category</label>
                <select class="form-select" id="productCategory">
                    <option selected>Hot Drinks</option>
                    <option>Cold Drinks</option>
                    <option>Snacks</option>
                    <option>Desserts</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="productPicture" class="form-label">Product Picture</label>
                <input type="file" class="form-control" id="productPicture">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Product</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </form>
    </div>





<?php include "../../includes/footer.php";  ?>