<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
        <form class="form" action="#" method="post">
            <h2>Are you sure you want to delete this term?</h2>
            <input disabled type="hidden" name="id" value="<?= $term->term_id ?>">
            <label for="description">Description</label>
            <input disabled type="text" name="description" value="<?= $term->term_desc ?>">
            <label for="code">Code</label>
            <input disabled type="text" name="code" value="<?= $term->term_id ?>">
            <div class="action-group">
                <input type="submit" class="action danger" value="Delete">
                <div class="loader"></div>
            </div>

        </form>

    <?php

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $term_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);

        $success = $term->delete();

        $success ? $_SESSION['success'] = 'Term deleted successfully' : $_SESSION['error'] = 'Failed to delete term';
        $terms = Term::all();
        redirect('?terms');
    }
    ?>


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