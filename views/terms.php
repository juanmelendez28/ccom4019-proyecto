<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <main class="courses-tables">
        <div class="flex-title">
            <h1>Terms</h1>
            <?php if (Auth::checkAdmin()) { ?>
                <a class="action primary" href="index.php?terms&create"><i class="las la-plus-circle"></i>Create a term</a>
            <?php } ?>
        </div>
        <!-- Dynamic table of terms -->
        <table class="tblCourses">
            <thead>
                <tr>
                    <th scope="col">Term</th>
                    <th scope="col">Details</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($terms as $term) { ?>
                    <tr <?php if ($term->term_is_active == 1) echo 'class="activeTerm"' ?>>
                        <td><?= $term->term_id ?></td>
                        <td><span aria-describedby="<?= $term->term_id ?>_desc"><?= $term->term_desc ?></span></td>
                        <?php if ((Auth::checkAdmin())) { ?>
                            <td><a href="index.php?terms&edit=<?= $term->term_id ?>"><i class="las la-pen"></i>Edit</a></td>
                            <td><a href="index.php?terms&delete=<?= $term->term_id ?>"><i class="las la-trash"></i>Delete</a></td>
                            <td><a href="index.php?terms&activate=<?= $term->term_id ?>"><i class="las la-check-circle"></i>Activate</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>



    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>