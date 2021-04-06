@extends('layouts.app', [
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
                        <h5 class="title">{{__("msg.addcategorycamelcase")}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('services.store') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @include('alerts.success')
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{__("msg.title")}}</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                                        @include('alerts.feedback', ['field' => 'title'])
                                    </div>
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
