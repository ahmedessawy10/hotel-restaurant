<?php
session_start();
header('Content-Type: application/json'); // Set response type to JSON

// Use correct relative path to include db.php
$dbPath = __DIR__ . '/../database/db.php';

// Debugging: Check if the file exists
if (!file_exists($dbPath)) {
    echo json_encode(['status' => 'error', 'message' => 'Database configuration file not found. Path: ' . $dbPath]);
    exit;
}

require_once $dbPath;

// Check database connection
if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action === 'add') {
        // Handle adding a new product
        $name = htmlspecialchars($_POST['name']);
        $price = floatval($_POST['price']);
        $category_id = intval($_POST['category_id']);
        $available = intval($_POST['available']);
        $image = $_FILES['image'];

        // Validate inputs
        if (empty($name) || empty($price) || empty($category_id)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
        }

        // Validate image file (if provided)
        if ($image['size'] > 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($image['type'], $allowedTypes)) {
                echo json_encode(['status' => 'error', 'message' => 'Only JPEG, PNG, and GIF images are allowed.']);
                exit;
            }

            // Upload image
            $targetDir = __DIR__ . '/../../assets/images/upload/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $targetFile = $targetDir . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $targetFile);
        } else {
            $targetFile = null;
        }

        try {
            $sql = "INSERT INTO products (name, price, category_id, image, available, created_at, updated_at) 
                    VALUES (:name, :price, :category_id, :image, :available, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':price' => $price,
                ':category_id' => $category_id,
                ':image' => $targetFile,
                ':available' => $available
            ]);

            $productId = $conn->lastInsertId();
            echo json_encode(['status' => 'success', 'message' => 'Product added successfully.', 'productId' => $productId]);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error adding product: ' . $e->getMessage()]);
        }
    } elseif ($action === 'edit') {
        // Handle editing a product
        $id = intval($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $price = floatval($_POST['price']);
        $category_id = intval($_POST['category_id']);
        $available = intval($_POST['available']);
        $image = $_FILES['image'];

        if (empty($name) || empty($price) || empty($category_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Name, price, and category are required.']);
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
                $targetDir = __DIR__ . '/../../assets/images/upload/';
                $targetFile = $targetDir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $targetFile);

                $sql = "UPDATE products SET name = :name, price = :price, category_id = :category_id, 
                        image = :image, available = :available, updated_at = NOW() WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':price' => $price,
                    ':category_id' => $category_id,
                    ':image' => $targetFile,
                    ':available' => $available,
                    ':id' => $id
                ]);
            } else {
                $sql = "UPDATE products SET name = :name, price = :price, category_id = :category_id, 
                        available = :available, updated_at = NOW() WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':price' => $price,
                    ':category_id' => $category_id,
                    ':available' => $available,
                    ':id' => $id
                ]);
            }

            echo json_encode(['status' => 'success', 'message' => 'Product updated successfully.']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error updating product: ' . $e->getMessage()]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'fetch') {
        // Fetch all products or a single product based on the presence of 'id'
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        try {
            if ($id) {
                // Fetch a single product
                $sql = "SELECT * FROM products WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':id' => $id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
                    echo json_encode($product); // Return the product data as JSON
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Product not found.']);
                }
            } else {
                // Fetch all products
                $sql = "SELECT * FROM products ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode(['status' => 'success', 'products' => $products]);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching products: ' . $e->getMessage()]);
        }
    } elseif ($action === 'delete') {
        // Delete a product
        $id = intval($_GET['id']);

        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully.']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting product: ' . $e->getMessage()]);
        }
    }
}
?>