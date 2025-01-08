<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["description"])) {
    $title = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    addTask($conn, $title, $description, $list_id = null);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "mark_done") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 1);
        } elseif ($_POST["action"] === "delete") {
            $taskId = intval($_POST["task_id"]);
            deleteTask($conn, $taskId);
        } elseif ($_POST["action"] === "undo_done") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 0);
        } elseif ($_POST["action"] === "edit_task") {
            $taskId = intval($_POST["task_id"]);
            $title = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            updateTask($conn, $taskId, $title, $description);
           
            header("Location: index.php");
            exit;
        }
    }
}


$taskToEdit = null;
if (isset($_GET["edit"]) && is_numeric($_GET["edit"])) {
    $taskToEdit = taskById($conn, intval($_GET["edit"]));
}

$doneTasks = taskStatus($conn, 1);
$tasks = fetchTask($conn);