<?php
require 'functions.php';
$db = connectToDB();

$make = $model = $fuel = $gearbox = $year = '';

$errors = ['make'=>'',
    'model'=>'',
    'fuel'=>'',
    'gearbox'=>'',
    'year'=>''
];

if(isset($_POST['submit']))
{
    if(empty($_POST['make']))
    {
        $errors['make'] = 'Please add a make!';
    } else {
        $make = $_POST['model'];
    }

    if (empty($_POST['model'])) {
        $errors['model'] = 'Please add a model name!';
    } else {
        $model = $_POST['model'];

        $query = $db->prepare('SELECT `model` FROM `cars` WHERE `model` = ?');

        $query->execute([$model]);

        $modelDb = $query->fetchAll();

        if(!empty($modelDb)) {
            $errors['model'] = 'This model is already in the list!';
        } else {
            $model = $_POST['model'];
        }
    }

    if(empty($_POST['fuel']))
    {
        $errors['fuel'] = 'Please add a fuel type!';
    } else {
        $fuel = $_POST['fuel'];
    }

    if(empty($_POST['gearbox']))
    {
        $errors['gearbox'] = 'Please add gearbox!';
    } else {
        $gearbox = $_POST['gearbox'];
    }

    if(empty($_POST['year']))
    {
        $errors['year'] = 'Please add a year!';
    } else {
        $year = $_POST['year'];
    }

    if(!empty($errors['make']) ||!empty($errors['model'] || !empty($errors['fuel']) || !empty($errors['gearbox']) || !empty($errors['year'])))
    {
//        echo 'There are errors in the form!';
    } else {
        $make = $_POST['make'];

        $model= $_POST['model'];

        $fuel = $_POST['fuel'];

        $query = $db->prepare('SELECT `id` FROM `fuel` WHERE `fuel` = ?');

        $query->execute([$fuel]);

        $fuelDb = $query->fetchAll();

        $gearbox= $_POST['gearbox'];

        $year= $_POST['year'];

        $query = $db->prepare('INSERT INTO `cars`(`make`, `model`, `fuel_type`, `gearbox`, `year`)
                                     VALUES (?, ?, ?, ?, ?)');
        $result = $query->execute([$make, $model, $fuelDb[0]['id'], $gearbox, $year]);
        header('Location: carsCollection.php');
        exit;
    }
}
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
        <select name="fuel">
            <option>Select fuel type</option>
            <option>Diesel</option>
            <option>Petrol</option>
        </select><br>
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



