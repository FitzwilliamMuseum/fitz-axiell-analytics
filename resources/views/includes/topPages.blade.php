@if(!@empty($pages))
<div class="row">
  <div class="col-md-12">
    <div id="purchases" style="width: 100%;"></div>
    <div>
      <table class="table table-bordered table-hover ">
          <thead class="thead-dark">
            <tr>
              <th>Page title</th>
              <th>Page url accessed</th>
              <th>Users</th>
          	</tr>
          </thead>

          <tbody>
           @foreach ($pages as $item)
             <tr>
               <td >
                 {{ $item['dimensions'][1] }}
               </td>
               <td >
                 <a href="https://{{ $item['dimensions'][0] }}">{{ $item['dimensions'][0] }}</a>
               </td>
               <td>
                 {{ $item['metric'] }}
               </td>

             </tr>
           @endforeach

         </tbody>
      </table>
    </div>
  </div>
</div>

@endempty
