<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Round;
use App\Status;

/**
 * Round controller behavior
 */
class RoundController extends Controller
{
	/**
	 * [updateRoundStatus update a round status ]
	 * @param  [type] $round_id    [description]
	 * @param  [type] $starus_code [description]
	 * @return [type]              [description]
	 */
	static public function updateRoundStatus($round_id, $starus_code){
		$status = Status::where('code', $starus_code)->first();
		$round = Round::find($round_id);
		$round->status_id = $status->id;
		$round->save();
	}

	/**
	 * [createNewRound Create a new round ]
	 * @return [type] [description]
	 */
	private function createNewRound(){
		$status = Status::where('code', 'NEW')->first();
		$round = new Round();
		$round->status_id = $status->id;
		$round->save();
		return $round;
	}

	/**
	 * [createRoundResponse Create a new round response ]
	 * @param  [type] $round [description]
	 * @return [type]        [description]
	 */
	private function createRoundResponse($round){
		$round_response = ['id'=>$round->id];
    	return $round_response;
	}

    /**
     * [store Exposed method to store a round ]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {	
    	$body = $request->all();
    	$rount = null;
    	if ($body["status_code"] == "NEW"){
    		$round = $this->createNewRound();
    	}
    	return json_encode($this->createRoundResponse($round), 200);
    }
}
