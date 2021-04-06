@extends('admin.layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Edit Customer',
    'activePage' => 'Edit Customer',
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
            <h5 class="title">{{__("Add Customer")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('customers.update', ['customer' => $record->id]) }}" autocomplete="on"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              @include('alerts.success')
              <div class="row">
              </div>

              <input type="hidden" name="role" value="customer">
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Full Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ $record->name ?? old('name') }}" required>
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("First Name")}}</label>
                                <input type="text" name="fname" class="form-control" value="{{ $record->detail ? $record->detail->fname : old('fname') }}" required>
                                @include('alerts.feedback', ['field' => 'fname'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Last Name")}}</label>
                                <input type="text" name="lname" class="form-control" value="{{ $record->detail ? $record->detail->lname : old('lname') }}" required>
                                @include('alerts.feedback', ['field' => 'lname'])
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                      <label>{{__(" Password")}}</label>
                      <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __(' Password') }}" type="password" name="password">
                      @include('alerts.feedback', ['field' => 'password'])
                    </div>
                  </div>
                </div>
                <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation">
                </div>
              </div>
            </div>
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $record->email ?? old('email') }}" required>
                    @include('alerts.feedback', ['field' => 'email'])
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-7 pr-1">
                      <div class="form-group">
                          <label>{{__("Phone")}}</label>
                              <input type="text" name="phone" class="form-control" value="{{ $record->detail ? $record->detail->phone : old('phone') }}" required>
                              @include('alerts.feedback', ['field' => 'phone'])
                      </div>
                  </div>
              </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                      <div class="form-group">
                          <label>{{__("Address")}}</label>
                              <input type="text" name="address" class="form-control" value="{{ $record->detail ? $record->detail->address : old('address') }}" required>
                              @include('alerts.feedback', ['field' => 'address'])
                      </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <div class="btn btn-primary btn-sm">
                              <span>Choose file</span>
                              <input type="file" name="photo" accept="image/*" style="width: 110px;">
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
