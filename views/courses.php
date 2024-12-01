<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <header>
        <h1>Free Electives</h1>
    </header>
    <main>
        <!-- Dynamic table of department and its courses -->
        <?php foreach ($departments as $department) { ?>
            <table class="tblCourses">
                <caption><?= $department->dept_name ?></caption>
                <thead>
                    <tr>
                        <th scope="col">Course name</th>
                        <th scope="col">Course code</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $courses = $department->courses();
                    foreach ($courses as $course) { ?>
                        <tr>
                            <td><?= $course->course_name ?></td>
                            <td><span aria-describedby="<?= $course->course_id ?>_desc"><?= $course->course_id ?></span></td>
                            <td><?= $course->course_credits ?></td>
                            <td><span id="<?= $course->course_code ?>_desc" class="course_desc" title="<?= $course->course_desc ?>"><?= $course->course_desc ?></span></td>
                            <td><a href="courses/<?= $course->course_id ?>">Edit</a></td>
                            <td><a href="courses/<?= $course->course_id ?>">Update</a></td>
                            <td><a href="courses/<?= $course->course_id ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>


    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>