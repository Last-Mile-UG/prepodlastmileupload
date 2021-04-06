@extends('admin.layouts.app', [
    'namePage' => 'service request list',
    'class' => 'sidebar-mini',
    'activePage' => 'service request list',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row justify-content-between">
            <!-- <div class="form-group mr-4 mt-4">
              <input type="text" name="search" id="search" class="form-control" placeholder="Search Order" />
            </div>    -->
          </div>
          <div class="card-header">
            <h4 class="card-title"> Customer Service Request</h4>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $record->user ? $record->user->name : '--' }}</td>
                            <td>{{ $record->user ? str_replace('_', ' ', $record->user->role) : '--'}}</td>
                            <td>{{ $record->description }}</td>
                            <td>
                                <select class="form-control selectpicker">
                                    <option value="1" {{ $record->status ? 'Resolved' : '' }}> Resolved</option>
                                    <option value="0" {{ !$record->status ? 'selected' : '' }}> Un Resolved</option>
                                </select>
                            </td>
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
