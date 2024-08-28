<?php
require_once "connection_function.php";
$conn = getConnection();

$error_message = "";
$first_name = "";
$last_name = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'] ?? "";
    $picture = $_FILES['picture'];
    $submit = $_POST['submitButton'] ?? "";

    if($submit === 'Save'){
        if(strlen($first_name) < 1 || strlen($first_name) > 21){
            $error_message = "First name must be 1 - 21 characters.";
        }else if(strlen($last_name) < 2 || strlen($last_name) > 22){
            $error_message = "Last name must be 2 - 22 characters.";
        }else{
            $stmt = $conn->prepare(
                'INSERT INTO employees (first_name, last_name) VALUES (:first_name, :last_name);');
            $stmt->bindValue(':first_name', $first_name);
            $stmt->bindValue(':last_name', $last_name);
            $stmt->execute();
            header("Location: employee-list.php?message=Employee-added-successfully."); //redirect to employee-list.php after saving data
            exit();//script execution stops

        }

//            $id = $conn->lastInsertId();
//            // Validate and move uploaded file
////            if ($picture['error'] == 0 && in_array($picture['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
////                move_uploaded_file($picture['tmp_name'], 'photos/pic'.$id.'.jpg');
////            } else {
////                $error_message = "Invalid picture uploaded.";
////            }
//            move_uploaded_file($picture['tmp_name'], 'photos/pic'.$id.'.jpg');
//
//            //            file_put_contents("employees.txt", $id." $first_name $last_name". PHP_EOL, FILE_APPEND); //join stringiks

    }
}
//function getNewId(): string {
//    $id = file_get_contents('next-idEmployee.txt');
//    file_put_contents('next-idEmployee.txt', intval($id) + 1);
//    return $id;
//}
//?>

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
    <?php echo "<div id='error-block'>$error_message</div>"?>
    <form action="employee-form.php" method="POST" enctype="multipart/form-data">
        <label for="firstName"> First name:
            <input type="text" id="firstName" name="firstName" required value="<?php echo htmlspecialchars($first_name); ?>">
        </label>
        <label for="lastName"> Last name:
            <input type="text" id="lastName" name="lastName" required value="<?php echo htmlspecialchars($last_name); ?>">
        </label>
        <label for="file">Picture:
            <input type="file" class="choose-file" id="file" name="picture" accept="image/*"><br>
        </label>
        <button type="submit" name="submitButton" id="submitButton" value="Save">Save</button>
    </form>
</div>
</body>
<footer>icd0007 Sample Application</footer>
</html>