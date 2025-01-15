<?php

session_start();
error_reporting(0);
require_once "../../database/db.php";

if (isset($_SESSION['user']) && count($_SESSION['user']) == 0) {
    header('location:../logout.php');
    exit;
}
require_once "../../database/db.php";
$pageTitle = "Home";
$styles = ["manual_order.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";
?>

</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 m-auto my-5 d-flex w-50 align-items-center justify-content-centerS">
            <label for="form-select" class="lw-24"> Add User</label>
            <select class="form-select w-100" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">feby nessem</option>
                <option value="2">salma ousama</option>
                <option value="3">ahmed alsherif</option>
            </select>
        </div>
    </div>
</div>
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
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-warning ">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-warning">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-warning">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-warning">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-warning">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-warning">Choose</button>
                        </div>
                    </div>
                </div>
                <!-- Repeat similar blocks for other items -->
            </div>
        </main>

        <aside class="col-lg-3 mb-4">
            <div class="bg-light p-3 rounded sticky-top">
                <h5>Cart</h5>
                <p>No items in the cart</p>
                <button class="btn btn-outline-warning w-100 btn-color">Checkout</button>
            </div>
        </aside>
    </div>
</div>



<?php include "../../includes/footer.php";  ?>