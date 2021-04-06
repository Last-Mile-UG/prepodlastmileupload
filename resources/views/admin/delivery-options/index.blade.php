@extends('admin.layouts.app', [
    'namePage' => 'Delivery List',
    'class' => 'sidebar-mini',
    'activePage' => 'Delivery List',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
     <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Delivery Options</h4>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->price }}</td>
                            <td>{{ $record->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                @include('components.edit', ['route' => 'delivery.edit', 'entity' => 'delivery','id' => $record->id])
                            </td>
                            <td>
                              @include('components.delete', ['route' => 'delivery.destroy', 'entity' => 'delivery', 'id' => $record->id])
                            </td>
                        </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              @if(count($records) == 0)
                <p class="text-center"> No record found.</p>
              @endif
              {{$records->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
