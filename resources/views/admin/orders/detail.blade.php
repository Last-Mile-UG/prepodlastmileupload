@extends('admin.layouts.app', [
    'namePage' => 'Orders List',
    'class' => 'sidebar-mini',
    'activePage' => 'Orders List',
  ])
<style>
.smallDiv{
    margin-right: 8%;
    width: 40% !important;
    min-height: 40% !important;
}
</style>

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="row" style="height: 100%;">
                <div class="card smallDiv">
                    <div class="card-header">
                        <h4 class="card-title">Order Detail</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <span>Order Number: {{$record->order_id}}</span><br><hr>
                                <span>Date: {{$record->created_at}}</span><br><hr>
                                <span>Payment: Online</span><br><hr>
                                <select class="form-control selectpicker">
                                    <option value="pending" {{ $record->status =='pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accept" {{ $record->status =='accept' ? 'selected' : '' }}>Accept</option>
                                    <option value="pickedup" {{ $record->status =='pickedup' ? 'selected' : '' }}>Picked Up</option>
                                    <option value="delivering" {{ $record->status =='delivering' ? 'selected' : '' }}>Delivering</option>
                                    <option value="delivered" {{ $record->status =='delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $record->status =='cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card smallDiv">
                    <div class="card-header">
                        <h4 class="card-title">Customer Detail</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <span>Name: {{ $record->user->detail->user_name}}</span><br><hr>
                                <span>Email: {{  $record->user->detail->email}}</span><br><hr>
                                <span>Phone: {{  $record->user->detail->phone}}</span><br><hr>
                                <span>Date: {{ $record->user->detail->address}}</span><br>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Order Detail</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="border: 1px solid #dee2e6;">
                                <th scope="col">Products</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailrecord as $records)
                            <tr>
                                <td>{{$records->variant->product->name}}</td>
                                <td>{{$records->quantity}}</td>
                                <td>{{$records->price}}</td>
                                <td>{{$records->total_price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection




