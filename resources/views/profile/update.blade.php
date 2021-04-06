@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' =>'hi',
    'activePage' => 'Edit Profile',
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
                        <h5 class="title">{{__("msg.profile")}}</h5>
                    </div>
                    <div class="card-body">
        <form method="post" action = "/updateProfile/<?php echo $record->id ?>" method = "post"
            enctype="multipart/form-data">
              @csrf
              <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("msg.name")}}</label>
                                <input type="text" name="name" class="form-control" value='{{$record->name }}' readonly>
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="form-group">
                    <label>{{__("msg.email")}}</label>
                        <input type="text" name="email" class="form-control" value='{{$record->email }}' readonly>
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="form-group">
                    <label>{{__("msg.password")}}</label>
                        <input type="text" name="password" class="form-control" value='{{$record->password }}'>
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="form-group">
                    <label>Opening Time</label>
                        <input type="time" name="password" class="form-control" value='{{$record->detail->opening_time }}'>
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="form-group">
                    <label>Closing Time</label>
                        <input type="time" name="password" class="form-control" value='{{$record->detail->closing_time }}'>
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
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
