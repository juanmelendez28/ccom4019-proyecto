<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <main>
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
                        <?php if ($user->role == 'admin') { ?>
                            <td><a href="terms/<?= $term->term_id ?>">Edit</a></td>
                            <td><a href="terms/<?= $term->term_id ?>">Update</a></td>
                            <td><a href="terms/<?= $term->term_id ?>">Delete</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        


    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>