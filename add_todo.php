<?php
include "database.php";

$data = json_decode(file_get_contents("php://input"));
// $data = ["body" => "Run"];

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
    echo json_encode(array("message" => "Todo body is required"));
}