<?php
require 'validation.php';
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
    <title>Cars Collector</title>
</head>
<body>
<section>
    <div class="title">
        <p>Choose your car</p>
    </div>
</section>
<section class="form-section">
    <form action="storyTwo.php" method="POST">
        <label>Make: </label><br>
        <input type="text" name="make" value="<?php echo htmlspecialchars($make) ?>"><br>
        <div class="text"><?php echo $errors['make']; ?></div>
        <label>Model: </label><br>
        <input type="text" name="model" value="<?php echo htmlspecialchars($model) ?>"><br>
        <div class="text"><?php echo $errors['model']; ?></div>
        <label>Fuel Type: </label><br>
        <select name="fuel" value="<?php echo htmlspecialchars($fuel) ?>">
            <option></option>
            <option>Diesel</option>
            <option>Petrol</option>
        </select><br>
        <div class="text"><?php echo $errors['fuel']; ?></div>
        <label>Gearbox: </label><br>
        <input type="text" name="gearbox" value="<?php echo htmlspecialchars($gearbox) ?>"><br>
        <div class="text"><?php echo $errors['gearbox']; ?></div>
        <label>Year: </label><br>
        <input type="text" name="year" value="<?php echo htmlspecialchars($year) ?>"><br>
        <div class="text"><?php echo $errors['year']; ?></div>
        <input class="submit" type="submit" name="submit" value="Submit">
    </form>
    <div class="image">
        <img class="imageSize" src="img/cars.png">
    </div>
</section>
</body>
</html>



