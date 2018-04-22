<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\RoundController;
use App\Movement;
use App\Round;

/**
 * Movement controller behavior
 */
class MovementController extends Controller
{

	/**
	 * [registerMovement description]
	 * @param  [type] $movement_body [description]
	 * @return [type]                [description]
	 */
	private function registerMovement($movement_body){
		
		$round_movements = Movement::where("round_id", $movement_body["round_id"])->count();

		if ($round_movements == 0){
			RoundController::updateRoundStatus($movement_body["round_id"], "PLAYING");
		}

		$movement = new Movement(
			[
				"round_id" => $movement_body["round_id"],
				"x_axis" => $movement_body["x_axis"],
				"y_axis" => $movement_body["y_axis"],
				"wining" => $movement_body["wining"],
				"player" => $movement_body["player"] == null ? "r" : $movement_body["player"]
			]
		);
		$movement->save();
		return $movement;
	}

	/**
	 * [store description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function store(Request $request)
    {	

    	$body = $request->all();
    	$thereAreMovementsAvailable = $body["movements_counter"] < $body["max_movements"];

    	if ($body["wining"] || $body["player"] == null){
    		RoundController::updateRoundStatus($body["round_id"], "ENDED");
    	}else if (!$body["movements_counter"] == 0 && !$body["wining"]){
    		RoundController::updateRoundStatus($body["round_id"], "BLOCKED");
    	}

    	$movement = $this->registerMovement($body);

    	return json_encode($movement, 200);
    }
}
