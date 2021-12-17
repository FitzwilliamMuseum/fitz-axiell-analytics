<?php
namespace App\Models;
use Illuminate\Support\Facades\Http;
use Cache;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Created {

  public static function getCreatedData($request = NULL){
    $perPage = 12;
    $offset = ($request->page -1) * $perPage ;
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
    $sort = urlencode(' sort input.date descending ');
    $key = md5(serialize('created'. $q . $sort . $request->page));
    $expiresAt = now()->addMinutes(60);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search=' . $q . $sort . '&limit=' . $perPage . '&startfrom=' . $offset . '&output=json');
      $data = $response->object();
      Cache::put($key, $data, $expiresAt);
    }
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $paginator = new LengthAwarePaginator($data, $data->adlibJSON->diagnostic->hits, $perPage, $currentPage);
    return $paginator;
  }

  public static function getCreatedDataCharts($request = NULL){
    if(!is_null($request)){
      $request = $request->segment(2);
    }
    switch ($request) {
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
    $key = md5(serialize('createdCharts'. $q));
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
