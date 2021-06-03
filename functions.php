<?php

function connectToDB()
{
    $db = new PDO('mysql:host=db;dbname=collector', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function getCarsDb(): array
{
    $db = connectToDB();
    $query = $db->prepare('SELECT `make`,`model`,`fuel`,`gearbox`,`year` 
                                 FROM `cars`
                                 JOIN `fuel` on `cars` . `fuel_type` = `fuel` . `id`');
    $query->execute();
    $cars = $query->fetchAll();
    return $cars;
}

function displayCars(array $getCars): string
{
    $display = '<div class="section">';
    if (empty($getCars)) {
        $display .= '<p>Something went wrong!</p>';
    } else {
        foreach ($getCars as $cars) {
            $display .= '<div class="subSection">' .
                '<p>Make: <span>' . $cars['make'] . '</span></p>' .
                '<p>Model: <span>' . $cars['model'] . '</span></p>' .
                '<p>Fuel Type: <span>' . $cars['fuel'] . '</span></p>' .
                '<p>Gearbox: <span>' . $cars['gearbox'] . '</span></p>' .
                '<p>Year: <span>' . $cars['year'] . '</span></p>' .
                '</div>';
        }
    }
    $display .= '</div>';
    return $display;
}

function validate($postData, $db)
{
    $errors = [
        'make' => '',
        'model' => '',
        'fuel' => '',
        'gearbox' => '',
        'year' => ''
    ];

    if (empty($postData['make'])) {
        $errors['make'] = 'Please add a make!';
    }

    if (empty($postData['model'])) {
        $errors['model'] = 'Please add a model name!';
    } else {
        $query = $db->prepare('SELECT `model` FROM `cars` WHERE `model` = ?');
        $query->execute([$postData['model']]);
        $modelDb = $query->fetchAll();
        if (!empty($modelDb)) {
            $errors['model'] = 'This model is already in the list!';
        }
    }

    if (empty($postData['fuel'])) {
        $errors['fuel'] = 'Please add a fuel type!';
    }

    if (empty($postData['gearbox'])) {
        $errors['gearbox'] = 'Please add gearbox!';
    }

    if (empty($postData['year'])) {
        $errors['year'] = 'Please add a year!';
    } else {
        if (!is_numeric($_POST['year'])) {
            $errors['year'] = 'Please add a year as a number!';
        }
    }
    return $errors;
}

function insertNewCar($errors, $car, $db)
{
    $result = false;
    if (
        empty($errors['make']) &&
        empty($errors['model']) &&
        empty($errors['fuel']) &&
        empty($errors['gearbox']) &&
        empty($errors['year'])
    ) {
        $make = $car['make'];
        $model = $car['model'];
        $fuel = $car['fuel'];
        $query = $db->prepare('SELECT `id` FROM `fuel` WHERE `fuel` = ?');
        $query->execute([$fuel]);
        $fuelDb = $query->fetchAll();
        $gearbox = $car['gearbox'];
        $year = $car['year'];
        $query = $db->prepare('INSERT INTO `cars`(`make`, `model`, `fuel_type`, `gearbox`, `year`)
                                     VALUES (?, ?, ?, ?, ?)');
        $result = $query->execute([$make, $model, $fuelDb[0]['id'], $gearbox, $year]);
    }
    return $result;
}