<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
        <form class="form" action="#" method="post">
            <h2>Are you sure you want to activate this term?</h2>
            <input disabled type="hidden" name="id" value="<?= $term->term_id ?>">
            <label for="description">Description</label>
            <input disabled type="text" name="description" value="<?= $term->term_desc ?>">
            <label for="code">Code</label>
            <input disabled type="text" name="code" value="<?= $term->term_id ?>">
            <div class="action-group">
                <input type="submit" class="action primary" value="Activate">
                <div class="loader"></div>
            </div>

        </form>

    <?php

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $terms = Term::all();
        foreach ($terms as $tempTerm) {
            $tempTerm->update([
                'term_is_active' => 0,
            ]);
        }

        $term_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
        $success = $term->update([
            'term_is_active' => 1,
        ]);

        $success ? $_SESSION['success'] = 'Term activated successfully' : $_SESSION['error'] = 'Failed to activated term';
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