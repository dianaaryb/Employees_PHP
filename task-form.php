<?php
require_once "connection_function.php";
$conn = getConnection();

$error_message = "";
$description = "";
$estimate = "";
$assignedToId = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $description = $_POST['description'];
//    $estimate = $_POST['estimate'] ?? "1" . "\n";
    $estimate = isset($_POST['estimate']) ? intval($_POST['estimate']) : 1;
    $assignedToId = $_POST['employeeId'];

    if(empty($description)){
        $error_message = "Error: Please enter description.";
    } elseif (strlen($description) < 5 || strlen($description) > 40){
        $error_message = "Error: Description length must be 5 - 40 characters.";
    }else{
//            $employeeData = file('employees.txt', FILE_IGNORE_NEW_LINES);
        if($assignedToId == null){
            $stmt = $conn->prepare(
                'INSERT INTO tasks (description, estimate) VALUES (:description, :estimate);');
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':estimate', $estimate);
            $stmt->execute();
        }else{
            $stmt = $conn->prepare(
                'INSERT INTO tasks (description, estimate, assigned_to) VALUES (:description, :estimate, :assigned_to);');
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':estimate', $estimate);
            $stmt->bindValue(':assigned_to', $assignedToId);
            $stmt->execute();
        }
        header("Location: task-list.php?message=Task-added-successfully.");
        exit();

    }

}

//function getNewId2(): string {
//    $taskId = file_get_contents('next-idTask.txt');
//    file_put_contents('next-idTask.txt', intval($taskId) + 1);
//    return $taskId;
//}
//?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add task</title>
    <link rel="stylesheet" href="webPageStyles.css">
</head>
<body id="task-form-page">
<nav>
    <a href="index.php" id="dashboard-link">Dashboard</a> |
    <a href="employee-list.php" id="employee-list-link">Employees</a> |
    <a href="employee-form.php" id="employee-form-link">Add Employee</a> |
    <a href="task-list.php" id="task-list-page">Tasks</a> |
    <a href="task-form.php" id="task-form-link">Add Task</a>
</nav>
<div class="content-card">Add Task</div>
<div class="content-card-frame">
    <?php
    if(!empty($error_message)) {
        echo "<div id='error-block'>$error_message</div>";
    }
    ?>
    <form method="POST" action="task-form.php">
        <label for="description">Description:
            <textarea name="description" id="description" required><?php echo htmlspecialchars($description);?></textarea><br>
        </label>
        <div class="radio-container">
            <label for="Estimate">Estimate:</label>
            <input type="radio" id="1" value="1" name="estimate">
            <label for="1">1</label>
            <input type="radio" id="2" value="2" name="estimate">
            <label for="2">2</label>
            <input type="radio" id="3" value="3" name="estimate">
            <label for="3">3</label>
            <input type="radio" id="4" value="4" name="estimate">
            <label for="4">4</label>
            <input type="radio" id="5" value="5" name="estimate">
            <label for="5">5</label>
        </div>
        <div>
            <label for="assigned-to">Assigned to:
                <select name="employeeId" id="selectEmployee">
                    <option></option>
                    <?php
                    $stmt = $conn->prepare("SELECT id, first_name, last_name FROM employees");
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];

                        echo "<option value='" . htmlspecialchars($id) . "'>" . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "</option>";
                    }
                    ?>

                    <!--                --><?php
    //                $employeeData = file('employees.txt');
    //                foreach ($employeeData as $employeeInfo) {
    //                    [$id, $first_name, $last_name] = explode(' ', $employeeInfo);
    //                    echo "<option value='$id'>$first_name $last_name</option>";
    //                }
    //                ?>
                </select>
            </label>
        </div>
        <button type="submit" name="submitButton" id="submitButton" value="Save">Save</button>
    </form>
</div>
</body>
<footer>icd0007 Sample Application</footer>
</html>