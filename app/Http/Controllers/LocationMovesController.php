<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Locations;
use App\Exports\DisplayExports;
use App\Exports\StorageExports;
use Maatwebsite\Excel\Facades\Excel;

class LocationMovesController extends Controller
{

	public function moves(Request $request)
	{
		$adlibData = Locations::getLocationData($request, 'display');
		$adlibData->setPath(route('moves', [$request->segment(3)]));
		$chartData =  Locations::getLocationDataCharts($request, 'display');
		return view('moves.moves', compact('adlibData', 'chartData'));
	}

	public function storage(Request $request)
	{
		$adlibData = Locations::getLocationData($request, 'storage');
		$adlibData->setPath(route('moves.storage',[$request->segment(3)]));
		$chartData =  Locations::getLocationDataCharts($request, 'storage');
		return view('moves.storage', compact('adlibData', 'chartData'));
	}

	public function displayExport(Request $request) {
		return Excel::download(new DisplayExports, 'display' . $request->segment(3) . '.csv');
	}

	public function storageExport(Request $request) {
		return Excel::download(new StorageExports, 'storage' . $request->segment(3) . '.csv');
	}
}
