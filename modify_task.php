<?php
require_once "connection_function.php";
$conn = getConnection();

$description = "";
$estimate = "";
$taskId = "";
$assignedPerson = "";
if(!empty($_GET['data'])){
    $data = $_GET['data'];
    $taskId = explode("-", $data)[0];
    $description = explode("-", $data)[1];
    $estimate = explode("-", $data)[2] ?? "";
    $assignedPerson = explode("-", $data)[3] ?? "";
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $delete = $_POST['deleteButton'] ?? "";
    $submit = $_POST['submitButton'] ?? "";
    $taskId = $_GET['taskId'];
    $description = $_POST['description'] ?? '';
    $estimate = $_POST['estimate'] ?? "1" . "\n";
    $assignedPerson = $_POST['assigned_to'];
    $message = "";
    if($delete === "Delete"){
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam(":id", $taskId);
        $stmt->execute();
//        $lines = file("tasks.txt");
//        $modifiedTasks = [];
//        foreach ($lines as $line){
//            $taskParts = explode(' ', trim($line));
//            $explode = explode('-', $taskId)[0];
//            if($taskParts[0] !== $explode){
//                $modifiedTasks[] = trim($line);
//            }
//        }
        $message = "Task-deleted.";
//        file_put_contents("tasks.txt", implode("\n", $modifiedTasks).PHP_EOL);
    }elseif ($submit === "Save"){
        $stmt = $conn->prepare("UPDATE tasks SET description = :description, estimate = :estimate, assigned_to = :assigned_to WHERE id = :id");
        $stmt->bindParam(":id", $taskId);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":estimate", $estimate);
        $stmt->bindParam(":assigned_to", $assignedPerson);
        $stmt->execute();
//        $allLines = file("tasks.txt");
//        $updatedContent = [];
//        foreach ($allLines as $line1) {
//            $taskParts2 = explode(' ', trim($line1));
//            $explode1 = explode('-', $taskId)[0];
//            if ($taskParts2[0] === $explode1) {
//                $updatedContent[] = $explode1 . " " . urlencode($description) . " " . urlencode($estimate);
//            } else {
//                $updatedContent[] = trim($line1);
//            }
//        }
//        file_put_contents("tasks.txt", implode("\n", $updatedContent));
        $message = "Task-modified.";
    }
    header("Location: task-list.php?message=$message");
    exit();
}
?>


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
        <form method="POST" action="modify_task.php?taskId=<?php print $taskId;?>">
            <label for="description">Description:
                <textarea name="description" id="description" required><?php echo $description;?></textarea><br>
            </label>

            <div class="radio-container">
                <label for="Estimate">Estimate:
                    <input type="radio" id="1" value="1" name="estimate" <?php if ($estimate === '1') echo 'checked'; ?>>
                    <label for="1">1</label>
                    <input type="radio" id="2" value="2" name="estimate" <?php if ($estimate === '2') echo 'checked'; ?>>
                    <label for="2">2</label>
                    <input type="radio" id="3" value="3" name="estimate" <?php if ($estimate === '3') echo 'checked'; ?>>
                    <label for="3">3</label>
                    <input type="radio" id="4" value="4" name="estimate" <?php if ($estimate === '4') echo 'checked'; ?>>
                    <label for="4">4</label>
                    <input type="radio" id="5" value="5" name="estimate" <?php if ($estimate === '5') echo 'checked'; ?>>
                    <label for="5">5</label>
                </label>
            </div>
            <div>
                <label for="assigned-to">Assigned to:
                    <select name="employeeId" id="selectEmployee" >
                        <option value="" <?php if($assignedPerson == "" || $assignedPerson == null) echo 'selected';?>></option>
                        <?php
                        $stmt = $conn->prepare("SELECT id, first_name, last_name from employees");
                        $stmt->execute();
                        foreach ($stmt as $row) {
                        $employeeId = $row['id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $fullName = "$first_name $last_name";

                        if($assignedPerson != null && $employeeId == $assignedPerson){
                            echo "<option value='$employeeId' selected>$fullName</option>";
                        }else{
                            echo "<option value='$employeeId'>$fullName</option>";
                        }
                        }
                        ?>
        <!--                                --><?php
        //                                $employeeData = file('employees.txt', FILE_IGNORE_NEW_LINES);
        //                                foreach ($employeeData as $employeeInfo) {
        //                                    [$id, $first_name, $last_name] = explode(' ', $employeeInfo);
        //                                    $fullName = "$first_name $last_name";
        //                                    $isSelected = ($fullName == $assignedPerson) ? 'selected' : '';
        //                                    echo "<option value='$id' $isSelected>$fullName</option>";
        //                                }
        //                                ?>
                    </select>
                </label>
            </div>
            <div>
                <label for="tickBox">Completed:</label>
                <input type="checkBox" id="tickBox" name="tickBox" value="yes">
            </div>
            <div class="button-container">
                <button type="submit" name="deleteButton" id="deleteButton" value="Delete">Delete</button>
                <button type="submit" name="submitButton" id="submitButtonModify" value="Save">Save</button>
            </div>
        </form>
    </div>
</body>
<footer>icd0007 Sample Application</footer>
</html>