<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <main>
        <?php require_once 'partials/navbar.php'; ?>
        <table class="tblCourses">
            <caption>Current Avaliable Courses (<?= $currentTerm->term_id ?>)</caption>
            <thead>
                <tr>
                    <th scope="col">Course name</th>
                    <th scope="col">Course code</th>
                    <th scope="col">Credits</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // rendering each course
                foreach ($courses as $course) { ?>
                    <tr>
                        <td><?= $course->course_name ?></td>
                        <td><span aria-describedby="<?= $course->course_id ?>_desc"><?= $course->course_id ?></span></td>
                        <td><?= $course->course_credits ?></td>
                        <?php
                        $course_summary = substr($course->course_desc, 0, 100);
                        if (strlen($course->course_desc) > 100) {
                            $course_summary .= '...';
                        }
                        ?>
                        <td><span id="<?= $course->course_code ?>_desc" class="course_desc" title="<?= $course->course_desc ?>"><?= $course_summary ?></span></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>