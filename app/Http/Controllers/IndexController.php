<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Locations;

class IndexController extends Controller
{

  public function index()
  {
    return view('index.index');
  }
}
