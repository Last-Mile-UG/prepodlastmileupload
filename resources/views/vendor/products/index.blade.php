@extends('layouts.app', [
    'namePage' => 'Products List',
    'class' => 'sidebar-mini',
    'activePage' => 'Products List',
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
            <h4 class="card-title">{{__('msg.products')}}</h4>
          </div>
          <div class="card-body">
              @include('alerts.success')
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>{{__('msg.id')}}</th>
                    <th>{{__('msg.name')}}</th>
                    <th>{{__('msg.service')}}</th>
                    <th>{{__('msg.description')}}</th>
                    <th>{{__('msg.image')}}</th>
                    <th>{{__('msg.price')}}</th>
                    <th>{{__('msg.processingtime')}}</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>{{__('msg.edit')}}</th>
                    <th>{{__('msg.delete')}}</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->service }}</td>
                            <td>
                              <div class="setrow">
                                {{ $record->description }}
                              </div>
                              </td>

                            @if(isset($record->image) && $record->image)
                                <td>
                                    <a target="blank" href="{{ $record->image }}">
                                    <img height="50px" width="100px" src="{{ $record->image }}" alt="--">
                                    </a>
                                </td>
                            @else
                                <td>--</td>
                            @endif
                            <td>{{ $record->price }}</td>
                            <td>{{ $record->delivery_times }}</td>
                            <td>
                              @if($record->status == 1)
                              <a href="{{route('productstatus',$record->id)}}" class="switch">
                              <input type="checkbox" checked>
                              <span class="slider round"></span>
                              </a>                        
                              @else
                              <a href="{{route('productstatus',$record->id)}}" class="switch">
                              <input type="checkbox" >
                              <span class="slider round"></span>
                              </a>                   
                              @endif   
                            </td>
                            <td>
                              @if($record->featured == 1)
                              <a href="{{route('productFeature',$record->id)}}" class="switch">
                              <input type="checkbox" checked>
                              <span class="slider round"></span>
                              </a>                        
                              @else
                              <a href="{{route('productFeature',$record->id)}}" class="switch">
                              <input type="checkbox" >
                              <span class="slider round"></span>
                              </a>                   
                              @endif   
                            </td>
                            <td>
                                @include('components.edit', ['route' => 'products.edit', 'entity' => 'product','id' => $record->id])
                            </td>
                            <td>
                                @include('components.delete', ['route' => 'products.destroy', 'entity' => 'product', 'id' => $record->id])
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
