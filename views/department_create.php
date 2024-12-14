<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
<form class="form" action="#" method="post">
    <input type="hidden" name="id" value="">
    <label for="name">Department name</label>
    <input type="text" name="name" value="">
    <label for="code">Department code</label>
    <input disabled type="text" name="code" value="">
    <input type="submit" class="action primary" value="Update">
</form>
</body>

</html>