<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <main class="courses-tables">
        <div class="flex-title">
            <h1><i class="las la-users"></i> Users </h1>
            <?php if (Auth::checkAdmin()) { ?>
                <a class="action primary" href="index.php?users&create"><i class="las la-plus-circle"></i>Create a user</a>
            <?php } ?>
        </div>
        <!-- Dynamic table of users -->
        <table class="tblCourses">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Department</th>
                    <th scope="col">Role</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->name ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= Department::findBy(['dept_id' => $user->dept_id])->dept_name ?></td>
                        <td><?= $user->role ?></td>
                        <?php if ((Auth::checkAdmin())) { ?>
                            <td><a href="index.php?users&edit=<?= $user->username ?>"><i class="las la-pen"></i> Edit</a></td>

                        <?php }
                        if (Auth::user()->username !== $user->username) { ?>
                            <td><a href="index.php?users&delete=<?= $user->username ?>"> <i class="las la-trash"> </i> Delete</a></td>
                        <?php } else { ?>
                            <td>Can't delete yourself</td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>