<?php

require '../functions.php';

use PHPUnit\Framework\TestCase;

class functions extends TestCase
{
    public function testDisplayCars_succes()
    {
        $input = [
            [
                'make' => 'ford',
                'model' => 'mondeo',
                'fuel' => 'diesel',
                'gearbox' => 'manual',
                'year' => '2021'
            ]
        ];

        $expected = '<div class="section"><div class="subSection">' .
            '<p>Make: <span>ford</span></p>' .
            '<p>Model: <span>mondeo</span></p>' .
            '<p>Fuel Type: <span>diesel</span></p>' .
            '<p>Gearbox: <span>manual</span></p>' .
            '<p>Year: <span>2021</span></p>' .
            '</div></div>';
        $result = displayCars($input);
        $this->assertEquals($expected, $result);
    }

    public function testDisplayCars_failure()
    {
        $input = [];
        $result = displayCars($input);
        $expected = '<div class="section"><p>Something went wrong!</p></div>';
        $this->assertEquals($expected, $result);
    }

    public function testDisplayCarsMalformed()
    {
        $input = "";
        $this->expectException(TypeError::class);
        displayCars($input);
    }
}