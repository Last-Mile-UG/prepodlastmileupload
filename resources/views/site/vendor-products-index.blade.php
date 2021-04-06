@extends('layouts.site.app', [
    
    ])
    
    @section('content')
    <style>



.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0px;
  right: 0;
  background-color: white;
  transition: 0.5s;
  width:300px;
  margin-top: -90px;
  padding-top:20px;
  
  
}
.side-cart {
    width: 100%;
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
  position: absolute;
  top:230px;
  height: 100%;
  overflow-y:scroll;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
    <div class="container-fuild" style="margin-top:-16px;width:80%">
        <div class="row">
            <div class="swiper-container my-3 ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <span>ELECTRO BEATS</span>
                        <img src="{{asset('assets/site/img/banners/image.png')}}" alt=""> 
                    </div>
                    <div class="swiper-slide">
                        <span>SPECIAL BEATS</span>
                        <img src="{{asset('assets/site/img/banners/image.png')}}" alt=""> 
                    </div>
                    <div class="swiper-slide">
                        <span>CLASSICAL BEATS</span>
                        <img src="{{asset('assets/site/img/banners/image.png')}}" alt=""> 
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>  
        </div>
    </div>
    <div class="container-fuild mr-4 ml-4">
        <div class="row">
                <!-- side bar-->
            <div class="col-md-3  mb-4"> 
                <div class="side-bar shadow-1">
                    <ul class="nav d-flex flex-column ">
                        <li class="nav-item">
                            <a class="nav-link py-4 active" href="{{route('site.explore.vendor.products', ['id'=> $vendorId])}}">
                                <img src="{{ asset('assets/site/img/icons/cart.png') }}" alt="">
                                All
                                <img src="{{ asset('assets/site/img/icons/right_arrow.png') }}" alt="">
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link py-4 active category" data-cat-id="{{$category->id}}">
                                    <img src="{{ asset('assets/site/img/icons/cart.png') }}" alt="">
                                    {{$category->title}}
                                    <img src="{{ asset('assets/site/img/icons/right_arrow.png') }}" alt="">
                                </a>
                            </li>
                        @endforeach                            
                    </ul>
                </div>
            </div>
                <!-- side bar-->
                <!-- section-->

                <!--tabs-->
            <div class="col-md-6">
                <div class="tab-bar d-flex justify-content-between shadow-1">
                    <ul class="nav nav-pills custom-tab d-flex flex-column flex-sm-row flex-md-row flex-lg-row" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-left py-3 ml-0 ml-sm-0 ml-md-3 ml-lg-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{__('msg.allproduct')}}</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link py-3 text-left" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Low Price</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3 text-left" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">High Price</a>
                        </li> -->
                    </ul>
                    <ul class="nav d-flex">
                        <li class="nav-item d-flex">
                            <a class="nav-link active py-3  border-left border-right">
                                    <img src="{{ asset('assets/site/img/icons/view.png') }}" alt="">
                            </a>
                            <a class="nav-link active py-3 ">
                                <img src="{{ asset('assets/site/img/icons/menu.png') }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content my-4" id="pills-tabContent" >
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row" id="products-div">
                            @foreach($products as $product) 
                                @if($product->status == 1)                                   
                                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                        <div class="card s-product shadow-2 h-100">
                                            <div class="card-header px-2 pt-3 d-flex flex-wrap justify-content-between">
                                                <span class="product-category-tag px-2 mb-1" >
                                                    {{$product->category->title}}
                                                </span>
                                                <div class="product-options d-flex">
                                                    <button class="btn btn-transparent">
                                                        <img src="{{ asset('assets/site/img/icons/favorite_unactive.png') }}" alt="">
                                                    </button>
                                                    <button class="btn btn-transparent" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="{{ asset('assets/site/img/icons/filter.png') }}" alt="">
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body-s text-center d-flex flex-column align-items-center mt-2">
                                                <img src="{{ $product->variants->first()->image }}" alt="" class="product-img" style="height: 175px; width:175px;">
                                                <span>{{ $product->user->name }}</span>
                                                <span>{{ $product->name }}</span>
                                            </div>
                                            <div class="card-footer">
                                                <div class="ratings-and-reviews d-flex justify-content-center">
                                                    <div class="ratings ">                                                            
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <span class="reviews ml-2">
                                                        {{ $product->reviews_count }}
                                                    </span>
                                                </div>
                                                <div class="price-and-cart d-flex justify-content-center mt-3 mb-3">
                                                    <span class="price">€{{ number_format($product->variants->first()->price, 2, ',', '.') }}</span>
                                                    <img src="{{ asset('assets/site/img/icons/cart.png') }}" alt="" class="ml-4">
                                                </div>
                                            </div>
                                            <div class="add-to-cart overlay text-center add-to-cart-btn" data-id="{{$product->id}}" data-toggle="modal" data-target="{{$product->subscription == 1 ? '#exampleModalCenter1':'#exampleModalCenter'}}">
                                                <i class="fa fa-plu"></i>
                                                    <button class="btn btn-primary add-to-cart-btn" data-id="{{$product->id}}" type="button"  data-target="{{$product->subscription == 1 ? '#exampleModalCenter1':'#exampleModalCenter'}}">Add to Cart
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                
                                                <!-- <button class="btn btn-primary add-to-cart-btn" data-id="{{$product->id}}" data-toggle="modal" data-target="{{$product->subscription == 1 ? '#exampleModalCenter1':'#exampleModalCenter'}}">Add to Cart
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                        <div class="card s-product shadow-2 h-100">
                                            <div class="card-header px-2 pt-3 d-flex flex-wrap justify-content-between">
                                                <span class="product-category-tag px-2 mb-1" >
                                                    {{$product->category->title}}
                                                </span>
                                                <div class="product-options d-flex">
                                                    <button class="btn btn-transparent">
                                                        <img src="{{ asset('assets/site/img/icons/favorite_unactive.png') }}" alt="">
                                                    </button>
                                                    <button class="btn btn-transparent" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <img src="{{ asset('assets/site/img/icons/filter.png') }}" alt="">
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body-s text-center d-flex flex-column align-items-center mt-2">
                                                <img src="{{ $product->variants->first()->image }}" alt="" class="product-img" style="height: 175px;width: 175px;">
                                                <span>{{ $product->user->name }}</span>
                                                <span>{{ $product->name }}</span>
                                            </div>
                                            <div class="card-footer">
                                                <div class="ratings-and-reviews d-flex justify-content-center">
                                                    <div class="ratings ">                                                            
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <span class="reviews ml-2">
                                                        {{ $product->reviews_count }}
                                                    </span>
                                                </div>
                                                <div class="price-and-cart d-flex justify-content-center mt-3 mb-3">
                                                    <span class="price">€{{ number_format($product->variants->first()->price, 2, ',', '.') }}</span>
                                                    <img src="{{ asset('assets/site/img/icons/cart.png') }}" alt="" class="ml-4">
                                                </div>
                                            </div>
                                            <div class="add-to-cart overlay text-center" >
                                                <i class="fa fa-plu"></i>
                                                
                                                    <div class="add-to-cart overlay text-center">
                                                        <button class="btn btn-black "  type="button" style="font-size: 15px;">Out of Stock&nbsp;
                                                        <i class="fa fa-cube"></i>
                                                        </button>
                                                    </div>
                                                
                                                <!-- <button class="btn btn-primary add-to-cart-btn" data-id="{{$product->id}}" data-toggle="modal" data-target="{{$product->subscription == 1 ? '#exampleModalCenter1':'#exampleModalCenter'}}">Add to Cart
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>    
                                @endif    
                            @endforeach                                
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">2</div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">3</div>
                </div>
            </div>
                <!--tabs-->
            <!--Cart Div-->
            <div class="col-md-3">
                <div class="sidenav">
                    <div class="side-cart" >
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mt-3 mb-3">{{__('msg.total')}}</h3>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mt-3 mb-3" id="total-price-heading">€{{ number_format(str_replace( ',', '', $cartTotal ), 2, ',', '.') }} </h3>                            
                            </div>
                        </div>
                        <div id="cart-item">                        
                            @foreach($items->unique('options.vendorId') as $item)
                                <div class="cart-total d-flex flex-column justify-content-between">
                                    <div class="top d-flex flex-column">
                                        
                                        <div class="item justify-content-between mb-2 px-3">
                                            @foreach($items->where('options.vendorId', $item->options->vendorId) as $item)
                                                <span class="text-black font-13 font-medium">{{$item->name}}</span><span class="text-black font-13 font-medium" style="float:right">({{$item->qty}} x {{number_format($item->price, 2, ',', '.')}})</span><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="text-center" style="bottom: 0; position: absolute; margin: 0 09 10px 100px">
                        @if(auth::check())
                        <a href="{{route('cart.index')}}" class="btn btn-black next-button w-100">{{__('msg.checkoutbtn')}}</a>
                        @elseif(!auth::check())
                        <a href="{{route('cart.index')}}" class="btn btn-black next-button w-100" >Checkout</a>
                        <!-- <a href="#" class="btn btn-black next-button"  >Checkout</a> -->
                        @endif                
                    </div>
                </div>
            </div>
        </div>
            <!--Cart Div-->
            <!-- section-->
    </div>
