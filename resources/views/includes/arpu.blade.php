<h2 class="display-5 text-center text-info">
  Average revenue per online visit: £{{ number_format(array_sum(array_column($purchases->rows,2))/array_sum(array_column($types->toArray(),'sessions')),2) }}
</h2>
<p class="text-center">
  Total revenue: £{{ number_format(array_sum(array_column($purchases->rows,2)),2) }}
</p>
