<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <main class="courses-tables">
        <div class="flex-title">
            <h1><i class="las la-calendar"></i> Terms</h1>
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
                    <?php if ((Auth::checkAdmin())) { ?>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <?php } ?>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($terms as $term) { ?>

                    <?php 
                    $active = $term->term_is_active == 1;
                    if (!$active && !Auth::checkAdmin()) continue ; ?> 
                    <tr <?php if ($active) echo 'class="activeTerm"' ?>>
                        <td><?= $term->term_id ?></td>
                        <td><span aria-describedby="<?= $term->term_id ?>_desc"><?= $term->term_desc ?></span></td>
                        <?php if ((Auth::checkAdmin())) { ?>
                            <td><a href="index.php?terms&edit=<?= $term->term_id ?>"><i class="las la-pen"></i>Edit</a></td>
                            <td><a href="index.php?terms&delete=<?= $term->term_id ?>"><i class="las la-trash"></i>Delete</a></td>
                            <td><a href="index.php?terms&activate=<?= $term->term_id ?>"><i class="las la-check-circle"></i>Activate</a></td>
                            <?php } ?>
                            <?php if ($active_term->term_id === $term->term_id) { ?>
                                	<td><a href="index.php?terms&add_course=<?= $term->term_id ?>"><i class="las la-edit"></i>Manage courses on term</a></td>
                            <?php } else { ?>
                                <td></td>
                            <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>



    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>