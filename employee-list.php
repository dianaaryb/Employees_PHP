<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees</title>
    <link rel="stylesheet" href="webPageStyles.css">
</head>
<body id="employee-list-page">
<nav>
    <a href="index.php" id="dashboard-link">Dashboard</a> |
    <a href="employee-list.php" id="employee-list-link">Employees</a> |
    <a href="employee-form.php" id="employee-form-link">Add Employee</a> |
    <a href="task-list.php" id="task-list-page">Tasks</a> |
    <a href="task-form.php" id="task-form-link">Add Task</a>
</nav>
<div class="content-card">Employees</div>
    <div class="content-card-frame">
            <table class="employee-item">
                <div id="message-block">
                    <?php
                    if(!empty($_GET['message'])){
                        $message = $_GET['message'];
                        echo $message;
                    }
                    ?>
                </div>
                <?php
                require_once "connection_function.php";
                $conn = getConnection();

                $stmt = $conn->prepare("SELECT id, first_name, last_name FROM employees");
                $stmt->execute();
                $first_name = "";
                $last_name = "";
                $id = "";

                foreach ($stmt as $row){
                    $id = $row['id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $imagePath = "photos/pic$id.jpg";
                    echo "<div class='employee-item'>
                                <span>
                                    <img src='" . htmlspecialchars($imagePath) . "' alt='Employee Photo' data-employee-id='" . htmlspecialchars($id) . "'>
                                    <div data-employee-id='" . htmlspecialchars($id) . "'>" . htmlspecialchars($first_name . " " . $last_name) . "</div>
                                    <a class='employee-edit' id='employee-edit-link-" . htmlspecialchars($id) . "' href='modify_employee.php?data=".htmlspecialchars($id)."-".htmlspecialchars($first_name)."-".htmlspecialchars($last_name)."'>Edit</a>
                                    <div class='role'>Default</div>
                                </span>
                            </div>";

//                    echo "<div class='employee-item'>
//                           <span>
//                                <img src='$imagePath' alt='Employee Photo' data-employee-id='$id'>
//                           <p data-employee-id='$id'>$first_name $last_name</p><a class='employee-edit' id='employee-edit-link-$id' href='modify_employee.php?data=$id-$first_name-$last_name'>Edit</a>
//                           <p class='role'>Default</p></span>
//                    </div>";
                }

//                $employeeData = file("employees.txt");
//                foreach ($employeeData as $employee){
//                        $nameParts = explode(" ", $employee);
//                        if(count($nameParts) >= 2){
//                            $id = urldecode($nameParts[0]);
//                            $first_name = urldecode($nameParts[1]);
//                            $last_name = trim(urldecode($nameParts[2]));
//                            $imagePath = "photos/pic$id.jpg";
//                        }else{
//                            continue; //skip displaying new row for this employee
//                        }
//                    echo "<div class='employee-item'>
//                           <span><img src='$imagePath' alt='Employee Photo' data-employee-id='$id'>
//                           <p data-employee-id='$id'>$first_name $last_name</p><a class='employee-edit' id='employee-edit-link-$id' href='modify_employee.php?data=$id-$first_name-$last_name'>Edit</a>
//                           <p class='role'>Default</p></span>
//                    </div>";
//                }
                ?>
            </table>
</div>
</body>
<footer>icd0007 Sample Application</footer>
</html>