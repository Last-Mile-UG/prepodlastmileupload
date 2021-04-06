@php
@endphp

<a type="button" href="{{ route($route, [$entity => $id]) }}" rel="tooltip" 
    class="btn btn-success btn-icon btn-sm " 
    data-original-title="" title="">
    <i class="fa fa-edit"></i>
</a>