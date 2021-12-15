<?php
namespace App\Models;
use Illuminate\Support\Facades\Http;
use Cache;

class Locations {

  public static function getLocationData($request, $location){
    switch ($request->segment(3)) {
      case 'week':
        $q ='current_location.date%3E%22today-8%22%20and%20';
        break;
      case 'month':
        $q ='current_location.date%3E%22today-30%22%20and%20';
        break;
      case 'quarter':
        $q ='current_location.date%3E%22today-91%22%20and%20';
        break;
      case '6month':
        $q ='current_location.date%3E%22today-182%22%20and%20';
        break;
      case 'year':
        $q ='current_location.date%3E%22today-365%22%20and%20';
        break;
      default:
        $q ='current_location.date%3E%22today-8%22%20and%20';
    }
    $key = md5(serialize($location . $q));
    $expiresAt = now()->addMinutes(60);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search='. $q .'current_location-%3Elocation.type=' . $location . '&limit=0&output=json');
      $data = $response->object();
      Cache::put($key, $data, $expiresAt);
    }
    return $data;
  }
}
