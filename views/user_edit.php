<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
            <form class="form" action="#" method="post">
                <input type="hidden" name="id" value="<?= $userToEdit->username ?>">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?= $userToEdit->name ?>">
                <label for="username">Username</label>
                <input disabled type="text" name="username" value="<?= $userToEdit->username ?>">
                <label for="role">Role</label>
                <input type="text" name="role" value="<?= $userToEdit->role ?>"> <!-- make this a drop down -->
                <label for="dept_id">Department</label>
                <input type="text" name="dept_id" value="<?= $userToEdit->dept_id ?>">
                <input type="submit" value="Update">
            </form>

        <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $role = filter_input(INPUT_POST, 'role', FILTER_DEFAULT);
            $dept_id = filter_input(INPUT_POST, 'dept_id', FILTER_DEFAULT);

            $userToEdit = User::find($username);

            if (empty($name) || empty($role) || empty($dept_id)) {
                $_SESSION['error'] = 'All fields are required';
            } else {
            // this will update and save the user new information
            $success = $userToEdit->update([
                'name' => $name,
                'role' => $role,
                'dept_id' => $dept_id
            ]);

            $success ? $_SESSION['success'] = 'Changed user information successfully' : $_SESSION['error'] = 'Failed to change user information';
            require_once 'index.php?users'; // having problems redirecting here (post redirect get???)
            }
        }
    ?>

    <!-- this has a temporary css (move to a css file) -->
    <style>
        :root {
            --background: #f7f7f7;
            --foreground: #333;
            --shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        form {
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 0 auto;
            padding: 10px;
            background-color: var(--background);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        form input {
            padding: 5px;
            border-radius: 5px;
            background-color: var(--background);
            color: var(--foreground);
            outline: none;
            border: none;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            cursor: pointer;
            background-color: #ff4f4f;
            color: #fff;
            backdrop-filter: blur(25px);
            border-radius: 30px;
            padding: 10px 20px;
            border: none;
            box-shadow:
                0 10px 20px rgba(0, 0, 0, 0.3),
                0 4px 8px rgba(0, 0, 0, 0.2) inset,
                0 -4px 8px rgba(255, 255, 255, 0.2) inset;
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ec0000;
            transform: translateY(-5px);
        }

        input[type="submit"]:active {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(0);
            box-shadow:
                0 10px 20px rgba(0, 0, 0, 0.3),
                0 4px 8px rgba(0, 0, 0, 0.2) inset,
                0 -4px 8px rgba(255, 255, 255, 0.2) inset;
        }

        form>* {
            margin: 5px;
        }

        .msg-box {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            font-family: sans-serif;
            font-size: 1.3em;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            padding: 5px;
            opacity: 1;
            animation: slide-up 0.5s forwards, slide-down 0.5s 3.5s forwards;
            overflow: hidden;
            max-height: 30px;
        }

        .msg-box.error {
            background-color: red;
        }

        .msg-box.normal {
            background-color: black;
        }

        .msg-box>* {
            margin: 0;
        }

        .msg-box>h1 {
            font-size: 1.2em;
            margin-bottom: 2px;
        }

        .msg-box>p {
            font-size: 0.8em;
        }

        @keyframes slide-up {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes slide-down {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-100%);
            }
        }
    </style>

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