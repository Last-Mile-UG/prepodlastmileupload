@extends('admin.layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Delivery Create',
    'activePage' => 'Delivery Create',
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
            <h5 class="title">{{__("Add Delivery Option")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('delivery.store') }}" autocomplete="on"
                enctype="multipart/form-data">
              @csrf
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="title">{{__("Title")}}</label>
                      <input type="title" name="title" class="form-control" placeholder="title" value="{{ old('title') }}" required>
                      @include('alerts.feedback', ['field' => 'title'])
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Price")}}</label>
                                <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
                                @include('alerts.feedback', ['field' => 'price'])
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                      @include('components.status')
                    </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Add')}}</button>
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
