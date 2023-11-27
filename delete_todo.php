<?php
// Include your database connection configuration here
include "database.php";
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $data = json_decode(file_get_contents("php://input"));
    // $todo_id = $data["id"];
    $todo_id = $data->id;
    // $todo_id = "bla";
    // pokusavam da u todo_id upisem vrednost id;

    // Check if the todo ID is provided in the query parameters
    if (isset($todo_id)) {
        // Prepare and execute the SQL query to delete the todo by ID
        $stmt = $pdo->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $todo_id);
        $stmt->execute();

        // Return a success message as JSON response
        echo json_encode(array("message" => "Todo deleted successfully"));
    } else {
        // Return an error message if the todo ID is missing
        echo json_encode(array("message" => "Todo ID is required"));
    }
}

// $student = ["name" => "Dusan"];
// $student["name"];

// class Student{
//     public $name;
// }
// $student = new Student();
// $student->name;