@endsection

<!-- product modal-->
<!-- Modal -->
<div class="modal productModal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content product-modal">
        <div class="modal-body p-0">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="product-images-container shadow-3  d-flex justify-content-center align-items-center flex-column" style="height: 350px;">
                        <div class="main-product-image py-2">
                         <img id="main-item-image" src="" alt="" style="height: 325px;width: 350px;">
                        </div>
                    </div>     
                </div>
                <div id="snackbar">Item is Added Successfully</div>
                <div class="col-md-6 ">
                        <div class="product-description-container mt-3">
                            <div class="product-description-header  mb-2 d-flex justify-content-between">
                                <h4 id="prod-name" class="m-0"></h4>
                                @if(auth()->check())
                                    <button class="btn btn-transparent favriteActive" id="favriteActive" data-id = "{{ $product->wishlist}} " onclick="changeImage({{$product->id}})">
                                        @if($product->wishlist == 1)
                                            <i id="heartmultiple"  class="fa fa-heart" style="color:red;font-size:1.7rem;" onclick="changemultiple()"></i>
                                        @else
                                            <i id="heart-o-multiple" class="fa fa-heart-o"  aria-hidden="true" style="color:red;font-size:1.7rem;" onclick="changeheartmultiple()"></i>
                                        @endif
                                    </button>
                                @else 
                                <button class="btn btn-transparent favriteActive">
                                    <i id="heart-o-multiple" class="fa fa-heart-o"  aria-hidden="true" style="color:red;font-size:1.7rem;" onClick="loginModal()"></i>
                                </button>
                                @endif
                            </div>
                            <div class="product-description-body d-flex flex-column" style="overflow-y:scroll; height:50%">
                                <p id="variant-description"></p>
                                <div class="colors-variant d-flex mb-3" id="prod-var-images">
                            </div>
                            <div class="cart-qty mb-4">
                            <span class="font-12 text-black mb-2 font-bold">Qty</span>
                                <div class="input-group d-flex mt-2">
                                    <span class="input-group-btn cart-qty-btn">
                                        <button type="button" class="btn btn-danger btn-number btn-min"  data-type="minus" data-field="quant[2]">
                                        <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                        <input id="final-qty" type="text" name="quant[2]" class="input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn cart-qty-btn">
                                        <button type="button" class="btn btn-success btn-number btn-add" data-type="plus" data-field="quant[2]">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="product-description-footer d-flex justify-content-between mt-4 mb-4">
                            <div class="left d-flex">
                                <!-- <form method="get" action="{{route('site.checkout')}}" id="sendCheckout"></form> -->
                                <button data-id="1" data-qty="4" onClick="addToCart()" class="btn btn-black">Add to Cart</button>
                                <button class="btn btn-transparent ml-2">Help</button>
                            </div>
                            <input id="final-variant-id" type="hidden" value="">
                            <input id="" type="hidden" value="">
                            <div class="right">
                                <span id="prod-varient-price" class="price productModalPrice"></span>
                            </div>
                        </div>                 
                    </div>
                </div>
            </div>
        </div>
            <button class="btn btn-black close-modal py-2" onclick="products()" data-dismiss="modal">
                <i class="fa fa-close"></i>
            </button>
      </div>
    </div>
