<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests;
use App\Bet;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use JWTAuth;

class BetController extends Controller
{
    protected $bet;

    public function __construct(Bet $bet)
    {
//        $this->middleware('auth');
//        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
        $this->bet = $bet;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $user = Auth::user();

//        $jsonData = $this->bet->get();
//        $response = new Response();
//        $response->setContent($jsonData);
//
//        return $response;

//        $user = JWTAuth::parseToken()->authenticate();
//        var_dump($user);

        return new Response($this->bet->get());
//        return view('BetApp/index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($matchId, $teamId)
    {
        if ($this->bet->canBet($matchId)) {
            $this->bet->saveBet($matchId, $teamId);
            return new Response(json_encode(array('success' => true)));
        }

        return new Response(json_encode(array('success' => false)));
    }
//
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $matchIds = $this->transform($this->bet->getMatchIds());
        $myResults = $this->transform($this->bet->getMyResults());
        $betsInMatchCount = $this->transform($this->bet->getBetsInMatchCount());
        $betsInMatchWon = $this->transform($this->bet->getBetsInMatchWon());

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

        return new Response($resultArr);
    }

    private function transform($array)
    {
        $newArray = [];
        foreach ($array as $value) {
            $newArray[$value->matchId] = $value;
        }

        return $newArray;
    }

}
