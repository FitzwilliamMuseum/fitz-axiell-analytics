<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artworks;

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
      return view('artworks.object', compact('data'));
    } else {
      return redirect()->route('object')->with('error','Nothing found for that reference.');
    }
  }
}
