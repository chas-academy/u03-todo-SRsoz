<?php
require_once "./db.php"; // Inkludera databasanslutningen
require_once "./functions/functions.php";
require "if.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>
    <link rel="stylesheet" href="./style/style.css">
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
            <?php if ($taskToEdit): ?>
                <h2>Edit Task</h2>
                <form id="editform" method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                    <input type="hidden" name="action" value="edit_task">
                    <input type="hidden" name="task_id" value="<?= htmlspecialchars($taskToEdit['id']) ?>">
                    <label class="tiscription" for="title">Title</label>
                    <input type="text" id="title" name="name" value="<?= htmlspecialchars($taskToEdit['title']) ?>" required>
                    <label class="tiscription" for="description">Description</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($taskToEdit['description']) ?></textarea>
                    <button type="submit">Save</button>
                </form>
            <?php endif; ?>
            <h2>Create task</h2>
            <form id="taskform" method="POST">
                <label for="title"></label>
                <input type="text" id="title" name="name" placeholder="Name your new task..." required>
                <label for="description"></label>
                <textarea id="description" name="description" placeholder="Describe your new task..."></textarea>
                <button type="submit">Add Task</button>
            </form> <!-- Form for title and description of the task, also a button to add the task -->
        </section>
        <section id="active-tasks">
            <h3>Tasks to do</h3>
            <ul>
                <?php foreach ($tasks as $task) : ?>
                    <li>
                        <span class="task-title"><?= htmlspecialchars($task["title"]) ?></span>
                        <span class="task-description"><?= htmlspecialchars($task["description"]) ?></span>
                        <div class="buttons">
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="mark_done">
                                <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id']) ?>">
                                <button><i class="fa fa-check" aria-hidden="true"></i></button>
                            </form>
                            <form method="GET" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="edit" value="<?= htmlspecialchars($task['id']) ?>">
                                <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </form>
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id']) ?>">
                                <button><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section id="done-tasks">
            <h4>Finished tasks</h4>
            <ul>
                <?php foreach ($doneTasks as $task) : ?>
                    <li>
                        <span class="task-title"><?= htmlspecialchars($task["title"]) ?></span>
                        <span class="task-description"><?= htmlspecialchars($task["description"]) ?></span>
                        <div class="buttons">
                            <!-- toggle-->
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="undo_done">
                                <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id']) ?>">
                                <button class="undo"><i class="fa fa-undo" aria-hidden="true"></i></button>
                            </form>
                            <!-- Redigera uppgift -->
                            <form method="GET" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="edit" value="<?= htmlspecialchars($task['id']) ?>">
                                <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </form>
                            <!-- Ta bort uppgift -->
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id']) ?>">
                                <button><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>

</html>