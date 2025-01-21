<?php
// controller/user.php
require_once __DIR__ . '/../../database/db.php'; // Correct path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action === 'add') {
        // Handle adding a new user
        $name = $_POST['name'];
        $room = $_POST['room'];
        $ext = $_POST['ext'];
        $image = $_FILES['image'];

        // Upload image
        $targetDir = __DIR__ . '/../../assets/images/upload/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $targetFile = $targetDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $targetFile);

        // Insert into database
        try {
            $sql = "INSERT INTO users (name, room, image, ext) VALUES (:name, :room, :image, :ext)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':room' => $room,
                ':image' => $targetFile,
                ':ext' => $ext
            ]);
            header('Location: ../../pages/admin/users.php');
            exit;
        } catch (PDOException $e) {
            die("Error adding user: " . $e->getMessage());
        }
    } elseif ($action === 'edit') {
        // Handle editing a user
        $id = $_POST['id'];
        $name = $_POST['name'];
        $room = $_POST['room'];
        $ext = $_POST['ext'];
        $image = $_FILES['image'];

        // Update database
        try {
            if ($image['size'] > 0) {
                // Upload new image
                $targetDir = __DIR__ . '/../../assets/images/upload/';
                $targetFile = $targetDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $targetFile);

                $sql = "UPDATE users SET name = :name, room = :room, image = :image, ext = :ext WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':room' => $room,
                    ':image' => $targetFile,
                    ':ext' => $ext,
                    ':id' => $id
                ]);
            } else {
                $sql = "UPDATE users SET name = :name, room = :room, ext = :ext WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':room' => $room,
                    ':ext' => $ext,
                    ':id' => $id
                ]);
            }
            header('Location: ../../pages/admin/users.php');
            exit;
        } catch (PDOException $e) {
            die("Error updating user: " . $e->getMessage());
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'fetch') {
        // Fetch a single user
        $id = $_GET['id'];
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($user);
        } catch (PDOException $e) {
            die("Error fetching user: " . $e->getMessage());
        }
    } elseif ($action === 'delete') {
        // Delete a user
        $id = $_GET['id'];
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            die("Error deleting user: " . $e->getMessage());
        }
    }
}
?>