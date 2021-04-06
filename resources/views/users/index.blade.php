@extends('layouts.app', [
    'namePage' => 'User List',
    'class' => 'sidebar-mini',
    'activePage' => 'User List',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Users</h4>
          </div>
          <div class="card-body">
             
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$record->id}}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->fname }}</td>
                            <td><img src="{{ url('/'.$record->image)}}" alt="" srcset="" style="height:50px; width:50px;"></td>
                            <td>{{ $record->phone }}</td>
                            <td>{{ $record->status ? 'Active' : 'InActive' }}</td>
                            <td><a href = 'editUser/{{ $record->user_id }}'>Edit</a></td>
                            <td>
                                <!-- @include('components.edit', ['route' => 'user.edit', 'entity' => 'user', 'id' => $record->user_id]) -->
                                @include('components.delete', ['route' => 'user.destroy', 'entity' => 'user', 'id' => $record->user_id])
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
