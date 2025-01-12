<?php
// Includes the database file for establishing a connection.
require_once "./db.php";

function fetchTask($conn)

{
     // Fetches all tasks from the "Tasks" table.
    $sql = "SELECT * FROM Tasks";
    $stmt = $conn->prepare($sql); // Prepares the SQL query to prevent SQL injection.
    $stmt->execute(); // Executes the prepared statement.

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
     // Returns all rows as an associative array.
}

function addTask($conn, $title, $description, $list_id = null)
{
     // Inserts a new task into the "Tasks" table.
    $stmt = $conn->prepare(
        "INSERT INTO Tasks (title, description, list_id) VALUES (:title, :description, :list_id)"
    );
    // Binds the parameters to the SQL query to ensure data safety
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":list_id", $list_id);

    return $stmt->execute();
    // Executes the query and returns true if successful.
}

function updateTask($conn, $id, $title, $description, $list_id = null)
{
    // Updates an existing task in the "Tasks" table by ID.
    $stmt = $conn->prepare(
        "UPDATE Tasks SET title = :title, description = :description, list_id = :list_id WHERE id = :id"
    );
     // Binds the task ID and other details to the query.
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":list_id", $list_id);

    return $stmt->execute();
}

function deleteTask($conn, $id)
{
     // Deletes a task from the "Tasks" table based on its ID.
    $stmt = $conn->prepare("DELETE FROM Tasks WHERE id = :id");
    $stmt->bindParam(":id", $id);

    return $stmt->execute();
}

function toggleTask($conn, $id, $is_checked)
{
    // Toggles the completion status of a task (checked/unchecked).
    $stmt = $conn->prepare("UPDATE Tasks SET is_checked = :is_checked WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":is_checked", $is_checked, PDO::PARAM_INT);

    return $stmt->execute();

}

function taskStatus($conn, $is_checked)
{
    // Retrieves tasks based on their completion status.
    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE is_checked = :is_checked");
    $stmt->bindParam(":is_checked", $is_checked, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Returns the tasks matching the specified status.
}

function taskById($conn, $taskId)
{
     // Fetches a single task from the "Tasks" table by its ID.
    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE id = :id");
    $stmt->bindParam(":id", $taskId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
      // Returns the task as an associative array.
} 
