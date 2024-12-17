<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <form class="form" action="#" method="post">
        <h2>Are you sure you want to delete this department?</h2>
        <input disabled type="hidden" name="id" value="<?= $department->dept_id ?>">
        <label for="name">Department name</label>
        <input disabled type="text" name="name" value="<?= $department->dept_name ?>">
        <label for="code">Department code</label>
        <input disabled type="text" name="code" value="<?= $department->dept_id ?>">
        <div class="action-group">
            <input type="submit" class="action danger" value="Delete">
            <div class="loader"></div>
        </div>


    </form>


    <?php if (isset($_SESSION['error'])): ?>
        <div class="msg-box error">
            <p><?= $_SESSION['error'] ?></p>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="msg-box normal">
            <p><?= $_SESSION['success'] ?></p>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>




</body>

</html>