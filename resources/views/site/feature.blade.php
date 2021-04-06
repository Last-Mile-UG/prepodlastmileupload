@extends('layouts.site.app', [
    
    ])
    
    @section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
            <h3 class="mt-3 mb-3 font-medium">{{__('msg.featurebrands')}}</h3>
            </div>
           
            @foreach($products as $product)
           <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="cart-item mr-2 shadow-2 p-2 mb-4">
                    <div class="card-item-header d-flex justify-content-between">
                        <span class="cart-item-category px-2">
                        <p style="display:none">{{$a = __('msg.productsC')}}</p>
                        <p style="display:none">{{$b = __('msg.subscription')}}</p>
                            {{$product->subscription ? $b : $a}}
                        </span>
                        <div class="cart-items-options d-flex">
                            <button class="btn btn-transparent">
                                <img src="{{asset('assets/site/img/icons/favorite_active.png')}}" alt="">
                            </button>
                        </div>  
                    </div>
                    <div class="cart-item-content">
                        <div class="d-flex flex-column justify-content-between">
                            <div class="cart-item-price d-flex my-2">
                                <span class="text-black font-black mr-3 font-13">€{{$product->price}}</span>
                                <img src="{{asset('assets/site/img/icons/cart_2.png')}}" alt="">
                            </div> 
                            <div class="cart-item-details d-flex justify-content-between mt-4">
                                <div class="cart-item-desc-review align-self-end d-flex flex-column">
                                    <span class="text-black cart-item-tagline font-13 font-medium">{{$product->name ?? '--' }}</span>
                                    <span class="text-grey cart-item-description font-13">{{$product->description ?? '--' }}</span>
                                    <div class="ratings">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                </div>
                                <div class="cart-item-img">
                                    <img src="{{$product->image}}" style="border-radius:5px" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           @endforeach
           
        </div>
    </div>
    @endsection
    @stack('js')
   
      