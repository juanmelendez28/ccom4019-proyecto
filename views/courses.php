<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    
    <main class="courses-tables">
        <!-- Dynamic table of department and its courses -->


        <div class="flex-title">
            <h1><i class="las la-chalkboard-teacher"></i> Available Courses</h1>
            
            <?php if (Auth::checkAdmin()) { ?>
                <a class="action primary" href="index.php?courses&create"><i class="las la-plus-circle"></i>Create a course</a>
            <?php } ?>
        </div>

        <?php foreach ($departments as $department) {
            $courses = $department->courses();
            if ($courses != []) {
        ?>
                <table class="tblCourses">
                    <div class="flex-title">
                        <caption><?= $department->dept_name ?> Department</caption>
                        <?php if (Auth::check() && Auth::user()->dept_id == $department->dept_id) { ?>
                            <a class="action primary" href="index.php?courses&create=<?= $department->dept_id ?>"><i class="las la-plus-circle"></i>Create a course</a>
                        <?php } ?>
                    </div>
                    </div>

                    <thead>
                        <tr>
                            <th scope="col">Course name</th>
                            <th scope="col">Course code</th>
                            <th scope="col">Credits</th>
                            <th scope="col">Description</th>
                            <?php if (Auth::check() && (Auth::checkAdmin() || Auth::user()->dept_id == $department->dept_id)) { ?>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            <?php } ?>
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
                                <?php if (Auth::check() && (Auth::checkAdmin() || Auth::user()->dept_id == $department->dept_id)) { ?>
                                    <td><a href="index.php?courses&edit=<?= $course->course_id ?>"><i class="las la-pen"></i>Edit</a></td>
                                    <td><a href="index.php?courses&delete=<?= $course->course_id ?>"><i class="las la-trash"></i>Delete</a></td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
            <?php } ?>


    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>