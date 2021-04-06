@extends('admin.layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Edit Vendor',
    'activePage' => 'Edit Vendor',
    'activeNav' => '',
])

@section('content')
@push('css')
<link href="{{asset('assets/select2/css/select2.min.css')}}" rel="stylesheet" />

<style>
.select2-search--dropdown{
    background-color: #fff;
    border: none;
    outline: 0;
    width: 495px;
}
.select2-search__field{
    background-color: #000;
    border: solid black 1px;
    outline: 0;
    width: 495px;
}
.select2-results { 
    background-color: #000;
    border: solid black 1px;
    outline: 0;
    width: 495px;
    
}
.select2-selection--multiple{
    background-color: #000;
    border: solid black 1px;
    outline: 0;
    width: 495px;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid black 1px;
    outline: 0;
    width: 495px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
    cursor: default;
    padding-left: 2px;
    padding-right: 5px;
    background-color: #fff;
}
.form-control
{
    color:black !important;
}
</style>
@endpush 
  <div class="panel-header panel-header-sm">
  </div>
 <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__("Edit Vendor")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('vendors.update', ['vendor' => $record->id]) }}" autocomplete="on"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              @include('alerts.success')
              <div class="row">
              </div>
                {{-- <input type="hidden" name="role" value="vendor"> --}}
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="categories[]" id="cars" multiple class="form-control modules" style="overflow-y: hidden">
                                @foreach($vendorCategory as $category)                                
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>                                
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Vendor Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ $record->name ?? old('name') }}" required>
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("First Name")}}</label>
                                <input type="text" name="fname" class="form-control" value="{{ $record->detail->fname ?? old('fname') }}" required>
                                @include('alerts.feedback', ['field' => 'fname'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Last Name")}}</label>
                                <input type="text" name="lname" class="form-control" value="{{ $record->detail->lname ?? old('lname') }}" required>
                                @include('alerts.feedback', ['field' => 'lname'])
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                      <label>{{__(" New password")}}</label>
                      <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password">
                      @include('alerts.feedback', ['field' => 'password'])
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label>{{__(" Confirm New Password")}}</label>
                        <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation">
                    </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{  $record->email ?? old('email') }}" required>
                      @include('alerts.feedback', ['field' => 'email'])
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Phone")}}</label>
                                <input type="text" name="phone" class="form-control" value="{{  $record->detail->phone ?? old('phone') }}" required>
                                @include('alerts.feedback', ['field' => 'phone'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Latitude")}}</label>
                                <input type="text" name="latitude" class="form-control" value="{{ $record->locations->first()->latitude ?? old('latitude') }}" required>
                                @include('alerts.feedback', ['field' => 'latitude'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Longitude")}}</label>
                                <input type="text" name="longitude" class="form-control" value="{{ $record->locations->first()->longitude ?? old('longitude') }}" required>
                                @include('alerts.feedback', ['field' => 'longitude'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Address")}}</label>
                                <input type="text" name="address" class="form-control" value="{{ $record->detail->address ?? old('address') }}" required>
                                @include('alerts.feedback', ['field' => 'address'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="role">Role</label><br>
                            <select class="form-control " name="role" id="role">
                                <option value="vendor" {{$record->role == 'vendor' ? 'selected' : ''}}>Normal Vendor</option>
                                <option value="premium_vendor" {{$record->role == 'premium_vendor' ? 'selected' : ''}}>Premium Vendor</option>
                            </select>
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
                  @if(isset($record->detail->image) && $record->detail->image)
                    <div class="row">
                      <div class="col-md-7 pr-1">
                          <div class="form-group">
                              <img height="100px" src="{{ $record->detail->image }}" alt="">
                          </div>
                      </div>
                    </div>
                  @endif

                  <div class="row">
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                                <label>{{__("Delivery Options")}}</label><br>
                                @foreach ($deliveryOptions as $option)
                                    <input type="checkbox" name="deliveryOption[]" id="delivery-{{$option->id}}" value="{{$option->id}}" {{in_array($option->id, $record->deliveryOptions->pluck('id')->toArray()) ? 'checked' : ''}}>
                                    <span style="margin-right:20px">{{$option->title}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                                <label>Opening Time</label><br>
                                <input type="time" class="form-control"  name="opening_time" value="{{$record->detail->opening_time}}">
                           </div>
                        </div>
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                            <label>Closing Time</label><br>
                            <input type="time" class="form-control" name="closing_time" value="{{$record->detail->closing_time}}" >
                            </div>
                        </div>
                    </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
                </div>
                <hr class="half-rule"/>
            </form>
          </div>

        </div>
      </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('assets/select2/js/select2.min.js')}}"></script>


<script>
  $('.modules').select2();
</script>
@endpush
