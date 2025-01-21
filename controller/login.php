<?php
session_start();
require_once "../database/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['password'];
            $role = $user['role'];

            if (md5($password) == $hashed_password) {
                $_SESSION['user'] = $user;
                $_SEsSSION['alert'] = ['message' => "welcome " . $user["name"], "type" => "success"];
                if ($role === "admin") {
                    header("Location:../pages/user/home.php");
                    exit();
                } elseif ($role === "user") {
                    header("Location:../pages/user/home.php");
                    exit();
                }
            } else {
                echo "<p style='color:red;'>Wrong password, try again</p>";
            }
        } else {
            echo "<p style='color:red;'>Sorry, we can't find you in our database</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red;'>An error occurred. Please try again later.</p>";
        // Log the error message for debugging purposes
        error_log($e->getMessage());
    }
}
