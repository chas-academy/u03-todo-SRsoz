<?php
require_once './db.php'; // Inkludera databasanslutningen
//hämtar alla tasks
function fetchTask($conn)
{
    $sql = "SELECT * FROM Tasks";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a new task
function addTask($conn, $title, $description, $list_id = null)
{
    $stmt = $conn->prepare("INSERT INTO Tasks (title, description, list_id) VALUES (:title, :description, :list_id)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':list_id', $list_id);
    return $stmt->execute();
}

// Update a task
function updateTask($conn, $id, $title, $description, $list_id = null)
{
    $stmt = $conn->prepare("UPDATE Tasks SET title = :title, description = :description, list_id = :list_id = WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':list_id', $list_id);
    return $stmt->execute();
}

// Delete a task
function deleteTask($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM Tasks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

// Toggle task completion
function toggleTask($conn, $id, $is_checked)
{
    $stmt = $conn->prepare("UPDATE Tasks SET is_checked = :is_checked WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':is_checked', $is_checked, PDO::PARAM_INT);
    return $stmt->execute();
    // Kontrollera om en uppgift ska markeras som slutförd
}
// Fetch tasks by completion status
function taskStatus($conn, $is_checked)
{
    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE is_checked = :is_checked");
    $stmt->bindParam(':is_checked', $is_checked, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function taskById($conn, $taskId)
{
    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE id = :id");
    $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
} //NYTT hämtar en specifik uppgift
