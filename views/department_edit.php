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
            <h1><i class="las la-edit"></i>Edit department</h1>
            <input type="hidden" name="id" value="<?= $department->dept_id ?>">
            <label for="name">Department name</label>
            <input required type="text" name="name" value="<?= $department->dept_name ?>">
            <label for="code">Department code</label>
            <input disabled type="text" name="code" value="<?= $department->dept_id ?>">
            <div class="action-group">
                <input class="action primary" type="submit" value="Update">
            </div>
        </form>

    <?php

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $department_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
        $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);

        try {
            $department = Department::find($department_id);
        } catch (ModelNotFoundException $e) {
            // this means the input for department code was forcefully changed
            $department = null;
            $_SESSION['error'] = 'Department code does not match any record';
        }



        if (empty($name) || !$department) {
            $_SESSION['error'] = 'All fields are required';
            redirect('?departments&edit=' . $department_id);
        } else {
            // this will update and save the department new information
            $success = $department->update([
                'dept_name' => $name,
            ]);

            $success ? $_SESSION['success'] = 'Changed department information successfully' : $_SESSION['error'] = 'Failed to change department information';
            redirect('?departments');
        }
    }
    ?>




</body>

</html>