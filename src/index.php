<?php
require_once './db.php'; // Inkludera databasanslutningen
require_once './functions/functions.php';

// Kontrollera om formuläret skickats
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["description"])) {
    $title = htmlspecialchars($_POST["name"]);
    $description =htmlspecialchars($_POST["description"]);
    addTask($conn, $title, $description, $list_id = null, $deadline = null);
}
// Hämta uppgifter för att visa
$tasks = fetchTask($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>
    <link rel="stylesheet" href="/style/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Delius+Swash+Caps&family=Dynalight&family=Ms+Madi&family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <img id="to-do" src="./assets/to-do-list.png" alt="Animated picture of a checklist">
    </header>
    <h1>
        YOUR PERSONALIZED CHECKLIST
    </h1>
    <main>
        <section class="form">
            <h2>Create task</h2>
            <form id="taskform" method="POST">
                <label for="title"></label>
                <input type="text" id="title" name="name" placeholder="Name your new task..." required>
                <label for="description"></label>
                <textarea id="description" name="description" placeholder="Describe your new task..."></textarea>
                <button type="submit">Add Task</button>
            </form>
        </section>
        <section id="active-tasks">
            <h2>Tasks to do</h2>
            <ul>
                <?php foreach ($tasks as $task) : ?>
                <li>
                <span class="task-title"><?= htmlspecialchars($task["title"]) ?></span>
               <span class="task-description"><?= htmlspecialchars($task["description"]) ?></span>
               <div class="buttons">
               <form action="">
                    <button><i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
                <form action="">
                    <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                </form>
                <form action="">
                    <button><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
                </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section id="done-tasks">
            <h2>Finished tasks</h2>
            <ul>
                <li>
                    <span class="description-done">DESCRIPTION</span>
                    <form action="" class="buttons">
                    <button class="undo"><i class="fa fa-undo" aria-hidden="true"></i></button>
                    </form>
                    <button class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></button> //länka till samma action
                </li>
            </ul>
        </section>
    </main>
</body>
</html>
