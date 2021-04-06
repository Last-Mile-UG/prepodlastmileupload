@extends('layouts.app', [
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
            <h4 class="card-title">{{__('msg.users')}}</h4>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>{{__('msg.id')}}</th>
                    <th>{{__('msg.name')}}</th>
                    <th>{{__('msg.email')}}</th>
                    <th>{{__('msg.phone')}}</th>
                    <th>{{__('msg.image')}}</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                                <td>{{$key++}}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->user->email }}</td>
                                <td>{{ $record->user->detail->phone }}</td>
                                @if(isset($record->user->detail->image) && $record->user->detail->image)
                                    <td>
                                    <a target="blank" href="{{asset('uploads/images/profile/'. $record->user->detail->image)}}">
                                        <img height="50px" src="{{asset('uploads/images/profile/'. $record->user->detail->image)}}" alt="--">
                                    </a>
                                    </td>
                                @else
                                    <td>--</td>
                                @endif
                        </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              @if($records->count() == 0)
                <p class="text-center"> No records found.</p>
              @endif
              <!-- {{$records->links()}} -->
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
