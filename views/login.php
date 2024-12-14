<!DOCTYPE html>
<html lang="en">
<?php require_once 'partials/header.php'; ?>

<body>
    <!-- User accessing page and being redirected to their corresponding page. -->

    <main class="auth">


        <div class="auth-form">
            <?php require_once 'partials/logotype.php'; ?>
            <br>
            <header>
                <h1>Log in</h1>
            </header>
            <form action="./login" method="POST">
                <input type="hidden" name="path" value="login">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="pass" required><br>
                <a href="#" class="action secondary"  onclick="showPassword(this)">Show Password</a>
                <br>
                <div class="actions-split">
                    <input class="action primary" type="submit" value="Log In">
                    <a class="action secondary" href="index.php?courses">
                    <i class="las la-arrow-circle-left"></i>
                         Return to courses
                        </a>
                </div>

            </form>
        </div>
        <br>

    </main>
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
    <footer>
        <p>&copy; 2024 - University of Puerto Rico at Arecibo</p>
    </footer>
</body>

</html>