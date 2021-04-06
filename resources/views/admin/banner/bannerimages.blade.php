@extends('admin.layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Create Service',
    'activePage' => 'Create Service',
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
                        <h5 class="title">Add Banner Image</h5>
                    </div>
                    @include('alerts.success')
                    <div class="card-body">
                        <form method="post" action="{{route('store')}}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @include('alerts.success')
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>Image</label>
                                    </div>
                                        <input type="file" name="image"  required>
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
