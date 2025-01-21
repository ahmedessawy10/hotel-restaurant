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
            </div>
        </main>

        <aside class="col-lg-3 mb-4 order-1 order-lg-0">
            <div class="bg-light p-3 rounded sticky-top">
                <h5>Cart</h5>
                <div id="cartlist" class="w-100"></div>
                <div class="d-flex justify-content-between py-3">
                    <span>Total:</span>
                    <span><span id="cartTotal">0</span> EGY</span>
                </div>
                <button class="btn btn-success w-100" onclick="sendToSave()">Checkout</button>
            </div>
        </aside>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>