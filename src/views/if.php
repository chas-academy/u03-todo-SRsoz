<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["description"])&& isset ($_POST["action"])&& $_POST["action"]==="create_task") {
    $title = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    addTask($conn, $title, $description, $list_id = null);
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "mark_not_done") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 0); // Markera som inte klar
        } elseif ($_POST["action"] === "restore") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 0); // Återställ en uppgift till att vara aktiv
        } elseif ($_POST["action"] === "delete_done") {
            $taskId = intval($_POST["task_id"]);
            deleteTask($conn, $taskId); // Ta bort en avslutad uppgift
        } elseif ($_POST["action"] === "edit_task_done") {
            $taskId = intval($_POST["task_id"]);
            $title = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            updateTask($conn, $taskId, $title, $description); // Redigera en klar uppgift

            header("Location: index.php");
            exit;
        }
    }
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
$tasks = taskStatus($conn,0);