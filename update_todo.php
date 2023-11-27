<?php

include "database.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    $todo_id = $data->id;

    if (isset($todo_id)) {
        $new_body = $data->newBody;

        $stmt = $pdo->prepare("UPDATE todos SET body = :newBody WHERE id = :id");
        $stmt->bindParam(':newBody', $new_body);
        $stmt->bindParam(':id', $todo_id);
        $stmt->execute();

        echo json_encode(array("message" => "Todo updated successfully"));
    } else {
        echo json_encode(array("message" => "Todo ID is required"));
    }
}
