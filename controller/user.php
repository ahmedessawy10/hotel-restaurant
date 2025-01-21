<?php
session_start();
require_once "../database/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action === 'add') {
        // Handle adding a new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $image = $_FILES['image'];

        // Upload image
        $targetDir = "../../assets/images/upload/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $targetFile = $targetDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $targetFile);

        // Insert into database
        try {
            $sql = "INSERT INTO users (name, image, email, phone) VALUES (:name, :image, :email, :phone)";
            $stmt = $dbConnection->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':image' => $targetFile,
                ':email' => $email,
                ':phone' => $phone
            ]);
            echo json_encode(["success" => true, "message" => "User added successfully."]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error adding user: " . $e->getMessage()]);
        }
    } elseif ($action === 'edit') {
        // Handle editing a user
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $image = $_FILES['image'];

        // Update database
        try {
            if ($image['size'] > 0) {
                // Upload new image
                $targetDir = "../../assets/images/upload/";
                $targetFile = $targetDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $targetFile);

                $sql = "UPDATE users SET name = :name, image = :image, email = :email, phone = :phone WHERE id = :id";
                $stmt = $dbConnection->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':image' => $targetFile,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':id' => $id
                ]);
            } else {
                $sql = "UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id";
                $stmt = $dbConnection->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':id' => $id
                ]);
            }
            echo json_encode(["success" => true, "message" => "User updated successfully."]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error updating user: " . $e->getMessage()]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'fetch') {
        // Fetch a single user
        $id = $_GET['id'];
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $dbConnection->prepare($sql);
            $stmt->execute([':id' => $id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(["success" => true, "data" => $user]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error fetching user: " . $e->getMessage()]);
        }
    } elseif ($action === 'delete') {
        // Delete a user
        $id = $_GET['id'];
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $dbConnection->prepare($sql);
            $stmt->execute([':id' => $id]);
            echo json_encode(["success" => true, "message" => "User deleted successfully."]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error deleting user: " . $e->getMessage()]);
        }
    }
}
?>