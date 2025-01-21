<?php
// controller/product.php
require_once __DIR__ . 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action === 'add') {
        // Handle adding a new product
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
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
            $sql = "INSERT INTO products (name, price, category_id, image, available, created_at, updated_at) 
                    VALUES (:name, :price, :category_id, :image, 'Yes', NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':price' => $price,
                ':category_id' => $category_id,
                ':image' => $targetFile
            ]);
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            die("Error adding product: " . $e->getMessage());
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'fetchAll') {
        // Fetch all products
        try {
            $sql = "SELECT * FROM products ORDER BY id DESC";
            $stmt = $conn->query($sql);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($products);
        } catch (PDOException $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    } elseif ($action === 'delete') {
        // Handle deleting a product
        $id = $_GET['id'];
        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            die("Error deleting product: " . $e->getMessage());
        }
    }
}
?>