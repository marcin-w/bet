<?php

use App\ChartDataCalculator;

class ChartDataCalculatorTest extends TestCase
{
    private $chartDataCalculator;

    public function setUp()
    {
        $this->chartDataCalculator = new ChartDataCalculator();
    }

    /**
     * @dataProvider chartProvider
     */
    public function testCountWins($matchIds, $myResults, $betsInMatchCount, $betsInMatchWon, $expected)
    {
        $this->assertEquals($expected, $this->chartDataCalculator->getData($matchIds, $myResults, $betsInMatchCount, $betsInMatchWon));
    }

    public function chartProvider()
    {
        return [
            [[], [], [], [], [0]],
            [
                [1 => 1, 2 => 2, 3 => 3],
                [1 => (object)['won' => 1], 2 => (object)['won' => 1], 3 => (object)['won' => 0]],
                [1 => (object)['betCount' => 8], 2 => (object)['betCount' => 6], 3 => (object)['betCount' => 7]],
                [1 => (object)['betWon' => 2], 2 => (object)['betWon' => 3], 3 => (object)['betWon' => 4]],
                [0 => 0, 1 => 15, 2 => 20, 3 => 15],
            ],
            [
                [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5],
                [1 => (object)['won' => 0], 3 => (object)['won' => 1], 4 => (object)['won' => 1]],
                [1 => (object)['betCount' => 4], 2 => (object)['betCount' => 7], 3 => (object)['betCount' => 10], 4 => (object)['betCount' => 2], 5 => (object)['betCount' => 7]],
                [1 => (object)['betWon' => 4], 2 => (object)['betWon' => 1], 3 => (object)['betWon' => 4], 4 => (object)['betWon' => 1], 5 => (object)['betWon' => 4]],
                [0 => 0, 1 => -5, 2 => -5, 3 => 2.5, 4 => 7.5, 5 => 7.5],
            ]
        ];
    }
}