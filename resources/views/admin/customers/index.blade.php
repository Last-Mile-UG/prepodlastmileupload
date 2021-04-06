@extends('admin.layouts.app', [
    'namePage' => 'show_customer',
    'class' => 'sidebar-mini',
    'activePage' => 'show_customer',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Customer</h4>
          </div>
          <div class="card-body">
              @include('alerts.success')
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Show Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($records as $key=>$record)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        @if(isset($record->detail->image) && $record->detail->image)
                          <td>
                            <a target="blank" href="{{ $record->detail->image }}">
                              <img height="50px" src="{{ $record->detail->image }}" alt="--">
                            </a>
                          </td>
                        @else
                        <td>--</td>
                        @endif
                        <td><a href="{{route('customers.show', ['customer' => $record->id])}}">Show Details</a></td>
                        <td>
                            @include('components.edit', ['route' => 'customers.edit', 'entity' => 'customer','id' => $record->id])
                        </td>
                        <td>
                            @include('components.delete', ['route' => 'customers.destroy', 'entity' => 'customer', 'id' => $record->id])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              @if(count($records) < 1)
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
