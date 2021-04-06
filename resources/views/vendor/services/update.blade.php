@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Edit Service',
    'activePage' => 'Edit Service',
    'activeNav' => '',
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{__("msg.editcategory")}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('services.update', ['service' => $record->id])}}" method = "post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <label>{{__("msg.name")}}</label>
                                                <input type="text" name="name" class="form-control" value='{{$record->title }}' required>
                                                @include('alerts.feedback', ['field' => 'name'])
                                        </div>
                                    </div>
                                </div>
                                <div class="row ml-1">
                                    <div class="form-group">
                                        <select name="status" class="form-control" >
                                            <option value="1" {{ $record->status ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{ !$record->status ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-primary btn-round">{{__('msg.save')}}</button>
                                </div>
                                <hr class="half-rule"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
