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
    foreach ($getCars as $cars) {
         $display .= '<div class="subSection">'
                        .'<p>Make: <span>'. $cars['make'] .'</span></p>
                          <p>Model: <span>'. $cars['model'] .'</span></p>
                          <p>Fuel Type: <span>'. $cars['fuel'] .'</span></p>
                          <p>Gearbox: <span>'. $cars['gearbox'] .'</span></p>
                          <p>Year: <span>'. $cars['year'] .'</span></p></div>';
    }
    $display .= '</div>';

    return $display;
}