</div>
<!-- product modal closed-->
<!-- product modal Subscription-->
<!-- Modal -->
<div class="modal" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content  product-modal v2">
        <div class="modal-body p-0">
            <div class="row">
              <div class="col-md-6 ">
                  <div class="product-image-container shadow-3  text-center d-flex flex-column align-items-center justify-content-center">
                      @foreach($products as $prod)
                      @if($prod->subscription == 1)
                      <div class="main-product-image ">
                                    <img src="{{$prod->variants[0]->image}}" style="height: 325px;width: 350px;" alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>     
                </div>
              <input type="hidden" id="cyclevalue" name="duration" value="">
                @foreach($products as $product)
                @if($product->subscription == 1)
                <!-- <div id="snackbar">Item is Added Successfully</div> -->
                <div id="snackbar3" >Item is Added Successfully</div>
                <div class="col-md-6">
                    <div class="product-description-container mt-3">
                        <div class="product-description-header mb-2 d-flex justify-content-between">
                            <h4 class="m-0"  id="subid" data-subscribtion="{{$product->id}}">{{$product->name}}</h4>
                            <input type="hidden" id="product_id" value=" " name="product_id">
                            <input type="hidden" id="vendor_id" value="{{$product->vendor_id}}" name="vendor_id">
                            <button class="btn btn-transparent favriteActive" id="favriteActive" data-id = "{{ $product->wishlist}} " onclick="changeImage({{ $product->id}})">
                                @if($product->wishlist == 1)
                                    <i id="heart"  class="fa fa-heart" style="color:red;font-size:1.7rem;" onclick="change()"></i>
                                @else
                                    <i class="fa fa-heart-o" id="heart-o" aria-hidden="true" style="color:red;font-size:1.7rem;" onclick="changeheart()"></i>
                                @endif
                            </button>
                        </div>
                        <div class="product-description-body d-flex flex-column">
                            <p><b>Description:</b>{{$product->variants[0]->description}}</p>
                            <span class="font-12 text-black mb-2 font-bold">Select Cycle Period</span>
                            <div class="cycle-period d-flex mb-4">
                                <button type="button" class="subscribtion btn red mr-1"  id="daily" onclick="subscribtionCycle1()"><i id ="check1" class=""></i> Daily</button>
                                <button type="button" class="subscribtion btn black mr-1" id="weekly" onclick="subscribtionCycle3()"><i id ="check2" class=""></i> Weekly</button>
                                <button type="button" class="subscribtion btn red mr-1"  id="monthly" onclick="subscribtionCycle2()"><i id ="check3" class=""></i> Monthly</button>
                            </div>
                            <div class="pickup-time-date d-flex justify-content-between ">
                                <div class="time d-flex flex-column ">
                                <span class="font-12 text-black mb-2 font-bold">Date</span>
                                <div class="form-col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text date-time-group" id="basic-addon1">+</span>
                                        </div>
                                        <input type="date" id="reqdate" class="form-control date-time time" name="req_date"  aria-label="Username" aria-describedby="basic-addon1" value=" ">
                                    </div>
                                </div>
                                </div>
                                <div class="date d-flex flex-column">
                                <span class="font-12 text-black mb-2 font-bold">Time</span>
                                <div class="form-col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text date-time-group" id="basic-addon1">+</span>
                                        </div>
                                        <input type="time" id="start-time"  name="starting" value=" " class="form-control date-time date" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-description-footer d-flex justify-content-between mt-4">
                            <div class="left d-flex">
                                <button class="btn btn-black" onclick="subscribe()">Subscribe</button>
                                <!-- <button class="btn btn-white ml-2" type="button">Packages</button> -->
                            </div>
                            <div class="right">
                                <span class="price" id="pirce">€{{number_format($product->variants[0]->price, 2, ',', '.')}}</span>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
              </div>
          </div>
        </div>
        <button class="btn btn-black close-modal" data-dismiss="modal">
            <i class="fa fa-close"></i>
        </button>
      </div>
    </div>
