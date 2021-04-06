@extends('admin.layouts.app', [
    'namePage' => 'Order list',
    'class' => 'sidebar-mini',
    'activePage' => 'Order list',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="row justify-content-between">

        <!-- <div class="row"> -->
            <!-- <div class="form-group mr-4 mt-4">
              <input type="text" name="search" id="search" class="form-control" placeholder="Search Order" />
            </div> -->
        <!-- </div> -->

          </div>
          <div class="card-header">
            <h4 class="card-title"> Orders</h4>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Price</th>
                    <th>Driver ID</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Request Rider</th>
                    <th>Information</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $record->order_id }}</td>
                            <td>{{ $record->user_id }}</td>
                            <td>{{ $record->price }}</td>
                            <td>{{ $record->driver_id ?? '--' }}</td>
                            <td>
                              <select class="form-control selectpicker">
                                <option value="pending" {{$record->status =='pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accept" {{$record->status =='accept' ? 'selected' : '' }}>Accept</option>
                                <option value="pickedup" {{$record->status =='pickedup' ? 'selected' : '' }}>Picked Up</option>
                                <option value="delivering" {{$record->status =='delivering' ? 'selected' : '' }}>Delivering</option>
                                <option value="delivered" {{$record->status =='delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{$record->status =='cancelled' ? 'selected' : '' }}>Cancelled</option>
                              </select>
                            </td>
                            <td>{{ $record->created_at}}</td>
                            <td>
                             <button class = "form-control" onclick="myFunction()"> Rider Request </button>
                                <script>
                                function myFunction() {
                                  alert("Rider Requested");
                                }
                                </script>
                            </td>
                            <td><a href="{{ route('orders.show', ['order' => $record->id]) }}"> Order Info </a></td>
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
