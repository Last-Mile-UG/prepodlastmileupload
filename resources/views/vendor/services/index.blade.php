@extends('layouts.app', [
    'namePage' => 'Categories List',
    'class' => 'sidebar-mini',
    'activePage' => 'Categories List',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="row justify-content-between">

          </div>
          <div class="card-header">
            <h4 class="card-title">{{__('msg.categoryvend')}}</h4>
          </div>
          <div class="card-body">
            @include('alerts.success')
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>{{__('msg.id')}}</th>
                    <th>{{__('msg.title')}}</th>
                    <th>{{__('msg.status')}}</th>
                    <th>{{__('msg.edit')}}</th>
                    <th>{{__('msg.delete')}}</th>
                </thead>
                <tbody>
                <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$record->id}}</td>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                            @include('components.edit', ['route' => 'services.edit', 'entity' => 'service','id' => $record->id])
                            <td>
                                @include('components.delete', ['route' => 'services.destroy', 'entity' => 'service', 'id' => $record->id])
                            </td>
                        </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              @if(count($records) == 0)
                <p class="text-center"> No records found.</p>
              @endif
              {{$records->links()}}

            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script>
$(document).ready(function(){

 fetch_customer_data();

 $(document).on('keyup', '#search', function(){
  var query = $('#search').val();
  fetch_customer_data(query);
 });
});
</script>

@endsection
