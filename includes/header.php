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
    $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/hotel-restaurant';
    // echo $_SERVER['DOCUMENT_ROOT'] . "<br>";
    // echo dirname($_SERVER['SCRIPT_NAME']) . "<br>";
    // echo $_SERVER['SCRIPT_NAME'] . "<br>";
    // echo  $baseURL . "<br>";
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/assets/vendor/bootstrap/css/bootstrap.css">
    <script src="<?php echo $baseURL; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>


    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/assets/vendor/fontawesome/all.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL; ?>/assets/css/main.css">


    <!-- toastr css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- toastr js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Additional styles -->


    <?php
    foreach ($styles as $style) {
        echo "<link rel='stylesheet' href='{$baseURL}/assets/css/{$style}'>";
    }

    if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) {
        $type = htmlspecialchars($_SESSION['alert']['type'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_SESSION['alert']['message'], ENT_QUOTES, 'UTF-8');
        echo "<script>toastr.$type('$message');</script>";
        unset($_SESSION['alert']);
    }
    ?>
</head>

<body>