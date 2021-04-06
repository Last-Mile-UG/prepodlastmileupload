@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'User Create',
    'activePage' => 'User Create',
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
            <h5 class="title">{{__("Add Users")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('user.store') }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @include('alerts.success')
              <div class="row">
              </div>
              <input type="hidden" name="role" value="customer">
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("User Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Display Name")}}</label>
                                <input type="text" name="display_name" class="form-control" value="{{ old('display_name') }}">
                                @include('alerts.feedback', ['field' => 'display_name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                      <label>{{__(" New password")}}</label>
                      <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password" required>
                      @include('alerts.feedback', ['field' => 'password'])
                    </div>
                  </div>
                </div>
                <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm New Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                      @include('alerts.feedback', ['field' => 'email'])
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("First Name")}}</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                                @include('alerts.feedback', ['field' => 'first_name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Last Name")}}</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                                @include('alerts.feedback', ['field' => 'last_name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Mobile Number")}}</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                @include('alerts.feedback', ['field' => 'phone'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Address")}}</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                @include('alerts.feedback', ['field' => 'address'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("City")}}</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                                @include('alerts.feedback', ['field' => 'city'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("State")}}</label>
                                <input type="text" name="state" class="form-control" value="{{ old('state') }}">
                                @include('alerts.feedback', ['field' => 'state'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Zip Code")}}</label>
                                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}">
                                @include('alerts.feedback', ['field' => 'postal_code'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Country")}}</label>
                            <select id="country" name="country" class="selectpicker countrypicker">
                              @foreach($countries as $key=>$country)
                                <option value="{{$key}}">{{$country}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("File")}}</label>
                            <div class="btn btn-primary btn-sm float-left">
                              <span>Choose file</span>
                              <input type="file" name="photo">
                            </div>
                        </div>
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