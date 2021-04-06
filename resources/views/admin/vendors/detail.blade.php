@extends('admin.layouts.app', [
    'namePage' => 'show_vendor',
    'class' => 'sidebar-mini',
    'activePage' => 'show_vendor',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h4 class="card-title">Vendor Orders</h4>
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
                                <td>{{$record->status}}</td>
                                <td>{{ $record->created_at}}</td>
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
