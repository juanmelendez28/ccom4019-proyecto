<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <main>
        <!-- Dynamic table of department and its courses -->
        <?php foreach ($departments as $department) { 
                $courses = $department->courses();
                if ($courses != []) {
                    ?>
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
                                <td><span id="<?= $course->course_code ?>_desc" class="course_desc" title="<?= $course->course_desc ?>"><?= $course->course_desc ?></span></td>
                                <?php if ($user->role == 'admin' || $user->dept_id == $department->dept_id) { ?>
                                    <td><a href="index.php?courses&edit=<?= $course->course_id ?>"><button>Edit</button></a></td>
                                    <td><a href="index.php?courses&delete=<?= $course->course_id ?>"><button>Delete</button></a></td>
                                <?php } ?>
                            </tr>
                        <?php }} ?>
                </tbody>
            </table>
        <?php } ?>


    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>