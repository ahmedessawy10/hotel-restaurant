<?php
// Define the base URL dynamically (if not already defined)
if (!isset($baseURL)) {
    // $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/hotel-restaurant';
    $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
}

// Loop through and include each script from the $scripts array
foreach ($scripts as $script) {
    echo "<script src='{$baseURL}/$script'></script>";
}
?>

<!-- Bootstrap JS -->
<script src="<?php echo $baseURL; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>