@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Create Product Variant',
    'activePage' => 'Create Product Variant',
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
            <h5 class="title">{{__("msg.addproductvarients")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('product-variants.store') }}" autocomplete="on"
            enctype="multipart/form-data">
              @csrf
              @include('alerts.success')
              <div class="row">
              </div>

              <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label for="products">{{__('msg.products')}}</label><br>
                            <select class="form-control" name="product_id" id="product_id">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__("msg.description")}}</label>
                                <textarea name="prod_desc" id="product_descID" cols="30" rows="1" class="form-control" required></textarea>
                                @include('alerts.feedback', ['field' => 'prod_desc'])
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
                            <div class="btn btn-primary btn-sm">
                              <span>{{__("msg.choosefile")}}</span>
                              <input type="file" name="photo" accept="image/*" style="width: 110px;" required>
                            </div>
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
