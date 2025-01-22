<?php
// Define the base URL dynamically (if not already defined)
if (!isset($baseURL)) {
    // $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/hotel-restaurant';
    $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
}
?>


<footer class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 text-center text-lg-start mb-3">
                <img src="<?php echo $baseURL  ?>/assets/images/logo.png" class=" rounded-circle" alt="Logo" style="width: 70px;
    height: 70px;">
                <p>We provide world-class food services.</p>
                <div>
                    <a href="#" class="me-2 link-dark"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-2 link-dark"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-2 link-dark"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-2 link-dark"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3">
                <h5>Our Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="link-color text-decoration-none link-secondary ">Home</a></li>
                    <li><a href="#" class="text-decoration-none link-secondary">FAQs</a></li>
                    <li><a href="#" class="text-decoration-none link-secondary">Contact Us</a></li>
                    <li><a href="#" class="text-decoration-none link-secondary">Site Map</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5>Support</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none link-secondary">About Us</a></li>
                    <li><a href="#" class="text-decoration-none link-secondary">How it Works</a></li>
                    <li><a href="#" class="text-decoration-none link-secondary">Terms & Conditions</a></li>
                    <li><a href="#" class="text-decoration-none link-secondary">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5>Contact</h5>
                <p class="secondary"><i class="fa-solid fa-phone"></i> 123-456-789</p>
                <p class="secondary"><i class="fa-regular fa-clock"></i> Open: 11:00 AM - 11:59 PM</p>
            </div>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="<?php echo $baseURL
                ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->


<?php

// Loop through and include each script from the $scripts array

if (isset($cdnJs) && is_array($cdnJs)) {
    foreach ($cdnJs as $js) {
        echo " <script src='{$js}'></script>";
    }
}
foreach ($scripts as $script) {
    echo "<script src='{$baseURL}/assets/js/$script'></script>";
}
?>

<!-- Bootstrap JS -->
</body>

</html>