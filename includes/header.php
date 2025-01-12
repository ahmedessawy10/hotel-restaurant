<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <!-- end font -->

    <!-- Define a base URL -->
    <?php
    // Define the base URL dynamically
    $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/assets/vendor/fontawesome/all.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/assets/css/main.css">

    <!-- Additional styles -->
    <?php
    foreach ($styles as $style) {
        echo "<link rel='stylesheet' href='{$baseURL}/$style'>";
    }
    ?>
</head>

<body>