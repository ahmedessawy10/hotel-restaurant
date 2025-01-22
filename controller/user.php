<?php
session_start();
require_once '../database/db.php'; // Include the database connection

header('Content-Type: application/json'); // Set response type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action === 'add') {
        // Handle adding a new user
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $image = $_FILES['image'];

        // Validate inputs
        if (empty($name) || empty($email) || empty($image['name'])) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
            exit;
        }

        // Validate image file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            echo json_encode(['status' => 'error', 'message' => 'Only JPEG, PNG, and GIF images are allowed.']);
            exit;
        }

        // Upload image
        $targetDir = '../../assets/images/upload/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . basename($image['name']);

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            try {
                $sql = "INSERT INTO users (name, image, email) VALUES (:name, :image, :email)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':image' => $targetFile,
                    ':email' => $email
                ]);

                $userId = $conn->lastInsertId();
                echo json_encode(['status' => 'success', 'message' => 'User added successfully.', 'userId' => $userId]);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error adding user: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
        }
    } elseif ($action === 'edit') {
        // Handle editing a user
        $id = intval($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $image = $_FILES['image'];

        if (empty($name) || empty($email)) {
            echo json_encode(['status' => 'error', 'message' => 'Name and email are required.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
            exit;
        }

        try {
            if ($image['size'] > 0) {
                // Validate image file
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($image['type'], $allowedTypes)) {
                    echo json_encode(['status' => 'error', 'message' => 'Only JPEG, PNG, and GIF images are allowed.']);
                    exit;
                }

                // Upload new image
                $targetDir = '../../assets/images/upload/';
                $targetFile = $targetDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $targetFile);

                $sql = "UPDATE users SET name = :name, image = :image, email = :email WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':image' => $targetFile,
                    ':email' => $email,
                    ':id' => $id
                ]);
            } else {
                $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':id' => $id
                ]);
            }

            echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error updating user: ' . $e->getMessage()]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'fetch') {
        // Fetch all users or a single user based on the presence of 'id'
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        try {
            if ($id) {
                // Fetch a single user
                $sql = "SELECT * FROM users WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id' => $id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    echo json_encode($user); // Return the user data as JSON
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
                }
            } else {
                // Fetch all users
                $sql = "SELECT * FROM users ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode(['status' => 'success', 'users' => $users]);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching users: ' . $e->getMessage()]);
        }
    } elseif ($action === 'delete') {
        // Delete a user
        $id = intval($_GET['id']);

        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully.']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $e->getMessage()]);
        }
    }
}
?>