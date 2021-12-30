<?php

namespace App\Exports;

use App\Models\Created;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CreatedExports implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $data = Created::getCreatedDataCharts(request());
        $records = array();
        foreach($data->adlibJSON->recordList->record as $object){
          $row = array();
          $row['id'] = $object->{'@attributes'}->priref;
          $row['accessionNumber'] = $object->object_number['0'];
          $row['created'] = $object->{'@attributes'}->created;
          $row['modified'] = $object->{'@attributes'}->modification;
          $row['department'] = $object->administration_name[0]->value[1];
          $records[] = $row;
        }
        return $records;
    }
    /**
     * [headings description]
     * @return array [description]
     */
    public function headings(): array {
      return array(
        'priref',
        'accessionNumber',
        'created',
        'modified',
        'department'
      );
    }
}
