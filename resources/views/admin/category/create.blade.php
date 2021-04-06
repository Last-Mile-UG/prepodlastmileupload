@extends('admin.layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'add_customer',
    'activePage' => 'add_customer',
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
            <h5 class="title">{{__("Add Category")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{route('category-store')}}" autocomplete="on" enctype="multipart/form-data">
              @csrf
              @include('alerts.success')
              <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Name")}}</label>
                                <input type="text" name="name" class="form-control"  required>
                                
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="">
                            <label>{{__("Image")}}</label>
                                <input type="file" name="image" class="form-control" required>
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
