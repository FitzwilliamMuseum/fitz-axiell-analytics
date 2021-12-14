<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Locations;

class LocationMovesController extends Controller
{

	public function moves(Request $request)
	{
		$adlibData = Locations::getLocationData($request, 'display');
		return view('moves.moves')->with('adlibData', $adlibData);
	}

	public function storage(Request $request)
	{
		$adlibData = Locations::getLocationData($request, 'storage');
		return view('moves.storage')->with('adlibData', $adlibData);
	}
}
