@extends('layouts.app', [
    'namePage' => 'Order list',
    'class' => 'sidebar-mini',
    'activePage' => 'Order list',
  ])

@section('content')
<style>


.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;

  
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h4 class="card-title" >{{__('msg.orders')}}</h4>
                <div class="alert bg-success alert-success alert-dismissible" id="rider" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Request has been sent successfully to Rider</strong> 
                </div>

            </div>
            <div class="modal" id="loadModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color: rgba(0,0,0,0.5) !important;">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="background-color: transparent !important; border:none !important;">
                    <div class="modal-content  login-signup-modal login"  style="background-color: transparent !important; border:none !important;">
                        <div class="modal-body p-0">
                            <div class="loader" id="ia" style="margin:0 auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                <table class="table">
                    <thead class="text-primary">
                        <th>{{__('msg.id')}}</th>
                        <th>{{__('msg.orderid')}}</th>
                        <th>{{__('msg.userid')}}</th>
                        <th>{{__('msg.price')}}</th>
                        <th>{{__('msg.driverid')}}</th>
                        <th>{{__('msg.status')}}</th>
                        <th>{{__('msg.date')}}</th>
                        <th>{{__('msg.requestrider')}}</th>
                        <th>{{__('msg.information')}}</th>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($records as $key=>$record)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $record->order_id }}</td>
                                <td>{{ $record->user_id }}</td>
                                <td>{{ $record->price }}</td>
                                <!-- <td>{{ $record->driver_id ?? '--' }}</td> -->
                                <td>
                                @foreach($record->details as $driverId)
                                {{ $driverId->driver_id ?? '--' }}
                                
                                @endforeach
                                </td>
                                <td>
                                    <form id="submitForm-{{$record->id}}" method="post" action="{{route('orderstatus',$record->id)}}" onchange="mySelection({{$record->id}})"> 
                                        @csrf
                                        @foreach($record->details as $details)
                                        @if($details->vendor_id == auth()->user()->id && $details->order_id == $record->id)
                                        <select name="selectionbox" class="form-control selectpicker">
                                        <option value="pending" {{$details->status =='pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="accept" {{$details->status =='accept' ? 'selected' : '' }}>Accept</option>
                                        <option value="pickedup" {{$details->status =='pickedup' ? 'selected' : '' }}>Picked Up</option>
                                        <option value="delivering" {{$details->status =='delivering' ? 'selected' : '' }}>Delivering</option>
                                        <option value="delivered" {{$details->status =='delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{$details->status =='cancelled' ? 'selected' : '' }}>Rider Cancelled</option>
                                        <option value="vendor_cancelled" {{$details->status =='vendor_cancelled' ? 'selected' : '' }}>Vendor Cancelled</option>                                        
                                        </select>
                                        @break
                                        @endif
                                        @endforeach
                                    </form>
                                </td>
                                <td>{{ $record->created_at}}</td>
                                <td>
                                    <button class = "form-control" type="button" onclick ="myFunction({{$record->id}})" data-target = "#loadModel"> Rider Request </button>
                                </td>
                                <td> <a href="{{ route('vendor_orders.show', ['vendor_order' => $record->id]) }}"> Order Info </a></td>
                            </tr>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
                @if($records->count() < 1)
                    <p class="text-center"> No records found.</p>
                @endif
                {{ $records->links()}}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function myFunction(id) {
       document.getElementById("loadModel").style.display = "block";
               
        let route = `{{route('order.rider')}}`
            
            $.ajax({
                url : route+'/'+id,
                type : "GET",
                datatype : "json",               
                success:function(result){
                    console.log(result);
                    document.getElementById("loadModel").style.display = "none";
                    document.getElementById("rider").style.display = "block";
                }
            });
    }
</script>
<script type="text/javascript">
    function mySelection(id)
    {
        document.getElementById("submitForm-"+id).submit();
    }


</script>

@endpush
