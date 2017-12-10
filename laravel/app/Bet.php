<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use JWTAuth;
use Illuminate\Http\Request;
use App\WinsCalculator;

class Bet extends Model
{
    public function get()
    {
        $bets = DB::table('bet')
            ->select(
                'match_id',
                'team_id',
                DB::raw('count(team_id) as count')
            )
            ->where('item_status', '=', 1)
            ->groupBy(
                'match_id',
                'team_id'
            )
            ->get();

        //SELECT match_id, team_id, count(team_id) FROM `bet` WHERE match_id = 1 GROUP BY match_id, team_id

        $matches = DB::table('match')
            ->join('team as team1', 'match.team1_id', '=', 'team1.team_id')
            ->join('team as team2', 'match.team2_id', '=', 'team2.team_id')
            ->leftJoin('bet', function ($join) {
                $join->on('match.match_id', '=', 'bet.match_id')->where('bet.user_id', '=', 1)->where('bet.item_status', '=', 1);
            })
            ->select(
                'match.match_id as id',
                'match.date',
                'team1.name as team1',
                'team2.name as team2',
                'team1.team_id as team1Id',
                'team2.team_id as team2Id',
                'team1.flag as team1Flag',
                'team2.flag as team2Flag',
                DB::raw('(CASE WHEN match.date <= "' . date("Y-m-d H:i:s") . '" THEN true ELSE false END) AS finished'),
                DB::raw('(CASE WHEN bet.team_id = match.team1_id THEN 1 WHEN bet.team_id = match.team2_id THEN 2 ELSE 0 END) AS bet'),
                DB::raw('0 as won'),
                'match.winner_id',
                'bet.team_id as betTeamId'
            )
            ->orderBy('id')
            ->get();

        $wins = [];
        foreach ($bets as $bet) {
            $wins[$bet->match_id][$bet->team_id] = $bet->count;
        }

        $winsCalculator = new WinsCalculator();
        return $winsCalculator->countWins($matches, $wins);
    }

    public function saveBet($matchId, $teamId)
    {
        $bet = DB::table('bet')
            ->select()
            ->where('match_id', '=', $matchId)
            ->where('user_id', '=', 1) // JWTAuth::toUser(JWTAuth::getToken())->id
            ->get();

        if (count($bet) == 1) {
            if ($teamId > 0) {
                DB::table('bet')
                    ->where('match_id', '=', $matchId)
                    ->where('user_id', '=', 1) // JWTAuth::toUser(JWTAuth::getToken())->id
                    ->update(['team_id' => $teamId, 'item_status' => 1]);
            } else {
                DB::table('bet')
                    ->where('match_id', '=', $matchId)
                    ->where('user_id', '=', 1) // JWTAuth::toUser(JWTAuth::getToken())->id
                    ->update(['item_status' => 0]);
            }
        } elseif (count($bet) == 0 && $teamId > 0) {
            DB::table('bet')->insert([
                [
                    'match_id' => $matchId,
                    'team_id' => $teamId,
                    'user_id' => 1, // JWTAuth::toUser(JWTAuth::getToken())->id
                    'item_status' => 1
                ]
            ]);
        }
    }

    public function canBet($matchId)
    {
        $match = DB::table('match')
            ->select('date')
            ->where('match_id', '=', $matchId)
            ->get();

        return $match[0]->date > date('Y-m-d H:i:s');
    }

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
                'bet.match_id AS matchId',
                DB::raw('(CASE WHEN team_id = match.winner_id THEN 1 ELSE 0 END) AS won')
            )
            ->where('bet.item_status', '=', 1)
            ->where('bet.user_id', '=', 1) // JWTAuth::toUser(JWTAuth::getToken())->id
            ->whereNotNull('match.winner_id')
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
                'match.match_id AS matchId',
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
//            ->join('bet', 'match.match_id', '=', 'bet.match_id')
            ->join('bet', function($join)
            {
                $join->on('match.match_id', '=', 'bet.match_id')->on('bet.team_id', '=', 'match.winner_id');
            })
            ->select(
                'match.match_id AS matchId',
                DB::raw('count(match.match_id) AS betWon')
            )
            ->where('bet.item_status', '=', 1)
//            ->where('bet.team_id', '=', 'match.winner_id')
            ->groupBy('match.match_id')
            ->get();
    }

    public function getMatchIds()
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
            ->select(
                'match_id AS matchId'
            )
            ->orderBy('match_id')
            ->get();
    }
}
