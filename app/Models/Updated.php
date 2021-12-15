<?php
namespace App\Models;
use Illuminate\Support\Facades\Http;
use Cache;

class Updated {

  public static function getCreatedData($request){
    switch ($request->segment(2)) {
      case 'week':
        $q ='input.date%3E%22today-8%22';
        break;
      case 'month':
        $q ='input.date%3E%22today-30%22';
        break;
      case 'quarter':
        $q ='input.date%3E%22today-91%22';
        break;
      case '6month':
        $q ='input.date%3E%22today-182%22';
        break;
      case 'year':
        $q ='input.date%3E%22today-365%22';
        break;
      default:
        $q ='input.date%3E%22today-8%22';
    }
    $key = md5(serialize('created'. $q));
    $expiresAt = now()->addMinutes(60);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search=' . $q. '&limit=0&output=json');
      $data = $response->object();
      Cache::put($key, $data, $expiresAt);
    }
    return $data;
  }

  public static function getUpdatedData($request){
    switch ($request->segment(2)) {
      case 'week':
        $q ='edit.date%3E%22today-8%22';
        break;
      case 'month':
        $q ='edit.date%3E%22today-30%22';
        break;
      case 'quarter':
        $q ='edit.date%3E%22today-91%22';
        break;
      case '6month':
        $q ='edit.date%3E%22today-182%22';
        break;
      case 'year':
        $q ='edit.date%3E%22today-365%22';
        break;
      default:
        $q ='edit.date%3E%22today-8%22';
    }
    $key = md5(serialize('updated'. $q));
    $expiresAt = now()->addMinutes(60);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search=' . $q. '&limit=0&output=json');
      $data = $response->object();
      Cache::put($key, $data, $expiresAt);
    }
    return $data;
  }
}
