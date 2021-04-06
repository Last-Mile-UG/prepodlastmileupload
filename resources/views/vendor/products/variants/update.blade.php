@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Edit Product Variant',
    'activePage' => 'Edit Product Variant',
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
            <h5 class="title">{{__("Edit Product Variant")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('product-variants.update', ['product_variant' => $record->id]) }}" autocomplete="on"
            enctype="multipart/form-data">
              @csrf
              @method('PUT')
              @include('alerts.success')
              <div class="row">
              </div>

              <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="products">Product</label><br>
                            <input type="text" readonly value="{{$record->product->name}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("Description")}}</label>
                                <textarea name="prod_desc" id="product_descID" cols="30" rows="1" class="form-control" required>{{$record->description}}</textarea>
                                @include('alerts.feedback', ['field' => 'prod_desc'])
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="Price">{{__("Price")}}</label>
                      <input type="price" name="price" class="form-control" placeholder="price" value="{{ $record->price ?? old('price')}}" required>
                      @include('alerts.feedback', ['field' => 'price'])
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
