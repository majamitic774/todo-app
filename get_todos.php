<?php

include "database.php";

$stmt = $pdo->prepare("SELECT * FROM todos");
$stmt->execute();

// Fetch all todos as an associative array
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the todos as JSON response
header('Content-Type: application/json');
echo json_encode($todos);