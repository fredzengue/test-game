<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Lastmove;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(){

        $game = Game::with('lastmoves')->orderBy('created_at','DESC')->first();
        return view('welcome')->with('game',$game);
    }
    public function newGame(){

        $str = "abcdefghijklmnopqrstuvwxyz1234567890";
        $match_id = md5(str_shuffle($str));
        $boardState = "-,-,-,-,-,-,-,-,-,";
        $game = new Game();
        $game->matchId = $match_id;
        $game->boardState = $boardState;
        $verify = $game->save();

        if ($verify) {
            $message = "la partie commence!";
        } else {
            $message = "impossible de debuter la partie";
        }
        $reponse = array(
            "message" => $message,
            "match_id" => $match_id
        );
        return json_encode($reponse);
    }
    public function saveGame(Request $request, $rowId){
        $data = $request->json()->all();

        $match_id = $data['match_id'];
        $board_state = $data['board_state'][0].','.$data['board_state'][1].','.$data['board_state'][2].','.$data['board_state'][3].','.$data['board_state'][4].','.$data['board_state'][5].','.$data['board_state'][6].','.$data['board_state'][7].','.$data['board_state'][8].',';

        //$boardState = "-,-,-,-,-,-,-,-,-,";
        $game_id = Game::where('matchId', $match_id)->first()->id;
        $verify =  Game::where('matchId', $match_id)
                        ->update([
                            'boardState' => $board_state
                            ]);
        $last_move = new Lastmove();
        $last_move->char = $data['team'];
        $last_move->position = $data['last_move'];
        $last_move->game_id = $game_id;
        $last_move->save();

        if ($verify) {
            $message = "game update!";
        } else {
            $message = "gamenotupdate";
        }
        $reponse = array(
            "message" => $message,
            "match_id" => $match_id
        );
        return json_encode($reponse);
    }
}
