@extends('admin.layouts.app', [
    'namePage' => 'service_fees',
    'class' => 'sidebar-mini',
    'activePage' => 'service_fees',
  ])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{__("Edit Service Fees")}}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('service-fees.update', ['service_fee' => $record->id]) }}" autocomplete="on"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('alerts.success')
                        <div class="row">
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label for="type">Type</label><br>
                                    <input type="text" value="{{$record->type}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label for="price">Price</label><br>
                                    <input type="text" name="price" value="{{$record->price}}" required>
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
@endsection
