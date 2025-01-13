<?php
require_once "database/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashed_password = $user['password'];
        $role = $user['role'];

        if (password_verify($password, $hashed_password)) {
            if ($role === "admin") {
                header("Location: admin_homepage.php");
                exit();
            } elseif ($role === "user") {
                header("Location: user_homepage.php");
                exit();
            }
        } else {
            echo "<p style='color:red;'>Wrong password, try again</p>";
        }
    } else {
        echo "<p style='color:red;'>Sorry, we can't find you in our database</p>";
    }
}

?>