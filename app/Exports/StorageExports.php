<?php

namespace App\Exports;

use App\Models\Locations;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StorageExports implements FromArray, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $data = Locations::getLocationDataCharts(request(), 'storage');
        $records = array();
        foreach($data->adlibJSON->recordList->record as $object){
          // dd($object);
          $a = array();
          $a['id'] = $object->{'@attributes'}->priref;
          $a['accessionNumber'] = $object->object_number['0'];
          $a['created'] = $object->{'@attributes'}->created;
          $a['modified'] = $object->{'@attributes'}->modification;
          $a['department'] = $object->administration_name[0]->value[1];
          $records[] = $a;
        }
        return $records;
    }

    public function headings(): array {
      return array('priref','accessionNumber','created','modified','department' );
    }

}
