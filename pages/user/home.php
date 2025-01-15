<?php
require_once "../../database/db.php";
$pageTitle = "Home";
$styles = ["../../assets/css/home.css"];
$scripts = [];

require_once "../../includes/header.php";
require_once "../../includes/navbar.php";




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
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-primary">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-primary">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-primary">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-primary">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-primary">Choose</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-item">
                        <img src="./item_1.jpg" class="card-img-top" alt="Item 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Paneer Biryani</h6>
                            <p class="card-text">$50</p>
                            <button class="btn btn-primary">Choose</button>
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
                <button class="btn btn-success w-100">Checkout</button>
            </div>
        </aside>
    </div>
</div>

<footer class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 text-center text-lg-start mb-3">
                <img src="./logo.jpg" class="w-25 rounded-circle" alt="Logo">
                <p>We provide world-class food services.</p>
                <div>
                    <a href="#" class="me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3">
                <h5>Our Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none">Home</a></li>
                    <li><a href="#" class="text-decoration-none">FAQs</a></li>
                    <li><a href="#" class="text-decoration-none">Contact Us</a></li>
                    <li><a href="#" class="text-decoration-none">Site Map</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5>Support</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none">About Us</a></li>
                    <li><a href="#" class="text-decoration-none">How it Works</a></li>
                    <li><a href="#" class="text-decoration-none">Terms & Conditions</a></li>
                    <li><a href="#" class="text-decoration-none">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5>Contact</h5>
                <p><i class="fa-solid fa-phone"></i> 123-456-789</p>
                <p><i class="fa-regular fa-clock"></i> Open: 11:00 AM - 11:59 PM</p>
            </div>
        </div>
    </div>
</footer>


<?php include "../../includes/footer.php";  ?>