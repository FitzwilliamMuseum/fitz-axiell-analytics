<?php
namespace App\Models;
use Illuminate\Support\Facades\Http;
use Cache;

class Artworks {

  public static function getObjectData($request){
    $query = $request->query();
    $objectSearch = 'object_number="' . urlencode($query['query']) . '"';
    $priref= Http::get(env('ADLIB_URL').'?&database=objects.uf&search='. $objectSearch . '&limit=1&output=json');
    $prirefID = $priref->object();
    if(!empty($prirefID->adlibJSON->recordList)){
      $adlibQuery = $prirefID->adlibJSON->recordList->record[0]->priref[0];
      $fieldsToQuery = array(
        'admin.flag',
        'current_location',
        'current_location.type',
        'current_location.date',
        'current_location.description',
        'location',
        'location.description',
        'location.history',
        'object_category',
        'object_name',
        'object_number',
        'priref',
        'title',
        'admin.uri',
        'administration_name',
        'creator',
        'creator.role',
        'description.value',
        'identifier.accession_number',
        'lifecycle.acquisition.agents.summary_title',
        'production.place',
        'credit_line',
        'description',
        'exhibition',
        'object_history_note',
        'production.notes'
      );
      $fields = '&fields=' . implode(',', $fieldsToQuery);

      $key = md5(serialize($query['query'].$adlibQuery . $fields));
      $expiresAt = now()->addMinutes(60);
      if (Cache::has($key)) {
        $data = Cache::get($key);
      } else {
        $response = Http::get(env('ADLIB_URL').'?&database=objects.uf&search=priref='. $adlibQuery . $fields . '&limit=1&output=json');
        $data = $response->object();
        Cache::put($key, $data, $expiresAt);
      }
    } else {
      $data = [];
    }

    return $data;
  }


}
