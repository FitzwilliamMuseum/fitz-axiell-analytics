<h2 class="display-5 text-center text-info">
  Users in this period: {{ number_format(array_sum(array_column($types->toArray(),'sessions')),0) }}
</h2>
