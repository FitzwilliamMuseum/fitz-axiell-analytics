<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Updated;

class CreatedController extends Controller
{

	public function index(Request $request)
	{
		$adlibData = Updated::getCreatedData($request);
		return view('records.created')->with('adlibData', $adlibData);
	}
	public function updated(Request $request)
	{
		$adlibData = Updated::getUpdatedData($request);
		return view('records.updated')->with('adlibData', $adlibData);
	}

}
