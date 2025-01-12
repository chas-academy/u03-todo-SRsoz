<?php
// Checks if the request method is POST and the required fields for creating a task are set.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["description"])&& isset ($_POST["action"])&& $_POST["action"]==="create_task") {
    $title = htmlspecialchars($_POST["name"]);  // Sanitizes the task name
    $description = htmlspecialchars($_POST["description"]);
    addTask($conn, $title, $description, $list_id = null);  // Calls the function to add a new task.
} 
// Handles other POST requests based on the action field.
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        // Handles marking a task as not done.
        if ($_POST["action"] === "mark_not_done") {
            $taskId = intval($_POST["task_id"]); // Ensures the task ID is an integer.
            toggleTask($conn, $taskId, 0); // Updates the task's status to "not done".
        } 
        // Restores a task to active status.
         elseif ($_POST["action"] === "restore") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 0); // Återställ en uppgift till att vara aktiv
        } 
        // Deletes a completed task.
        elseif ($_POST["action"] === "delete_done") {
            $taskId = intval($_POST["task_id"]);
            deleteTask($conn, $taskId); // Ta bort en avslutad uppgift
        } 
        // Edits the details of a completed task.
        elseif ($_POST["action"] === "edit_task_done") {
            $taskId = intval($_POST["task_id"]);
            $title = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            updateTask($conn, $taskId, $title, $description); // Redigera en klar uppgift

            header("Location: index.php"); // Redirects to the main page after editing.
            exit; // Stops further script execution.
        }
    }
}
// Handles additional POST requests for marking tasks, deleting, or undoing actions.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        // Marks a task as done.
        if ($_POST["action"] === "mark_done") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 1); // Updates the task's status to "done".
        } 
         // Deletes a task.
        elseif ($_POST["action"] === "delete") {
            $taskId = intval($_POST["task_id"]);
            deleteTask($conn, $taskId);
        } 
        // Undoes the "done" status of a task.
        elseif ($_POST["action"] === "undo_done") {
            $taskId = intval($_POST["task_id"]);
            toggleTask($conn, $taskId, 0);
        } 
         // Edits the details of an active task.
        elseif ($_POST["action"] === "edit_task") {
            $taskId = intval($_POST["task_id"]);
            $title = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            updateTask($conn, $taskId, $title, $description);
           
            header("Location: index.php");
            exit;
        }
    }
}

// Fetches a task for editing if the "edit" parameter is present in the GET request.
$taskToEdit = null;
if (isset($_GET["edit"]) && is_numeric($_GET["edit"])) {
    $taskToEdit = taskById($conn, intval($_GET["edit"])); // Fetches the task by its ID.
}
// Retrieves all tasks marked as done.
$doneTasks = taskStatus($conn, 1);
// Retrieves all tasks that are not done.
$tasks = taskStatus($conn,0);