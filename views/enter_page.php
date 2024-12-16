<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <main>
        <?php require_once 'partials/navbar.php'; ?>


        <div class="courses-wrapper">

            <?php require 'partials/logotype.php'; ?>
            <h2>Current Avaliable Courses (<?= $currentTerm->term_id ?>)</h2>
            <div class="course-grid">

                <?php
                // rendering each course
                foreach ($courses as $course) { ?>
                    <div class="course-card">
                        <p class="course-code"><span aria-describedby="<?= $course->course_id ?>_desc"><?= $course->course_id ?></span></p>
                        <p class="course-name"><?= $course->course_name ?></p>

                        <p class="course-credits">Credits: <?= $course->course_credits ?></p>
                        <p> <?= $course->course_desc ?></p>
                        <p>Prerequisites: <?= empty($course->prerequisites_as_list()) ? 'None' : implode(', ', $course->prerequisites_as_list()) ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>







    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>