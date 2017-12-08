<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Chart extends Model
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
            ->where('bet.user_id', '=',  1) // JWTAuth::toUser(JWTAuth::getToken())->id
            ->where('match.winner_id IS NOT NULL')
            ->groupBy('bet.user_id', 'bet.match_id')
            ->get();
    }

    public function getBetsInMatchCount()
    {
//        'SELECT
//          m.match_id,
//          count(m.match_id) betCount
//          FROM `match` m
//          JOIN bet b ON (b.match_id = m.match_id)
//          WHERE b.item_status = 1
//          GROUP BY m.match_id';

        return DB::table('match')
            ->join('bet', 'match.match_id', '=', 'bet.match_id')
            ->select(
                'match.match_id matchId',
                DB::raw('count(match.match_id) AS betCount')
            )
            ->where('bet.item_status', '=', 1)
            ->groupBy('match.match_id')
            ->get();
    }

    public function getBetsInMatchWon()
    {
//       SELECT
//          m.match_id,
//          count(m.match_id) betWon
//          FROM `match` m
//          JOIN bet b ON (b.match_id = m.match_id)
//          WHERE b.item_status =1
//          AND b.team_id = m.winner_id
//          GROUP BY m.match_id

        return DB::table('match')
            ->join('bet', 'match.match_id', '=', 'bet.match_id')
            ->select(
                'match.match_id matchId',
                DB::raw('count(match.match_id) AS betWon')
            )
            ->where('bet.item_status', '=', 1)
            ->groupBy('match.match_id')
            ->get();
    }
}