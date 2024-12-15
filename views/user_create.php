<?php require_once 'partials/header.php'; ?>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <form class="form" action="#" method="post">
        <h1>Create user</h1>
        <label for="name">Name</label>
        <input required type="text" name="name" value="">
        <label for="username">Username</label>
        <input required type="text" name="username" value="">
        <label for="password">Password</label>
        <input pattern="^.{8}$" required id="password" type="password" name="password" value="">
        <span>* The password must consist of 8 characters minimum</span>
        <a href="#" class="action secondary" onclick="showPassword(this)">Show Password</a>
        <label for="role">Role</label>
        <select required name="role" id="role">
            <option value="">Select a role</option>
            <?php foreach ($valid_roles as $role) { ?>
                <?php if($role === 'admin') continue; ?>
                <option value="<?= $role ?>"><?= ucfirst($role) ?></option>
            <?php } ?>
        </select>
        <label for="dept_id">Department</label>
        <select name="dept_id" id="deparment">
            <option value="">Select a department</option>
            <?php foreach ($departments as $department) { ?>
                <option value="<?= $department->dept_id ?>"><?= $department->dept_name ?></option>
            <?php } ?>
        </select>
        <input class="action primary" type="submit" value="Create">
    </form>
    <script>
        function showPassword(actionTag) {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                actionTag.innerText = "Hide Password";
                passwordField.type = "text";
            } else {
                actionTag.innerText = "Show Password";
                passwordField.type = "password";
            }
        }
    </script>
    <?php require_once 'partials/footer.php' ?>
</body>