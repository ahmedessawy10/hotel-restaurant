<?php


require_once "../../database/db.php";

try {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM products where category_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    } elseif (isset($_GET['key']) and $_GET['key'] != "") {
        $search = $_GET['key'];
        $query = "SELECT * FROM products where name like :search";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'searzch' => '%' . $search . '%'
        ]);
    } else {
        $query = "SELECT * FROM products";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    }

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($products);
} catch (PDOException $e) {

    echo json_encode(['error' => $e->getMessage()]);
}
