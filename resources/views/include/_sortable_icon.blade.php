@if($sortBy !== $field)
    <i class="text-muted mdi mdi-sort"></i>
@elseif($sortDirection === 'asc')
    <i class="text-primary mdi mdi-sort-ascending"></i>
@else
    <i class="text-primary mdi mdi-sort-descending"></i>
@endif
