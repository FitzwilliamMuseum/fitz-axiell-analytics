<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Locations;
use App\Models\Updated;
class IndexController extends Controller
{

  public function index(Request $request)
  {
    $display = Locations::getLocationData($request, 'display');
    $storage = Locations::getLocationData($request, 'storage');
    $created = Updated::getCreatedData($request);
    $updated = Updated::getUpdatedData($request);
    return view('index.index', compact('display', 'storage', 'created', 'updated'));
  }
}
