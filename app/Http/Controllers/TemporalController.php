<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Updated;
use App\Models\Created;
use App\Exports\CreatedExports;
use App\Exports\UpdatedExports;

use Maatwebsite\Excel\Facades\Excel;

class TemporalController extends Controller
{
	/**
	 * [index description]
	 * @param  Request $request               [description]
	 * @return [type]           [description]
	 */
	public function created(Request $request) {
		$adlibData = Created::getCreatedData($request);
		$adlibData->setPath(route('created', [$request->segment(2)]));
		$chartData =  Created::getCreatedDataCharts($request);
		return view('records.created', compact('adlibData', 'chartData'));
	}

	public function createdExport(Request $request) {
		return Excel::download(new CreatedExports, 'created'.$request->segment(3).'.csv');
	}

	/**
	 * [updated description]
	 * @param  Request $request               [description]
	 * @return [type]           [description]
	 */
	public function updated(Request $request) {
		$adlibData = Updated::getUpdatedData($request);
		$adlibData->setPath(route('updated', [$request->segment(2)]));
		$chartData =  Updated::getUpdatedDataCharts($request);
		return view('records.updated', compact('adlibData', 'chartData'));
	}

	public function updatedExport(Request $request) {
		return Excel::download(new UpdatedExports, 'updated'.$request->segment(3).'.csv');
	}
}
