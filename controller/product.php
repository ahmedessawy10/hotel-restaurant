<?php
session_start();
header('Content-Type: application/json'); // Set response type to JSON

// Use correct relative path to include db.php
$dbPath = '../database/db.php';

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

/**
 * Upload an image and return the file URL.
 */
function uploadImage($file, $targetDir)
{
    if ($file['size'] > 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Only JPEG, PNG, and GIF images are allowed.');
        }

        // Create the target directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Generate a unique filename
        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return "assets/images/upload/products/" . $fileName;
        } else {
            throw new Exception('Failed to upload image.');
        }
    }
    return null;
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

        try {
            // Upload image if provided
            $imageUrl = null;
            if ($image['size'] > 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/hotel-restaurant/assets/images/upload/products/";
                $imageUrl = uploadImage($image, $targetDir);
            }

            // Insert product into the database
            $sql = "INSERT INTO products (name, price, category_id, image, available) 
                    VALUES (:name, :price, :category_id, :image, :available)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':price' => $price,
                ':category_id' => $category_id,
                ':image' => $imageUrl,
                ':available' => $available
            ]);

            $productId = $conn->lastInsertId();
            echo json_encode(['status' => 'success', 'message' => 'Product added successfully.', 'productId' => $productId]);
        } catch (Exception $e) {
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

        // Validate inputs
        if (empty($name) || empty($price) || empty($category_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Name, price, and category are required.']);
            exit;
        }

        try {
            // Upload new image if provided
            $imageUrl = null;
            if ($image['size'] > 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/hotel-restaurant/assets/images/upload/products/";
                $imageUrl = uploadImage($image, $targetDir);
            }

            // Update product in the database
            if ($imageUrl) {
                $sql = "UPDATE products SET name = :name, price = :price, category_id = :category_id, 
                        image = :image, available = :available WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':price' => $price,
                    ':category_id' => $category_id,
                    ':image' => $imageUrl,
                    ':available' => $available,
                    ':id' => $id
                ]);
            } else {
                $sql = "UPDATE products SET name = :name, price = :price, category_id = :category_id, 
                        available = :available WHERE id = :id";
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
        } catch (Exception $e) {
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
