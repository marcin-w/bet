<?php

namespace App;

class WinsCalculator
{
    public function countWins($matches, $wins)
    {
        foreach ($matches as $match) {
            if ($match->winner_id !== null && !empty($wins[$match->id]) && $match->bet > 0) {
                $betsQuantity = array_sum($wins[$match->id]);
                if ($match->betTeamId == $match->winner_id) {
                    $match->won = $betsQuantity / $wins[$match->id][$match->winner_id] * 5 - 5;
                } else {
                    $match->won = -5;
                }
            }
        }

        return $matches;
    }
}