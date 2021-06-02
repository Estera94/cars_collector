<?php
require 'functions.php';
$getCars = getCarsDb();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href=" css/style.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <!-- PAGE TITLE -->
    <title>Your Collection</title>
</head>
<body>
<section>
    <div class="button">
        <a class="addmore" href="storyTwo.php">Add more cars</a>
    </div>
    <div class="title">
        <p>Your car collection</p>
    </div>
    <div>
        <?php echo displayCars($getCars); ?>
    </div>
</section>
</body>
</html>

