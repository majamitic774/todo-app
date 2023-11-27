<?php
include "database.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json");

// Check if the request is an OPTIONS request (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // OK
    exit();
}

try {
    $data = json_decode(file_get_contents("php://input"));

    // Check if the todo body is provided in the request
    if (isset($data->body)) {
        // Prepare and execute the SQL query to insert a new todo
        $stmt = $pdo->prepare("INSERT INTO todos (body) VALUES (:body)");
        $stmt->bindParam(':body', $data->body);
        $stmt->execute();

        // Return a success message as JSON response
        echo json_encode(array("message" => "Todo added successfully"));
    } else {
        // Return an error message if the todo body is missing
        http_response_code(400); // Bad Request
        echo json_encode(array("error" => "Todo body is required"));
    }
} catch (PDOException $e) {
    // Handle database query errors
    http_response_code(500); // Internal Server Error
    echo json_encode(array("error" => "Database error: " . $e->getMessage()));
} catch (Exception $e) {
    // Handle other exceptions
    http_response_code(500); // Internal Server Error
    echo json_encode(array("error" => "Unexpected error: " . $e->getMessage()));
}