</div>
<!-- product modal Subscription closed-->

    <!-- Optional JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->    
    <script src="{{ asset('assets/site/js/cart.js') }}"></script>
    <!-- Initialize Swiper -->
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<!-- Initialize Swiper -->
    <script>
		var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    </script>
    <script>        
        $('body').on('click' , '.add-to-cart-btn', function() {
            id = $(this).attr('data-id');
            let route = `{{route('product.data')}}`
            $.ajax({
                url : route+'/'+id,
                type : "GET",
                datatype : "json",
                success:function(result){
                    // $('#cart-count').html(result.count)
                    
                    var product = result.product
                    $('#main-item-image').attr('src', product.image)
                    $('#prod-name').html(product.name)
                    // var description = product.description;
                    jQuery.nl2br = function(val){
                        return val.replace(/(\r\n|\n\r|\r|\n)/g, "<br>");
                    };                    
                    $('#variant-description').html('<b>Description</b>: '+$.nl2br(product.description))
                    $('#prod-varient-price').html('€'+Number(product.price).toLocaleString("es-ES", {minimumFractionDigits: 2}))
                    
                    html = ''
                    $.each(product.variants, function(index, variant){
                        html += `<div class="p-1">
                                <img src="${variant.image}" onClick="imageChange(${variant.id})" height="60px" width="60px">
                            </div>`
                    })
                    $('#prod-var-images').html(html)
                    $('#final-variant-id').val(product.variants[0].id)
                    
                }
            });
        });
        

        function imageChange(id)
        {
            let route = `{{route('variant.data')}}`
            $.ajax({
                url : route+'/'+id,
                type : "GET",
                datatype : "json",
                success:function(result){              
                    $('#main-item-image').attr('src', result.image)                    
                    $('#variant-description').html('<b>Description</b>: '+result.description)
                    $('#prod-varient-price').html('€'+Number(result.price).toLocaleString("es-ES", {minimumFractionDigits: 2}))
                    $('#final-variant-id').val(result.id)
                }
            });
        }

        function addToCart(){
            
            variantId = $('#final-variant-id').val()
            qty = $('#final-qty').val()
            let route = `{{route('add-to-cart')}}`
            $.ajax({
                url : route,
                type : "GET",
                datatype : "json",
                data : {
                    variantId : variantId,
                    quantity : qty
                },
                
                success:function(result){
                 $('#cart-count').html(result.count);
                    html =``;
                    html1 =``;
                    html2 = ``;
                    
                    html +=`<h3 class="mt-3 mb-3">€${ Number(result.total).toLocaleString("es-ES", {minimumFractionDigits: 2})}</h3>`
                    $('#total-price-heading').html(html)
                    var vendorIds = []; 
                    $.each(result.items, function(index, item){
                        vendorIds.push(item.options.vendorId)
                    });
                    
                if(Object.keys(result.items).length > 0){
                        $.each(result.items, function(index, item){
                            var allVendorIds = vendorIds.includes(item.options.vendorId); 
                            html2 +=`<div class="cart-total d-flex flex-column justify-content-between">
                                <div class="top d-flex flex-column">                                    
                                    <div class="item justify-content-between mb-2 px-3">`;
                                    const filteredByValue = Object.fromEntries(
                                        Object.entries(result.items).filter(([key, value]) => value.options.vendorId === item.options.vendorId)
                                        )
                                        $.each(filteredByValue, function(index, innerItem){
                                            if(allVendorIds == true)
                                            {
                                            html2 +=`<span class="text-black font-13 font-medium">${item.name}</span> <span class="text-black font-13 font-medium" style="float:right">(${item.qty} x ${ Number(item.price).toLocaleString("es-ES", {minimumFractionDigits: 2})})</span><br>`
                                            return false;

                                            }
                                                                
                                        });                                    
                                    html2 +=`</div>
                                </div>
                            </div>`;
                        })
                        $('#cart-item').html('')
                        $('#cart-item').html(html2)
                    }
                }
              
            });
            snackbar()
        }  
        

        function getProducts(){ 
            vendorId = `{{$vendorId}}`
           variantId = $('#final-variant-id').val()
            qty = $('#final-qty').val()
            $.ajax({
                url : route,
                type : "GET",
                datatype : "json",
                data : {
                    variantId : variantId,
                    quantity : qty
                },
                success:function(result){
                    $('#cart-count').html(result.count)
                }
            });
        }
        function subscribtionCycle1()
        {
            cycle = $('#daily').text();
            $('#cyclevalue').val('day');
            console.log($('#cyclevalue').val());
            document.getElementById("check1").className = "fa fa-check";
            document.getElementById("check2").className = " ";
            document.getElementById("check3").className = " ";
            
        }
        function subscribtionCycle2()
        {
            cycle = $('#monthly').text();
            $('#cyclevalue').val('month');
            console.log($('#cyclevalue').val());
            document.getElementById("check1").className = " ";
            document.getElementById("check2").className = " ";
            document.getElementById("check3").className = "fa fa-check";
        }
        function subscribtionCycle3()
        {
            cycle = $('#weekly').text();
            $('#cyclevalue').val('week');
            console.log($('#cyclevalue').val());
            document.getElementById("check1").className = " ";
            document.getElementById("check2").className = "fa fa-check";
            document.getElementById("check3").className = " ";
        } 
        function subscribe()
        {        
            variantId = $('#final-variant-id').val()
            subscribeId = $('#subid').attr('data-subscribtion');
            $('#product_id').val(subscribeId)
            date = $('#date').val()
            time = $('#start-time').val()
            reqdate = $('#reqdate').val()
            cycle = $('#cyclevalue').val()
            price = $('#pirce').text()
            let route = `{{route('subscribtion')}}`
            $.ajax({
                url : route,
                type : "GET",
                datatype : "json",
                data : {
                    variantId : variantId,
                    quantity : 1,
                    date: reqdate,
                    time: time,
                    cycle: cycle,
                },
                success:function(result){
                    $('#cart-count').html(result.count)

                    html =``;
                    html1 =``;
                    html2 = ``;
                    
                    html +=`<h3 class="mt-3 mb-3">€${ Number(result.total).toLocaleString("es-ES", {minimumFractionDigits: 2})}</h3>`
                    $('#total-price-heading').html(html)
                    var vendorIds = []; 
                    $.each(result.items, function(index, item){
                        vendorIds.push(item.options.vendorId)
                    });
                    
                if(Object.keys(result.items).length > 0){
                        $.each(result.items, function(index, item){
                            var allVendorIds = vendorIds.includes(item.options.vendorId); 
                            html2 +=`<div class="cart-total d-flex flex-column justify-content-between">
                                <div class="top d-flex flex-column">                                    
                                    <div class="item justify-content-between mb-2 px-3">`;
                                    const filteredByValue = Object.fromEntries(
                                        Object.entries(result.items).filter(([key, value]) => value.options.vendorId === item.options.vendorId)
                                        )
                                        $.each(filteredByValue, function(index, innerItem){
                                            if(allVendorIds == true)
                                            {
                                            html2 +=`<span class="text-black font-13 font-medium">${item.name} (${item.qty} x ${ Number(item.price).toLocaleString("es-ES", {minimumFractionDigits: 2})})</span><br>`
                                            return false;
                                            }
                                                                
                                        });                                    
                                    html2 +=`</div>
                                </div>
                            </div>`;
                        })
                        $('#cart-item').html('')
                        $('#cart-item').html(html2)
                    }
                }
            });
            
            snackbar3()
        }
        function snackbar()
        {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
        function snackbar3()
        {
            var x = document.getElementById("snackbar3");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    </script>
    <script type="text/javascript">
    $('body').on('click', '.category',function(){
            vendorId = `{{$vendorId}}`
            catId = $(this).attr('data-cat-id')
            route = `{{route('site')}}`
            route = route+'/explore-shops/'+vendorId+'/'+'cat/'+catId;
            $.ajax({
                url : route,
                type : "GET",
                datatype : "JSON",
                success:function(result){
                    html = ``;
                    console.log(result)
                    $.each(result, function(index, product){
                        html += `<div class="col-md-4 mb-3">
                                            <div class="card s-product shadow-2">
                                                <div class="card-header px-2 pt-3 d-flex justify-content-between">
                                                    <span class="product-category-tag" style="min-width: 40%;">
                                                        ${product.category.title}
                                                    </span>
                                                    <div class="product-options d-flex">
                                                        <button class="btn btn-transparent">
                                                            <img src="{{ asset('assets/site/img/icons/favorite_unactive.png') }}" alt="">
                                                        </button>
                                                        <button class="btn btn-transparent" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                            <img src="{{ asset('assets/site/img/icons/filter.png') }}" alt="">
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body-s text-center d-flex flex-column align-items-center mt-2">
                                                    <img src="${ product.variants[0].image }" alt="" class="product-img" style="height:200px">
                                                    <span>${ product.user.name }</span>
                                                    <span>${ product.name }</span>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="ratings-and-reviews d-flex justify-content-center">
                                                        <div class="ratings ">                                                            
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                        <span class="reviews ml-2">
                                                            ${ product.reviews_count }
                                                        </span>
                                                    </div>
                                                    <div class="price-and-cart d-flex justify-content-center mt-3 mb-3">
                                                        <span class="price">€${ Number(product.variants[0].price).toLocaleString("es-ES", {minimumFractionDigits: 2}) }</span>
                                                        <img src="{{ asset('assets/site/img/icons/cart.png') }}" alt="" class="ml-4">
                                                    </div>
                                                </div>
                                                <div class="add-to-cart overlay text-center">
                                                    <i class="fa fa-plu"></i>
                                                    <button class="btn btn-primary add-to-cart-btn" data-id="${product.id}" data-toggle="modal" data-target="${product.subscription == 1 ? '#exampleModalCenter1':'#exampleModalCenter'}">Add to Cart
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>`;
                        })
                    $('#products-div').html(html);
                }
                
            });
        })
    </script>
    <script>

    function changeImage(id)
    {
        let route = `{{route('wishlist')}}`
        console.log(route+'/'+id);
        $.ajax({
                url : route+'/'+id,
                type : "GET",
                datatype : "json",               
                success:function(result){
                console.log(result);
                }
            });

    }
    function change()
    {
        if(document.getElementById("heart").className == "fa fa-heart")
        {

            document.getElementById("heart").className = "fa fa-heart-o";
        }
        else
        {

            document.getElementById("heart").className="fa fa-heart";
        }

        // document.getElementById("heart").className = "fa fa-heart-o";

    }
    function changeheart()
    {
        if(document.getElementById("heart-o").className == "fa fa-heart-o")
        {

            document.getElementById("heart-o").className ="fa fa-heart";
        }
        else
        {

            document.getElementById("heart-o").className ="fa fa-heart-o";
        }


    }
    function changemultiple()
    {
        if(document.getElementById("heartmultiple").className == "fa fa-heart")
        {

            document.getElementById("heartmultiple").className = "fa fa-heart-o";
        }
        else
        {

            document.getElementById("heartmultiple").className="fa fa-heart";
        }

        // document.getElementById("heart").className = "fa fa-heart-o";

    }
    function changeheartmultiple()
    {
        if(document.getElementById("heart-o-multiple").className == "fa fa-heart-o")
        {

            document.getElementById("heart-o-multiple").className ="fa fa-heart";
        }
        else
        {

            document.getElementById("heart-o-multiple").className ="fa fa-heart-o";
        }


    }
$('#exampleModalCenter').on('hidden',function()
{
    location.reload();
});
</script>

    