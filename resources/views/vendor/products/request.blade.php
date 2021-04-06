@extends('layouts.app', [
    'namePage' => 'Subscription Requests',
    'class' => 'sidebar-mini',
    'activePage' => 'Subscription Requests',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{__('msg.subscriptionrequest')}}</h4>
          </div>
          <div class="card-body">
              @include('alerts.success')
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>{{__('msg.id')}}</th>
                    <th>{{__('msg.username')}}</th>
                    <th>{{__('msg.productname')}}</th>
                    <th>{{__('msg.starttime')}}</th>
                    <th>{{__('msg.endtime')}}</th>
                    <th>{{__('msg.status')}}</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{ $record->user ? $record->user->name : '--'  }}</td>
                            <td>{{ $record->product ? $record->product->name : '--'  }}</td>
                            <td>{{$record->start_time}}</td>
                            <td>{{$record->end_time}}</td>
                            <td>
                                <select class="form-control" name="status" id="status" data-id="{{$record->id}}">
                                    <option value="0" {{ !$record->status ? 'selected' : ''}}>Pending</option>
                                    <option value="1" {{ $record->status ? 'selected' : ''}}>Approved</option>
                                </select>
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

@endsection

@push('js')
    <script type="text/javascript">
        $('#status').on('change', function(){            
            var route = `{{ route('products.request.status') }}`
            var id = $(this).attr('data-id');
            var status = $(this).val();

            $.ajax({
                url: route,
                type:'GET',
                dataType:'JSON',
                data: {
                    id, 
                    status
                },
                success: function(result){
                    console.log(result);
                }
            });
        });
    </script>
@endpush
