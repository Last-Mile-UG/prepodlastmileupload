@extends('admin.layouts.app', [
    'namePage' => 'show_vendor',
    'class' => 'sidebar-mini',
    'activePage' => 'show_vendor',
  ])

  <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}
.slider.round:before {
  border-radius: 50%;
}
.setrow{
    white-space: nowrap;
    width: 150px;
    text-overflow: ellipsis;
    overflow: hidden;
}
.setrow:hover{
    white-space: normal !important;
}
</style>

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Vendors</h4>
          </div>
          <div class="card-body">
            @include('alerts.success')
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Show Details</th>
                    <th>Opening Time</th>
                    <th>Closing Time</th>
                    <th>Featured</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($records as $key=>$record)
                      <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        <td>{{ $record->role == 'premium_vendor' ? 'Premium' : 'Normal'}}</td>
                        @if(isset($record->detail->image) && $record->detail->image)
                          <td>
                            <a target="blank" href="{{ $record->detail->image }}">
                              <img height="50px" src="{{ $record->detail->image }}" alt="--">
                            </a>
                          </td>
                        @else
                        <td>--</td>
                        @endif
                        <td><a href="{{route('vendors.show', ['vendor' => $record->id])}}">Show Details</a></td>
                        <td>{{$record->detail->opening_time}}</td>
                        <td>{{$record->detail->closing_time}}</td>
                        <td>
                          <a href="{{route('vendors.featured',$record->id)}}" class="switch">
                            <input type="checkbox" {{ $record->detail->featured ? 'checked' : ''}}>
                            <span class="slider round"></span>
                          </a>
                        </td>
                        <td>
                            @include('components.edit', ['route' => 'vendors.edit', 'entity' => 'vendor','id' => $record->id])
                        </td>
                        <td>
                            @include('components.delete', ['route' => 'vendors.destroy', 'entity' => 'vendor', 'id' => $record->id, 'style' => 'margin-top:15px'])
                        </td>
                       
                      </tr>
                    @endforeach
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
}
