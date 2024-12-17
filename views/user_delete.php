<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php 
        if($user->username === Auth::user()->username) 
        {
            $_SESSION['error'] = 'You cannot delete yourself';
            redirect('?users');
        }
    ?>
        <form class="form" action="#" method="post">
            <h2>Are you sure you want to delete this user?</h2>
            <input type="hidden" name="id" value="<?= $user->username ?>">
            <label for="name">Name</label>
            <input disabled type="text" name="name" value="<?= $user->name ?>">
            <label for="username">Username</label>
            <input disabled type="text" name="code" value="<?= $user->username ?>">
            <label for="department">Department</label>
            <input disabled type="text" name="department" value="<?= $user->dept_id ?>">
            <label for="role">Role</label>
            <input disabled type="text" name="role" value="<?= $user->role ?>">
            <div class="action-group">
                <input type="submit" class="action danger" value="Delete">
                <div class="loader"></div>
            </div>
        </form>
    </body>
</html>