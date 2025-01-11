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


    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fontawesome/all.css">
    <link rel="stylesheet" href="./assets/css/main.css">

    <?php
    foreach ($styles as $style) {
        echo "<link rel='stylesheet' href='$style'>";
    }
    ?>
</head>

<body>