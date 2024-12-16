<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <form class="form" action="#" method="post">
        <h1><i class="las la-edit"></i>Edit course</h1>
        <input type="hidden" name="id" value="<?= $course->course_id ?>">
        <label for="name">Course name</label>
        <input required type="text" name="name" value="<?= $course->course_name ?>">
        <label for="code">Course code</label>
        <input  pattern="^[A-Z]{4}[0-9]{4}$" disabled type="text" name="code" value="<?= $course->course_id ?>">
        <label for="credits">Credits</label>
        <input required min="1" step="1" type="number" name="credits" value="<?= $course->course_credits ?>">
        <label for="desc">Description</label>
        <p class="tooltip">
            Use this field to specify information about the course. The description <strong>must</strong> be first on this text box. Then enlist
            all the prerequisites by using the <code>#Prerequisites</code> as the title and the symbol <code>-</code> for each item.
        </p>
        <textarea required type="text" name="desc" value=""><?= $course->description_bbcode() ?></textarea>
        <div class="action-group">
            <input class="action primary" type="submit" value="Update">
            <div class="loader"></div>
        </div>
    </form>

</body>

</html>