<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <form class="form" action="#" method="post">
        <h1><i class="las la-edit"></i> Edit user</h1>
        <input required type="hidden" name="id" value="<?= $userToEdit->username ?>">
        <label for="name">Name</label>
        <input required type="text" name="name" value="<?= $userToEdit->name ?>">
        <label for="username">Username</label>
        <input disabled type="text" name="username" value="<?= $userToEdit->username ?>">
        <label for="role">Role</label>
        <select required name="role" id="role">
            <option value="">Select a role</option>
            <?php foreach ($valid_roles as $role) { ?>
                <option <?php if ($role === $userToEdit->role) echo 'selected'; ?> value="<?= $role ?>"><?= ucfirst($role) ?></option>
            <?php } ?>
        </select>
        <label for="dept_id">Department</label>
        <select required name="dept_id" id="deparment">
            <option value="">Select a department</option>
            <?php foreach ($departments as $department) { ?>
                <option <?php if ($department->dept_id === $userToEdit->dept_id) echo 'selected' ?> value="<?= $department->dept_id ?>"><?= $department->dept_name ?></option>
            <?php } ?>
        </select>
        <div class="action-group">
            <input class="action primary" type="submit" value="Update">
            <div class="loader"></div>
        </div>

    </form>
    
</body>

</html>