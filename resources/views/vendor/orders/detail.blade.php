@extends('layouts.app', [
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
                        <h4 class="card-title">{{__('msg.orderdetail')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <span>{{__('msg.orderNumber')}}: {{$record->order_id}}</span><br><hr>
                                <span>{{__('msg.date')}}: {{$record->created_at}}</span><br><hr>
                                <span>{{__('msg.payment')}}:{{__('msg.online')}}</span><br><hr>
                                @foreach($detailrecord as $records)
                                @if($records->vendor_id == auth()->user()->id && $records->order_id == $record->id)
                                <select class="form-control selectpicker" readonly>
                                    <option value="pending" {{ $records->status =='pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accept" {{ $records->status =='accept' ? 'selected' : '' }}>Accept</option>
                                    <option value="pickedup" {{ $records->status =='pickedup' ? 'selected' : '' }}>Picked Up</option>
                                    <option value="delivering" {{ $records->status =='delivering' ? 'selected' : '' }}>Delivering</option>
                                    <option value="delivered" {{ $records->status =='delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $records->status =='cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @break
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card smallDiv">
                    <div class="card-header">
                        <h4 class="card-title">{{__('msg.customerdetail')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <span>{{__('msg.name')}}: {{ $record->user->detail->user_name}}</span><br><hr>
                                <span>{{__('msg.email')}}: {{  $record->user->detail->email}}</span><br><hr>
                                <span>{{__('msg.phone')}}: {{  $record->user->detail->phone}}</span><br><hr>
                                <span>{{__('msg.date')}}: {{ $record->user->detail->address}}</span><br>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">{{__('msg.orderdetail')}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="border: 1px solid #dee2e6;">
                                <th scope="col">{{__('msg.products')}}</th>
                                <th scope="col">{{__('msg.quantity')}}</th>
                                <th scope="col">{{__('msg.unitprice')}}</th>
                                <th scope="col">{{__('msg.total')}}</th>
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
