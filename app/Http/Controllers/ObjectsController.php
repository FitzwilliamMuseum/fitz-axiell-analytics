<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artworks;
use App\Models\Ciim;

class ObjectsController extends Controller
{
  public function index()
  {
    return view('artworks.index');
  }
  public function results(Request $request)
  {
    $data = Artworks::getObjectData($request);
    if(!empty($data)){
      $ciim = Ciim::getObject($data->adlibJSON->recordList->record[0]->priref[0]);
      return view('artworks.object', compact('data','ciim'));
    } else {
      return redirect()->route('object')->with('error','Nothing found for that reference.');
    }
  }
}
