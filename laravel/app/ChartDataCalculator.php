<?php

namespace App;

class ChartDataCalculator
{
    public function getData($matchIds, $myResults, $betsInMatchCount, $betsInMatchWon)
    {
        $resultArr = [0];
        $currentValue = 0;
        foreach ($matchIds as $matchId => $match) {
            if (isset($myResults[$matchId])) {
                if (1 == $myResults[$matchId]->won) {
                    $won = round($betsInMatchCount[$matchId]->betCount / $betsInMatchWon[$matchId]->betWon, 2) * 5 - 5;
                } else {
                    $won = -5;
                }

                $currentValue += $won;
            }

            $resultArr[$matchId] = $currentValue;
        }

        return $resultArr;
    }
}