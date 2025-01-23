<?php

$pageTitle = "login";
$styles = ["login.css"];
$scripts = [];

require_once "../includes/header.php";

?>

<div class="login-box text-center">
    <span class="coffee-icon">☕</span>
    <h2>Login</h2>
    <form action="../controller/login.php" method="post">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-check text-start mb-3">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
    <p class="mt-3"><a href="#">Forgot Password?</a></p>
</div>



<?php #include "../includes/footer.php";
?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php

// Loop through and include each script from the $scripts array

foreach ($scripts as $script) {
    echo "<script src='{$baseURL}/assets/js/$script'></script>";
}
?>

<!-- Bootstrap JS -->
</body>

</html>