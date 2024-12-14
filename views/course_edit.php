<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <form class="form" action="#" method="post">
        <h1>Edit course</h1>
        <input type="hidden" name="id" value="<?= $course->course_id ?>">
        <label for="name">Course name</label>
        <input type="text" name="name" value="<?= $course->course_name ?>">
        <label for="code">Course code</label>
        <input disabled type="text" name="code" value="<?= $course->course_id ?>">
        <label for="credits">Credits</label>
        <input type="number" name="credits" value="<?= $course->course_credits ?>">
        <label for="desc">Description</label>
        <p class="tooltip">
            Use this field to specify information about the course. The description <strong>must</strong> be first on this text box. Then enlist
            all the prerequisites by using the <code>#Prerequisites</code> as the title and the symbol <code>-</code> for each item.
        </p>
        <textarea type="text" name="desc" value=""><?= $course->description_bbcode() ?></textarea>
        <input type="submit" class="action primary" value="Update">
    </form>

</body>

</html>