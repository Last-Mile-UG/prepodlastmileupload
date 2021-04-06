@extends('admin.layouts.app', [
    'namePage' => 'service_fees',
    'class' => 'sidebar-mini',
    'activePage' => 'service_fees',
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
            <h4 class="card-title">Service Fees</h4>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Edit</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $record->type }}</td>
                            <td>{{ $record->price }}</td>
                            <td>{{ $record->created_at}}</td>
                            <td>
                                @include('components.edit', ['route' => 'service-fees.edit', 'entity' => 'service_fee','id' => $record->id])
                            </td>
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
