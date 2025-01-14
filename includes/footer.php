<?php
// Define the base URL dynamically (if not already defined)
if (!isset($baseURL)) {
    // $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/hotel-restaurant';
    $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
}

// Loop through and include each script from the $scripts array
foreach ($scripts as $script) {
    echo "<script src='{$baseURL}/assets/js/$script'></script>";
}
?>

<!-- Bootstrap JS -->



</body>

</html>