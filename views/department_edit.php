<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    
    <?php
        require_once 'partials/navbar.php';

        if ($_GET['edit'] && $_SERVER['REQUEST_METHOD'] != 'POST') {
            require_once 'models/Department.php';
            $department_id = $_GET['edit'];
            $department = Department::find($department_id); ?>

            <form class="form" action="#" method="post">
                <h1>Edit department</h1>
                <input type="hidden" name="id" value="<?= $department->dept_id ?>">
                <label for="name">Department name</label>
                <input type="text" name="name" value="<?= $department->dept_name ?>">
                <label for="code">Department code</label>
                <input disabled type="text" name="code" value="<?= $department->dept_id ?>">
                <input type="submit" class="action primary" value="Update">
            </form>

        <?php

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $department_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);

            $department = Department::find($department_id);

            if (empty($name)) {
                $_SESSION['error'] = 'All fields are required';
            } else {
            // this will update and save the department new information
            $success = $department->update([
                'dept_name' => $name,
            ]);

            $success ? $_SESSION['success'] = 'Changed department information successfully' : $_SESSION['error'] = 'Failed to change department information';
            $departments = Department::all();
            require_once 'views/departments.php';
            }
        }
    ?>




</body>

</html>