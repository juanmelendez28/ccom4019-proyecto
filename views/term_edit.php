<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <form class="form" action="#" method="post">
        <h1>Edit term</h1>
        <input type="hidden" name="id" value="<?= $term->term_id ?>">
        <label for="description">Term Description</label>
        <input type="text" name="description" value="<?= $term->term_desc ?>">
        <label for="code">Term code</label>
        <input disabled type="text" name="code" value="<?= $term->term_id ?>">
        <div class="action-group">
            <input class="action primary" type="submit" value="Update">
            <div class="loader"></div>
        </div>
    </form>

</body>

</html>