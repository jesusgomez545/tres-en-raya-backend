<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
    	"round_id",
		"x_axis",
		"y_axis",
		"wining",
		"player"
    ];
}
