<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Match extends Model
{
//    public function get()
//    {
//        die('do usunieęcia');
//        $bets = DB::table('bet')
//            ->select(
//                'match_id',
//                'team_id',
//                DB::raw('count(team_id) as count')
//            )
//            ->where('item_status', '=', 1)
//            ->groupBy(
//                'match_id',
//                'team_id'
//            )
//            ->get();
//
//            //SELECT match_id, team_id, count(team_id) FROM `bet` WHERE match_id = 1 GROUP BY match_id, team_id
//
//        $matches = DB::table('match')
//            ->join('team as team1', 'match.team1_id', '=', 'team1.team_id')
//            ->join('team as team2', 'match.team2_id', '=', 'team2.team_id')
//            ->leftJoin('bet', function ($join) {
//                $join->on('match.match_id', '=', 'bet.match_id')->where('bet.user_id', '=', 1);
//            })
//            ->select(
//                'match.match_id as id',
//                'match.date',
//                'team1.name as team1',
//                'team2.name as team2',
//                DB::raw('(CASE WHEN match.date <= "' . date("Y-m-d 15:i:s") . '" THEN true ELSE false END) AS finished'),
//                DB::raw('(CASE WHEN bet.team_id = match.team1_id THEN 1 WHEN bet.team_id = match.team2_id THEN 2 ELSE 0 END) AS bet'),
//                DB::raw('0 as won'),
//                'match.winner_id'
//            )
//            ->orderBy('id')
//            ->get();
//
//        $bets2 = [];
//        foreach ($bets as $bet) {
//            $bets2[$bet->match_id][$bet->team_id] = $bet->count;
//        }
//
//        foreach ($matches as $match) {
//            if ($match->winner_id !== null && !empty($bets2[$match->id][$match->winner_id])) {
//                $match->won = array_sum($bets2[$match->id]) / $bets2[$match->id][$match->winner_id] * 5;
//            }
//        }
//        return $matches;
//    }
}
