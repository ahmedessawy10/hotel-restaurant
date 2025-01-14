<?php
session_start();
// error_reporting(0);
require_once "../database/db.php";


if (!isset($_SESSION['user']) && count($_SESSION['user']) != 0) {
    header('location:.../pages/logout.php');
    exit;
} else {
    $uid = $_SESSION['user']['id'];
    if (isset($_POST['update'])) {

        $name = $_POST['name'] ?? $_SESSION['user']['name'];
        $phone = $_POST['phone'] ?? $_SESSION['user']['phone'];
        $email = $_POST['email'] ?? $_SESSION['user']['email'];
        $sql = "SELECT id FROM users WHERE id=:uid";
        $query = $conn->prepare($sql);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $sql = "update users set email=:email,phone=:phone,name=:name where id=:uid";
            $update = $conn->prepare($sql);
            $update->bindParam(':uid', $uid, PDO::PARAM_STR);
            $update->bindParam(':name', $name, PDO::PARAM_STR);
            $update->bindParam(':email', $email, PDO::PARAM_STR);
            $update->bindParam(':phone', $phone, PDO::PARAM_STR);


            if ($update->execute()) {
                $sql = "SELECT * FROM users WHERE id=:uid";
                $query = $conn->prepare($sql);
                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query->execute();

                $_SESSION['user'] = $query->fetch(PDO::FETCH_ASSOC);


                $alert = ["type" => "success", "message" => "Your password successully changed"];
                $_SESSION['alert'] = $alert;
                header("location:../pages/profile/myprofile.php");
                exit();
            }
        } else {
            $alert = ["type" => "error", "message" => "Your account does not"];
            $_SESSION['alert'] = $alert;
            header('location:../pages/profile/myprofile.php');
            exit();
        }
    } elseif (isset($_POST['changepass'])) {

        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $sql = "SELECT id FROM users WHERE id=:uid and Password=:cpassword";
        $query = $conn->prepare($sql);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);


        if ($query->rowCount() > 0) {


            $sql = "update users set Password=:newpassword where id=:uid";
            $chngpwd1 = $conn->prepare($sql);
            $chngpwd1->bindParam(':uid', $uid, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);


            if ($chngpwd1->execute()) {
                $alert = ["type" => "success", "message" => "Your password successully changed"];
                $_SESSION['alert'] = $alert;
                header('location:../pages/profile/myprofile.php');
                exit();
            }

            $alert = ["type" => "success", "message" => "update password fail"];
            $_SESSION['alert'] = $alert;
            header('location:../pages/profile/myprofile.php');
            exit();
        } else {
            $alert = ["type" => "error", "message" => "current password not correct"];
            $_SESSION['alert'] = $alert;
            header('location:../pages/profile/myprofile.php');
            exit();
        }
    } elseif (isset($_POST['uploadimage'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/hotel-restaurant/assets/images/upload/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . time() . '.' . pathinfo($_FILES["profileimage"]["name"], PATHINFO_EXTENSION);

        $uploadOk = 1;
        $error_message = "";
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image


        $check = getimagesize($_FILES["profileimage"]["tmp_name"]);
        if ($check == false) {
            $error_message .= "File is not an image.";
            $uploadOk = 0;
        }


        // Check if file already exists
        if (file_exists($target_file)) {
            $error_message .= "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profileimage"]["size"] > 500000) {
            $error_message .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error_message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }



        if ($uploadOk == 0) {

            $alert = ["type" => "error", "message" => "Sorry, there was an error uploading your file."];
            $_SESSION['alert'] = $alert;
            header('location:../pages/profile/myprofile.php');
            exit();
        } else {
            $fileurl = "assets/images/upload/" . basename($target_file);

            $movetodir = move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file);
            $sql = "update users set `image`=:image where `id`=:uid";
            $uploadimage = $conn->prepare($sql);
            $uploadimage->bindParam(':uid', $uid, PDO::PARAM_STR);
            $uploadimage->bindParam(':image', $fileurl, PDO::PARAM_STR);
            $q = $uploadimage->execute();


            if ($movetodir &&  $q) {
                $alert = ["type" => "success", "message" => "update image successfully"];
                $_SESSION['alert'] = $alert;

                $sql = "SELECT * FROM users WHERE id=:uid";
                $query = $conn->prepare($sql);
                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query->execute();

                $_SESSION['user'] = $query->fetch(PDO::FETCH_ASSOC);
                header('location:../pages/profile/myprofile.php');
                exit();
            } else {

                $alert = ["type" => "error", "message" => "upload image fail"];
                $_SESSION['alert'] = $alert;

                header('location:../pages/profile/myprofile.php');
                exit();
            }
        }
    }
}
