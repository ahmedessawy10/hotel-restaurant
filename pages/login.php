<?php

$pageTitle = "Home";
$styles = ["login.css"];
$scripts = [];

require_once "../includes/header.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body style="background-image: url(../assets/images/login_image.png) ;background-repeat: no-repeat; ">
    <form action="../controller/login.php" method="post">

        <br>
        <input type="email" name="email" id="email" placeholder="User Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>
        <div><input type="checkbox" class="check"> Remember me ? </div>
        <br>
        <a href="" style="text-decoration: none;">Forgot Password ?</a>
        <BUtton type="submit">Login </BUtton>
    </form>
</body>

</html>

<?php include "../includes/footer.php";  ?>