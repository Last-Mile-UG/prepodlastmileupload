@extends('admin.layouts.app', [
    'namePage' => 'showCustomer',
    'class' => 'sidebar-mini',
    'activePage' => 'showCustomer',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="table1">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Services</h4>
                </div>
                <div class="card-body">
                    
                  <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      
                    </thead>
                    <tbody id="tbodyID">
                      <tr>
                        @foreach($services as $key=>$record)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $record->title }}</td>
                                <td>{{ $record->status == 1 ? 'Active' : 'Passive' }}</td>
                                
                            </tr>
                        @endforeach
                      </tr>         
                    </tbody>
                  </table>
                  
                  </div>
                  
                </div>
              </div>
            </div>
            
            <br> <br>

            <div class="table2">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Products</h4>
                </div>
                <div class="card-body">
                    
                  <div class="table-responsive">
                    <table class="table">
                    <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Service</th>
                    <th>Vendor_id</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Delivery Times</th>
                    <th>Rating</th>
                    <th>Delivery Options</th>
                    
                </thead>
                <tbody>
                  <tr>
                    @foreach($product as $key=>$record)
                        <tr>
                            <td>{{$record->id}}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->service }}</td>
                            <td>{{ $record->vendor_id }}</td>
                            <td>{{ $record->description }}</td>
                            <td>{{ $record->image }}</td>
                            <td>{{ $record->price }}</td>
                            <td>{{ $record->delivery_times }}</td>
                            <td>{{ $record->rating }}</td>
                            <td>{{ $record->deals }}</td>
                            <td>{{ $record->delivery_options }}</td>
                            
                        </tr>
                    @endforeach
                  </tr>                    
                </tbody>
                    </table>
                  
                  </div>
                  
                </div>
              </div>
            </div>
            
            <br> <br>

            <div class="table3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Orders</h4>
                </div>
                <div class="card-body">
                    
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                          <th>ID</th>
                          <th>Product Name</th>
                          <th>Image</th>
                          <th>Quantity</th>
                          <th>Billing Country</th>
                          <th>Billing First Name</th>
                          <th>Billing Last Name</th>
                          <th>Billing Address</th>
                          <th>Billing City</th>
                          <th>Billing State</th>
                          <th>Billing Zip</th>
                          <th>Billing Email</th>
                          <th>Billing Phone</th>
                          
                      </thead>
                      <tbody>
                            @foreach($order as $key=>$row)
                            <tr>
                              <td>{{$row->id}}</td>
                              <td>{{$row->product_name}}</td>
                              <td>{{$row->image}}</td>
                              <td>{{$row->quantity}}</td>
                              <td>{{$row->billing_country}}</td>
                              <td>{{$row->billing_fname}}</td>
                              <td>{{$row->billing_lname}}</td>
                              <td>{{$row->billing_address}}</td>
                              <td>{{$row->billing_city}}</td>
                              <td>{{$row->billing_state}}</td>
                              <td>{{$row->billing_zip}}</td>
                              <td>{{$row->billing_email}}</td>
                              <td>{{$row->billing_phone}}</td>
                              
                              

                            </tr>
                            @endforeach
                      </tbody>
                    </table>
                  
                  </div>
                  
                </div>
              </div>
            </div>
      </div>
    </div>


@endsection
