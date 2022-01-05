<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Analytics;
use App\Models\AnalyticsFour;
use Spatie\Analytics\Period;


class GoogleController extends Controller
{
  public function createPeriod(string $period = NULL){
    switch ($period) {
      case 'week':
        $start_date = 7;
        break;
      case 'month':
        $start_date = 30;
        break;
      case 'quarter':
        $start_date = 91;
        break;
      case '6month':
        $start_date = 182;
        break;
      case 'year':
        $start_date = 365;
        break;
      default:
        $start_date = 7;
    }
    return  $start_date;
  }
  public function index(Request $request)
  {
    $users   = AnalyticsFour::fetchUserCounts($request->segment(3));
    $devices = AnalyticsFour::fetchUserDevices( $request->segment(3) );
    $country = AnalyticsFour::fetchUsersByCountry( $request->segment(3) );
    $pages = AnalyticsFour::fetchTopPages( $request->segment(3) );
    return view('analytics.main', compact('users', 'country', 'devices', 'pages'));
  }
  public function collection(Request $request)
  {
    $users   = AnalyticsFour::fetchUserCounts($request->segment(3), 'collection' );
    $devices = AnalyticsFour::fetchUserDevices( $request->segment(3), 'collection' );
    $country = AnalyticsFour::fetchUsersByCountry( $request->segment(3), 'collection' );
    $pages = AnalyticsFour::fetchTopPages( $request->segment(3), 'collection');

    return view('analytics.collection', compact('users', 'country','devices', 'pages'));
  }
  public function tessitura(Request $request){
    $days = $this->createPeriod($request->segment(3));

    $types    = Analytics::fetchUserTypes(Period::days($days));
    $visitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days($days));
    $purchases= Analytics::performQuery(Period::days($days), 'ga:itemQuantity,ga:itemRevenue', array('dimensions'=>'ga:productName','sort' => '-ga:itemRevenue'));
    return view('analytics.tessitura', compact('purchases','types','visitors'));
  }
}
