<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="courses.css">
    <title>UPRA LOGIN</title>
</head>
<body>
    <!-- User accessing page and being redirected to their corresponding page. -->
    <header>
        <h1>User Login</h1>
    </header>
    <main>
        <form action="./login" method="POST">
            <input type="hidden" name="debug" value="login">
            <label for="username">Username:</label><br>
            <input type="username" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="pass" required><br><br>
            <input type="submit" value="Submit">
        </form> 
    </main>
    <footer>
        <p>&copy; 2024 - University of Puerto Rico at Arecibo</p>
    </footer>
</body>
</html>