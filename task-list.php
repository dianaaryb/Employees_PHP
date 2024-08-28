<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>
    <link rel="stylesheet" href="webPageStyles.css">
</head>
<body id="task-list-page">
<nav>
    <a href="index.php" id="dashboard-link">Dashboard</a> |
    <a href="employee-list.php" id="employee-list-link">Employees</a> |
    <a href="employee-form.php" id="employee-form-link">Add Employee</a> |
    <a href="task-list.php" id="task-list-page">Tasks</a> |
    <a href="task-form.php" id="task-form-link">Add Task</a>
</nav>
<div class="content-card">Tasks</div>
<div class="content-card-frame">
            <?php
            if(!empty($_GET['message'])){
                $message = $_GET['message'];
//                echo "<div id='message-block'>$message</div>";
                echo "<div id='message-block'>" . htmlspecialchars($message) . "</div>";

            }
            require_once "connection_function.php";
            $conn = getConnection();

            $stmt = $conn->prepare("SELECT id, description, estimate, assigned_to FROM tasks");
            $stmt->execute();
            $id = "";
            $description = "";
            $estimate = "";
            $personAssignedToId = "";
            foreach ($stmt as $row){
                $id = $row['id'];
                $description = $row['description'];
                $estimate = $row['estimate'];
                $personAssignedToId = $row['assigned_to'];

//                $tasksData = file("tasks.txt");
//                foreach ($tasksData as $task){
//                    $taskParts = explode(" ", $task);
//                    if(count($taskParts) >= 3){
//                        $taskId = urldecode($taskParts[0]);
//                        $description = htmlspecialchars(urldecode($taskParts[1]));
//                        $estimate = intval($taskParts[2]);
//                        $personAssignedTo = "";
//                        if (isset($taskParts[3])) {
//                            $personAssignedTo .= urldecode($taskParts[3]);
//                        }
//                        if (isset($taskParts[4])) {
//                            $personAssignedTo .= " " . urldecode($taskParts[4]);
//                        }
//                }else{
//                        continue;
//                    }
                    echo "<div class='task-item'><p data-task-id='".htmlspecialchars($id)."'>".htmlspecialchars($description)."</p>";
                    echo "<div>";
                    for ($i = 0; $i < $estimate; $i++) {
                        echo "<div class='filled-square'></div>";
                    }
                    for ($j = 0; $j < 5 - $estimate; $j++) {
                        echo "<div class='blank-square'></div>";
                    }
                    echo "</div>";
                    echo "<a class='task-edit' id='task-edit-link-".htmlspecialchars($id)."' href='modify_task.php?data=".htmlspecialchars($id)."-".htmlspecialchars($description)."-".htmlspecialchars($estimate)."-".htmlspecialchars($personAssignedToId)."'>Edit</a>";
                    echo "</div>";
               }

                ?>
</div>
</body>
<footer>icd0007 Sample Application</footer>
</html>