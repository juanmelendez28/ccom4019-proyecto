<?php require_once "partials/header.php" ?>

<body>
<?php require_once "partials/navbar.php" ?>
    <form class="form" action="#" method="post">
        <h1>Create a Term</h1>

        <label for="name">Term code (E.g. C41)</label>
        <input required type="text" pattern="^[A-Z]{1}[0-9]{2}$" name="term" value="">
        <label for="code">Description</label>
        <textarea required name="description" value=""></textarea>
        <input type="submit" class="action primary" value="Create">
    </form>
</body>

