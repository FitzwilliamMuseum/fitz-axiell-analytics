<?php
namespace App\Models;
use Illuminate\Support\Facades\Http;
use Cache;

class Ciim {

  public static function getObject(int $id){
    $key = md5(serialize($id. 'collectionsexplorer'));
    $expiresAt = now()->addMinutes(60);
    if (Cache::has($key)) {
      $data = Cache::get($key);
    } else {
      $response = Http::get(env('COLLECTION_URL').'/id/object/'. $id . '/json');
      $data = $response->object();
      Cache::put($key, $data, $expiresAt);
    }
    return $data;
  }
}
