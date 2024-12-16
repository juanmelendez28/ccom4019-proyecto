<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/courses.css">
    <link rel="stylesheet" href="css/crash.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/animations.css">


    <script src="js/submitButton.js" defer></script>
    <script src="js/messages.js" defer></script>
    <script src="js/modals.js" defer></script>

    <link rel="shortcut icon" href="resources/img/favicon.svg" type="image/x-icon">

    <title>Free Electives</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
</head>

<?php if (isset($_SESSION['success'])){ ?>
    <div class="alert msg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
        <div class="progress"></div>
    </div>
<?php unset($_SESSION['success']); }  ?>

<?php if (isset($_SESSION['error'])){ ?>
    <div class="alert error">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
        <div class="progress"></div>
    </div>
<?php  unset($_SESSION['error']); } ?>