<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Locations;
use App\Models\Updated;
use App\Models\Created;

class IndexController extends Controller
{

  public function index(Request $request)
  {
    $display = Locations::getLocationDataCharts($request, 'display');
    $storage = Locations::getLocationDataCharts($request, 'storage');
    $created = Created::getCreatedDataCharts($request);
    $updated = Updated::getUpdatedDataCharts($request);
    return view('index.index', compact('display', 'storage', 'created', 'updated'));
  }
}
