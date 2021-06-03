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
        if(!is_numeric($_POST['year'])){
            $errors['year'] = 'Please add a year as a number!';
        } else {
            $year = $_POST['year'];
        }
    }

    if (
        empty($errors['make']) &&
        empty($errors['model']) &&
        empty($errors['fuel']) &&
        empty($errors['gearbox']) &&
        empty($errors['year'])
    ) {
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

