<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
        
        if(!Auth::checkAdmin() && Auth::user()->dept_id !== $course->dept_id){
            $_SESSION['error'] = 'You don\'t have permissions to delete this course';
            redirect('?courses');
        }
        ?>
        <form class="form" action="#" method="post">
            <h2>Are you sure you want to delete this course?</h2>
            <input disabled type="hidden" name="id" value="<?= $course->course_id ?>">
            <label for="name">Course name</label>
            <input disabled type="text" name="name" value="<?= $course->course_name ?>">
            <label for="code">Course code</label>
            <input disabled type="text" name="code" value="<?= $course->course_id ?>">
            <label for="credits">Credits</label>
            <input disabled type="number" name="credits" value="<?= $course->course_credits ?>">
            <label for="desc">Description</label>
            <input disabled type="text" name="desc" value="<?= $course->course_desc ?>">
            <div class="action-group">
            <input type="submit" class="action danger" value="Delete">
            <div class="loader"></div>
            </div>
        </form>

    <?php

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $course_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);

        $success = $course->delete();

        $success ? $_SESSION['success'] = 'Course deleted successfully' : $_SESSION['error'] = 'Failed to delete course';
        $departments = Department::all();
        redirect('?courses');
    }
    ?>

    <!-- this has a temporary css (move to a css file) -->


    <?php if (isset($_SESSION['error'])): ?>
        <div class="msg-box error">
            <p><?= $_SESSION['error'] ?></p>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="msg-box normal">
            <p><?= $_SESSION['success'] ?></p>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>




</body>

</html>