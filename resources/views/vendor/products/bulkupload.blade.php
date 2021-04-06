@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Product Upload',
    'activePage' => 'Create Product',
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
            <h5 class="title">{{__("msg.addproductcamelcase")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('product.upload') }}" autocomplete="on"
            enctype="multipart/form-data">
              @csrf
              @include('alerts.success')
              <div class="row">
              </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("msg.selectservice")}}</label>
                            <div class="form-group">
                                <select name="service" class="form-control" required>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" >{{$service->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>                

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="subscription">{{__("msg.producttype")}}</label><br>
                            <select class="form-control" name="subscription" id="subscription">
                                <option value="0">{{__("msg.normal")}}</option>
                                <option value="1">{{__("msg.subscription")}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <div class="btn btn-primary btn-sm">
                              <span>{{__("msg.choosefile")}}</span>
                              <input type="file" name="csv_file" accept=".csv" style="width: 110px;" required>
                            </div>
                            <br>
                              <span class="text-danger" style="font-size: smaller">*{{__('msg.makesure')}}</span>
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

@push('js')
    <script type="text/javascript">
        $('#subscription').on('change', function(){
            if($(this).val() == 1){
                $('#processing_time').hide();
                $('#delivery_time').attr('required', false);                
                $('#availability_time').show();
                $('#start_time').attr('required', true);
                $('#end_time').attr('required', true);
            }
            else{
                $('#processing_time').show();
                $('#delivery_time').attr('required', true);
                $('#availability_time').hide();
                $('#start_time').attr('required', false);
                $('#end_time').attr('required', false);
            }
        });
    </script>
@endpush
