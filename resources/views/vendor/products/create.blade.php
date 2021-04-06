@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Product Create',
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
            <form method="post" action="{{ route('products.store') }}" autocomplete="on"
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
                            <label>{{__("msg.productname")}}</label>
                                <input type="text" name="prod_name" class="form-control" value="{{ old('prod_name') }}" required>
                                @include('alerts.feedback', ['field' => 'prod_name'])
                        </div>
                    </div>
                </div>
              

                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="Price">{{__("msg.price")}}</label>
                      <input type="price" name="price" class="form-control" placeholder="price" value="{{ old('price') }}" required>
                      @include('alerts.feedback', ['field' => 'price'])
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="subscription">{{__("msg.producttype")}}</label><br>
                            <select class="form-control" name="subscription" id="subscription">
                                <option value="0">Normal</option>
                                <option value="1">Subscription</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="processing_time">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("msg.processingtime")}}</label>
                                <input type="text" id="delivery_time" name="delivery_time" class="form-control" value="{{ old('delivery_time') }}" required>
                                @include('alerts.feedback', ['field' => 'delivery_time'])
                        </div>
                    </div>
                </div>

                <div class="row" id="availability_time" style="display: none;">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Availablity From")}}</label><br>
                            <input class="form-control" type="time" id="start_time" name="start_time">
                        </div>
                    </div>
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Availablity Till")}}</label><br>
                            <input class="form-control" type="time" id="end_time" name="end_time">
                        </div>
                    </div>
                </div>

              
                <div class="row">
                <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="subscription">Status</label><br>
                            <select class="form-control" name="status">
                                <option value="0">InActive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <div class="btn btn-primary btn-sm">
                              <span>{{__('msg.choosefile')}}</span>
                              <input type="file" name="photo" accept="image/*" style="width: 110px;" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="subscription">Featured</label><br>
                            <select class="form-control" name="feature">
                                <option value="0">UnFeatured</option>
                                <option value="1">Featured</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("msg.description")}}</label>
                                <textarea name="prod_desc" id="product_descID"  rows="10" cols="70" required></textarea>
                                @include('alerts.feedback', ['field' => 'prod_desc'])
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
