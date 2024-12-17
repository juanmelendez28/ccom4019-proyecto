<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>

    <?php require_once 'partials/navbar.php'; ?>

    <form class="form" action="#" method="post">
        <h1><i class="las la-edit"></i>Edit department</h1>
        <input type="hidden" name="id" value="<?= $department->dept_id ?>">
        <label for="name">Department name</label>
        <input required type="text" name="name" value="<?= $department->dept_name ?>">
        <label for="code">Department code</label>
        <input disabled type="text" name="code" value="<?= $department->dept_id ?>">
        <div class="action-group">
            <input class="action primary" type="submit" value="Update">
            <div class="loader"></div>
        </div>
    </form>
</body>

</html>