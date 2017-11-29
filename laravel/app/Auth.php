<?php
/**
 * Created by PhpStorm.
 * User: mw
 * Date: 2017-11-22
 * Time: 01:04
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{


    public function getMyResults()
    {
//        'SELECT
//          b.user_id,
//          b.match_id,
//          IF(b.team_id = m.winner_id, 1, 0) won
//          FROM `bet` b
//          JOIN `match` m ON (b.match_id = m.match_id)
//          WHERE b.user_id = 1
//          AND b.item_status = 1
//          AND m.winner_id IS NOT NULL
//          GROUP BY b.user_id, b.match_id';

        return DB::table('bet')
            ->join('match', 'bet.match_id', '=', 'match.match_id')
            ->select(
                'bet.match_id matchId',
                DB::raw('(CASE WHEN team_id = m.winner_id THEN 1 ELSE 0 END) AS won')
            )
            ->where('bet.item_status', '=', 1)
            ->where('bet.user_id', '=', 1) //todo
            ->where('match.winner_id IS NOT NULL')
            ->groupBy('bet.user_id', 'bet.match_id')
            ->get();
    }

}