@php
$array = $data->adlibJSON->recordList->record;
$departments = [];
foreach ($array as $object) {
    if (isset($object->administration_name[0])) {
        $department = $object->administration_name[0]->value[1];
        if (!isset($departments[$department])) {
            $departments[$department] = 0;
        }
        $departments[$department]++;
    }
}
@endphp

<table class="table table-bordered table-striped ">
    <thead class="thead-dark">
      <tr>
        <th>Department</th>
        <th>Records</th>
    	</tr>
    </thead>

    <tbody>
     @foreach ($departments as $key => $value)
       <tr>
         <th scope="row">
           {{  $key }}
         </th>
         <td>
           {{ $value }}
         </td>
       </tr>
     @endforeach
   </tbody>
</table>
