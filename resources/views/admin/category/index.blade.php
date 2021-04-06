@extends('admin.layouts.app', [
    'namePage' => 'Product Reviews',
    'class' => 'sidebar-mini',
    'activePage' => 'Product Reviews',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="row justify-content-between">
          </div>
          <div class="card-header">
            <h4 class="card-title">Categories Type</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                </thead>
                <tbody>
                  <tr>
                  @foreach($records as $record)
                        <tr>
                           <td>{{$record->id}}</td>
                           <td>{{$record->name}}</td>
                           <td><img src="{{$record->image}}" height="40px" width="40px"></td>
                        </tr>
                   @endforeach
                  </tr>
                </tbody>
              </table>
             
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
