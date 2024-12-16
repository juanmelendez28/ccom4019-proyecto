<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
<?php require_once 'partials/navbar.php'; ?>
<form class="form" action="#" method="post">
    <h1>Create a department</h1>
    <input type="hidden" name="id" value="">
    <label for="dept_name">Department name</label>
    <input required type="text" name="dept_name" value="">
    <label for="dept_code">Department code (E.g. ESPA)</label>
    <input required pattern="^[A-Z]{4}$" type="text" name="dept_code" value="">
    <div class="action-group">
    <input type="submit" class="action primary" value="Create">
    </div>
</form>

</body>

</html>