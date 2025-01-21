<?php

require_once "../../database/db.php";

try {
    $query = "SELECT * FROM category";
    $stmt = $conn->prepare($query); // Ensure $conn is the correct variable
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


    header('Content-Type: application/json');
    echo json_encode($categories);
} catch (PDOException $e) {

    echo json_encode(['error' => $e->getMessage()]);
}
