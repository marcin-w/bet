<?php

use App\WinsCalculator;

class WinsCalculatorTest extends TestCase
{
    private $winsCalculator;

    public function setUp()
    {
        $this->winsCalculator = new WinsCalculator();
    }

    /**
     * @dataProvider winsProvider
     */
    public function testCountWins($matches, $wins, $expected)
    {
        $this->assertEquals($expected, $this->winsCalculator->countWins($matches, $wins));
    }

    public function winsProvider()
    {
        return [
            [[], [], []],
            [
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => 1, 'betTeamId' => 1, 'won' => 0],
                ],
                [
                    1 => [
                        1 => 3,
                        2 => 6,
                    ],
                ],
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => 1, 'betTeamId' => 1, 'won' => 10],
                ],
            ],
            [
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => 1, 'betTeamId' => 1, 'won' => 0],
                    (object)['id' => 2, 'matchId' => 2, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => 2, 'betTeamId' => 1, 'won' => 0],
                ],
                [
                    1 => [
                        1 => 3,
                        2 => 0,
                    ],
                    2 => [
                        1 => 2,
                        2 => 3,
                    ],
                ],
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => 1, 'betTeamId' => 1, 'won' => 0],
                    (object)['id' => 2, 'matchId' => 2, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => 2, 'betTeamId' => 1, 'won' => -5],
                ],
            ],
            [
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => null, 'betTeamId' => 1, 'won' => 0],
                ],
                [
                    1 => [
                        1 => 3,
                        2 => 6,
                    ],
                ],
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 1, 'winner_id' => null, 'betTeamId' => 1, 'won' => 0],
                ],
            ],
            [
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 0, 'winner_id' => 1, 'betTeamId' => 1, 'won' => 0],
                ],
                [
                    1 => [
                        1 => 3,
                        2 => 6,
                    ],
                ],
                [
                    (object)['id' => 1, 'matchId' => 1, 'team1Id' => 1, 'team2Id' => 2, 'bet' => 0, 'winner_id' => 1, 'betTeamId' => 1, 'won' => 0],
                ],
            ],
        ];
    }
}
