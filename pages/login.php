<?php

$pageTitle = "login";
$styles = ["login.css"];
$scripts = [];

require_once "../includes/header.php";


?>

<section class="d-flex w-100 h-100 justify-content-center align-items-center">
    <form action="../controller/login.php" method="post">
        <div class="input-group">
            <input type="email" name="email" id="email" class="form-control-lg" placeholder="User Email" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" class="form-control-lg" id="password" placeholder="Password" required>
        </div>
        <div class="input-group">
            <input type="checkbox" class="check"> Remember me ?
        </div>

        <a href="" style=" text-decoration: none;">Forgot Password ?</a>
        <button class="btn" type="submit">Login </button>
    </form>

</section>

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