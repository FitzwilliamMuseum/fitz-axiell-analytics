<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;


class LocationMovesController extends Controller
{

	public function moves(Request $request)
	{
		if (!empty($request->segment(2))) {
			switch ($request->segment(2)) {
				case 'week':
				$q ='current_location.date%3E%22today-8%22%20and%20';
				break;
				case 'month':
				$q ='current_location.date%3E%22today-30%22%20and%20';
				break;
				case 'quarter':
				$q ='current_location.date%3E%22today-91%22%20and%20';
				break;
				case '6months':
				$q ='current_location.date%3E%22today-182%22%20and%20';
				break;
				case 'year':
				$q ='current_location.date%3E%22today-365%22%20and%20';
				break;
				default:
				$q ='current_location.date%3E%22today-8%22%20and%20';
				break;
			}
			$response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search='.$q.'current_location-%3Elocation.type=display&limit=0&output=json');
			$adlibData = $response->object();
			return view('moves') ->with('adlibData', $adlibData);
		} else {
			return view('select');
		}
	}
	public function storage(Request $request)
	{
		if (!empty($request->segment(2))) {
			switch ($request->segment(2)) {
				case 'week':
				$q ='current_location.date%3E%22today-8%22%20and%20';
				break;
				case 'month':
				$q ='current_location.date%3E%22today-30%22%20and%20';
				break;
				default:
				$q ='current_location.date%3E%22today-8%22%20and%20';
				break;
			}
			$response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search='.$q.'current_location-%3Elocation.type=storage&limit=0&output=json');
			$adlibData = $response->object();
			return view('storage') ->with('adlibData', $adlibData);
		} else {
			return view('select');
		}


	}



}
