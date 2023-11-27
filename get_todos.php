<?php

include "database.php";

try {
    $stmt = $pdo->prepare("SELECT * FROM todos");
    $stmt->execute();

    // Fetch all todos as an associative array
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the todos as JSON response
    header('Content-Type: application/json');
    echo json_encode($todos);
} catch (PDOException $e) {
    // Handle database query errors
    http_response_code(500); // Internal Server Error
    echo json_encode(array("error" => "Database error: " . $e->getMessage()));
}
