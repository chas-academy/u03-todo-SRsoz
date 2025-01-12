<?php
// Includes the file connections needed
require_once "./db.php";
require_once "./functions/functions.php";
require_once "./views/if.php";
require_once "./views/header.php";
?>
    <main>
        <!-- Section for displaying the task form -->
        <section class="form">
            <?php if ($taskToEdit): ?>
                <h2>Edit Task</h2>
                <form id="editform" method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                    <input type="hidden" name="action" value="edit_task">
                    <input type="hidden" name="task_id" value="<?=$taskToEdit["id"]?>">
                    <label class="tiscription" for="title">Title</label>
                    <input type="text" id="title" name="name" value="<?=$taskToEdit["title"]?>" required>
                    <label class="tiscription" for="description">Description</label>
                    <textarea id="description" name="description"><?=$taskToEdit["description"]?></textarea>
                    <button type="submit">Save</button>
                </form>
            <?php else:?>
                <!-- Form for creating a new task -->
            <h2>Create task</h2>
            <form id="taskform" method="POST" action="index.php"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
             <input type="hidden" name="action" value="create_task">
                <label class="tiscription" for="title"></label>
                <input type="text" id="title" name="name" placeholder="Name your new task..." required>
                <label class="tiscription" for="description"></label>
                <textarea id="description" name="description" placeholder="Describe your new task..."></textarea>
                <button type="submit">Add Task</button>
            </form>
            <?php endif; ?>
        </section>
         <!-- Section for active tasks -->
        <section id="active-tasks">
            <h3>Tasks to do</h3>
            <ul>
                <?php foreach ($tasks as $task) : ?>
                    <li>
                        <div class="titledes">
                        <span class="task-title"><?=$task["title"]?></span>
                        <p><?=$task["description"]?></p>
                        </div>
                        <div class="buttons">
                            <!-- Mark task as done -->
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="mark_done">
                                <input type="hidden" name="task_id" value="<?= $task["id"]?>">
                                <button><i class="fa fa-check" aria-hidden="true"></i></button>
                            </form>
                             <!-- Edit task -->
                            <form method="GET" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="edit" value="<?= $task["id"]?>">
                                <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </form>
                            <!-- Delete task -->
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="task_id" value="<?= $task["id"]?>">
                                <button><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <!-- Section for completed tasks -->
        <section id="done-tasks">
            <h4>Finished tasks</h4>
            <ul>
                <?php foreach ($doneTasks as $task) : ?>
                    <li>
                        <p class="task-title"><?= $task["title"]?></p>
                        <p class="task-description"><?= $task["description"]?></p>
                        <div class="buttons">
                            <!-- Undo completed task (toggle) -->
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="undo_done">
                                <input type="hidden" name="task_id" value="<?= $task["id"]?>">
                                <button class="undo"><i class="fa fa-undo" aria-hidden="true"></i></button>
                            </form>
                            <!-- Edit completed task -->
                            <form method="GET" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="edit" value="<?= $task["id"]?>">
                                <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </form>
                             <!-- Delete completed task -->
                            <form method="POST" action="index.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="task_id" value="<?= $task["id"]?>">
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
