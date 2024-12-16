<?php require_once "partials/header.php" ?>

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
        <?php require_once "partials/navbar.php" ?>
        <form class="form" action="#" method="post">
            <h1>Add course to term</h1>

            <?php foreach ($courses as $course) { ?>
            <label for="<?= $course->course_id ?>">
                <input type="checkbox" id="<?= $course->course_id ?>" name="selected_courses[]" 
                value="<?= $course->course_id ?>" > 
                <?= $course->course_id ?>
            </label>
            <?php } ?>
            <input disabled type="hidden" name="id" value="<?= $term->term_id ?>">
                <input type="submit" class="action primary" value="Add Courses">
            </div>
        </form>
        <?php } ?>
        



</body>