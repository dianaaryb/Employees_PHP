<?php
require_once "connection_function.php";
$conn = getConnection();

$first_name = "";
$last_name = "";
$id = "";
if(!empty($_GET['data'])){
    $data = $_GET['data'];
    $id = explode("-", $data)[0];
    $first_name = explode("-", $data)[1];
    $last_name = explode("-", $data)[2];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $delete = $_POST['deleteButton'] ?? "";
    $submit = $_POST['submitButton'] ?? "";

    $id = $_GET['id'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $message = "";
    $modifiedContent = array();

    if($delete === "Delete"){
        $stmt = $conn->prepare("DELETE FROM employees WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
//        $lines = file("employees.txt");
//        foreach ($lines as $line){
//            $nameParts = explode(' ', trim($line));
//            if($nameParts[0] !== $id){
//                $modifiedContent[] = trim($line).PHP_EOL;
//            }
//        }
        $message = "Employee-deleted.";
    }else if ($submit === "Save"){
        $stmt = $conn->prepare("UPDATE employees SET first_name = :first_name, last_name = :last_name WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->execute();
//        $allLines = file("employees.txt");
//        foreach ($allLines as $line1) {
//            $nameParts2 = explode(' ', trim($line1));
//            if ($nameParts2[0] === $id) {
//                $modifiedContent[] = $id . " " . urlencode($first_name) . " " . urlencode($last_name) .PHP_EOL;
//            } else {
//                $modifiedContent[] = trim($line1).PHP_EOL;
//            }
//        }
        $message = "Employee-modified.";
}
//    file_put_contents("employees.txt", implode(PHP_EOL, $modifiedContent));
    header("Location: employee-list.php?message=$message");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add employee</title>
    <link rel="stylesheet" href="webPageStyles.css">
</head>
<body id="employee-form-page">
<nav>
    <a href="index.php" id="dashboard-link">Dashboard</a> |
    <a href="employee-list.php" id="employee-list-link">Employees</a> |
    <a href="employee-form.php" id="employee-form-link">Add Employee</a> |
    <a href="task-list.php" id="task-list-page">Tasks</a> |
    <a href="task-form.php" id="task-form-link">Add Task</a>
</nav>
<div class="content-card">Add Employee</div>
<div class="content-card-frame">
    <form method="POST" action="modify_employee.php?id=<?php print $id;?>">
        <label for="firstName"> First name:
            <input type="text" id="firstName" name="firstName" required value="<?php echo $first_name?>">
        </label>
        <label for="lastName"> Last name:
            <input type="text" id="lastName" name="lastName" required value="<?php echo $last_name?>">
        </label>
        <label for="file">Picture:
            <input type="file" class="choose-file" id="file"><br>
        </label>
        <div class="button-container">
            <button type="submit" name="deleteButton" id="deleteButton" value="Delete">Delete</button>
            <button type="submit" name="submitButton" id="submitButtonModify" value="Save">Save</button>
        </div>
    </form>
</div>
</body>
<footer>icd0007 Sample Application</footer>
</html>