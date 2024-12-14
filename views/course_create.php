<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <form class="form" action="#" method="post">
        <h1>Create course</h1>
        <input type="hidden" name="id" value="">

        <label for="department">Department</label>
        <select required name="department" id="department">
            <option value="">Select a department</option>
            <?php foreach ($departments as $department) { ?>
                <option value="<?= $department->dept_id ?>"><?= $department->dept_name ?></option>
            <?php } ?>
        </select>
        <label for="name">Course name</label>
        <input required type="text" name="name" value="">
        <label for="code">Course code</label>
        <input required type="text" name="code" value="">
        <label for="credits">Credits</label>
        <input required type="number" name="credits" value="">
        <label for="desc">Description</label>
        <p class="tooltip">
            Use this field to specify information about the course. The description <strong>must</strong> be first on this text box. Then enlist
            all the prerequisites by using the <code>#Prerequisites</code> as the title and the symbol <code>-</code> for each item.
        </p>
        <textarea required type="text" name="description" value=""></textarea>
        <input type="submit" class="action primary" value="Save">
    </form>
</body>

</html>