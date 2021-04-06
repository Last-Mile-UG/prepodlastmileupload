@extends('layouts.site.app', [
    
    ])
    
    @section('content')

    <style>
/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
    <div class="container-fuild">
        <div class="row" style="margin-top:-16px">
            <div class="swiper-container promo my-3 ">
                <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide ">
                        <span>ELECTRO BEATS</span>
                        <img src="{{ $banner->image }}" style="width:1590px;height:300px" alt=""> 
                    </div>
                @endforeach    
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next" onclick="plusSlides(-1)"></div>
                <div class="swiper-button-prev" onclick="plusSlides(1)"></div>
            </div>  
        </div>
    </div>

        <div class="container">
        
            <div class="row">
                 <div class="col-sm-12 col-sm-12 col-md-12 col-lg-4 mt-3"> 
                     <!--sidebar-->
                    @include('layouts/navbars/userSidebar')
                     <!--sidebarend-->
                    <div class="promo-area mt-4 mb-3">
                        <a href="">
                            <img src="assets/img/promo-card.png" alt="">
                        </a>
                    </div>
                </div>
    
                <div class="col-sm-12 col-md-12 col-lg-8 mt-3">
                     <!--tab bar-->                      
                    <!-- <div class="tab-bar d-flex justify-content-between shadow-1 mb-4">
                        <ul class="nav nav-pills custom-tab " id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active py-3 ml-2 mr-2 " id="pills-all" data-toggle="pill" href="#pills-show-all" role="tab" aria-controls="pills-show-all" aria-selected="true">Show All</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link py-3 mx-2" id="pills-product" data-toggle="pill" href="#pills-product-only" role="tab" aria-controls="pills-product-only" aria-selected="false">Products Only</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link py-3 mx-2" id="#pills-only" data-toggle="pill" href="#pills-subscription-only" role="tab" aria-controls="subscription-only" data-toggle="pill" href="#pills-subscription-only" aria-selected="false">Subscription Only</a>
                            </li>
                        </ul>
                        <ul class="nav d-flex">
                            <li class="nav-item d-flex">
                                <a class="nav-link active py-3  border-left border-right">
                                     <img src="assets/img/icons/view.png" alt="">
                                </a>
                                <a class="nav-link active py-3 ">
                                    <img src="assets/img/icons/menu.png" alt="">
                               </a>
                            </li>
                        </ul>
                    </div> -->
                    <!-- tab bar closed-->
    
                     <!--tab bar content-->  
                    <div class="tab-content" id="pills-tabContent" style="background-color:transparent;">
                    <!-- for show all-->
                    <div class="tab-pane fade show active" id="pills-show-all" role="tabpanel" aria-labelledby="pills-show-all">
                        <div class="row pb-3">
                            <div class="col-md-12">
                                <h4 class="text-grey-1 mb-3">{{__('msg.allorders')}}</h4>
                            </div> 
                            @foreach($orders as $order)
                            <!-- {{$order->details}} -->
                                 @foreach($order->details as $orderdetail)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                                    <div class="order-item shadow-1 p-2 ">
                                        <div class="order-item-header d-flex justify-content-between">
                                            <span class="order-item-category pl-2 pr-2">
                                            <p style="display:none"> {{$b = __('msg.productsC')}}</p>

                                             <p style="display:none">{{$a =__('msg.subcription')}}</p>
                                                
                                                {{ $orderdetail->variant->product->subscription ? $a : $b}}
                                            </span>
                                            <div class="order-items-options d-flex">
                                                <button class="btn btn-transparent">
                                                    <img src="{{asset('assets/site/img/icons/filter.png')}}" alt="">
                                                </button>
                                                <button class="btn btn-transparent">
                                                    <img src="{{asset('assets/site/img/icons/favorite_unactive.png')}}" alt="">
                                                </button>
                                            </div>  
                                        </div>
                                        <div class="order-item-content">
                                            <div class="d-flex flex-column justify-content-between">
                                                <div class="order-item-price d-flex my-2">
                                                    <span class="text-black font-black mr-3">€{{$orderdetail->total_price}}</span>
                                                    <img src="{{asset('assets/site/img/icons/cart_2.png')}}" alt="">
                                                </div> 
                                                <div class="order-item-details d-flex">
                                                    <div class="order-item-desc-review align-self-end d-flex flex-column">
                                                        <span class="text-black order-item-tagline">{{$orderdetail->variant->product->name ?? '--' }}</span>
                                                        <span class="text-grey order-item-description">{{$orderdetail->variant->description ?? '--' }}</span>
                                                        <div class="ratings">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </div>
                                                    <div class="order-item-img">
                                                        <img src="{{$orderdetail->variant->image}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <!-- for show all-->
    
                    <!-- for products only-->
                    <div class="tab-pane fade" id="pills-product-only" role="tabpanel" aria-labelledby="pills-product-only">
                        <div class="row pb-3">
                            <div class="col-md-12">
                                <h4 class="my-4 text-grey-1">{{__('msg.productsonly')}}</h4>
                            </div>  
                            @foreach($unsubscribeOrders as $order)
                            @foreach($order->details as $productdetail)
                                <div class="col-md-4 mb-2">
                                    <div class="order-item shadow-1 p-2 ">
                                        <div class="order-item-header d-flex justify-content-between">
                                            <span class="order-item-category pl-2 pr-2">
                                                {{__('msg.productsC')}}
                                            </span>
                                            <div class="order-items-options d-flex">
                                                <button class="btn btn-transparent">
                                                    <img src="{{asset('assets/site/img/icons/filter.png')}}" alt="">
                                                </button>
                                                <button class="btn btn-transparent">
                                                    <img src="{{asset('assets/site/img/icons/favorite_unactive.png')}}" alt="">
                                                </button>
                                            </div>  
                                        </div>
                                        <div class="order-item-content">
                                            <div class="d-flex flex-column justify-content-between">
                                                <div class="order-item-price d-flex my-2">
                                                    <span class="text-black font-black mr-3">€{{$productdetail->price}}</span>
                                                    <img src="{{asset('assets/site/img/icons/cart_2.png')}}" alt="">
                                                </div> 
                                                <div class="order-item-details d-flex">
                                                    <div class="order-item-desc-review align-self-end d-flex flex-column">
                                                        <span class="text-black order-item-tagline">{{$productdetail->variant->product->name ?? '--' }}</span>
                                                        <span class="text-grey order-item-description">{{$productdetail->variant->description ?? '--' }}</span>
                                                        <div class="ratings">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </div>
                                                    <div class="order-item-img">
                                                        <img src="{{ $productdetail->variant->image}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                            @endforeach    
                        </div>
                    </div>
                    <!-- for products only-->  
    
                     <!-- for subscription-->  
                    <div class="tab-pane fade" id="pills-subscription-only" role="tabpanel" aria-labelledby="pills-subscription-only">
                        <div class="row pb-3">
                            <div class="col-md-12">
                            <h4 class="my-4 text-grey-1">{{__('msg.subscriptiononly')}}</h4>
                            </div> 
                            @foreach($subscriptionOrders as $order)
                            @foreach($order->details as $detail)
                            <div class="col-md-4 mb-2">
                                <div class="order-item shadow-1 p-2 ">
                                        <div class="order-item-header d-flex justify-content-between">
                                            <span class="order-item-category pr-2 pl-2">
                                            {{__('msg.subcription')}}
                                            </span>
                                            <div class="order-items-options d-flex">
                                                <button class="btn btn-transparent">
                                                    <img src="assets/img/icons/filter.png" alt="">
                                                </button>
                                                <button class="btn btn-transparent">
                                                    <img src="assets/img/icons/favorite_unactive.png" alt="">
                                                </button>
                                            </div>  
                                        </div>
                                        <div class="order-item-content">
                                            <div class="d-flex flex-column justify-content-between">
                                                <div class="order-item-price d-flex my-2">
                                                    <span class="text-black font-black mr-3">€{{$detail->price}}</span>
                                                    <img src="{{asset('assets/site/img/icons/cart_2.png')}}" alt="">
                                                </div> 
                                                <div class="order-item-details d-flex">
                                                    <div class="order-item-desc-review align-self-end d-flex flex-column">
                                                        <span class="text-black order-item-tagline">{{$detail->variant->product->name ?? '--' }}</span>
                                                        <span class="text-grey order-item-description">{{$detail->variant->description ?? '--' }}</span>
                                                        <div class="ratings">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </div>
                                                    <div class="order-item-img">
                                                        <img src="{{ $detail->variant->image}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                           @endforeach
                        </div>
                    </div>
                     <!-- for subscription--> 
                    </div>
                     <!--tab bar content closed-->  
                    
    
                </div>
    
            </div>
        </div>
        <!--container closed-->
        
    @endsection
    
    @stack('js')

<script>
var slideIndex = 0;



function showSlides() {
  var i;
  var slides = document.getElementsByClassName("swiper-slide");
    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  slides[slideIndex-1].style.display = "block";  
}

var slideIndex1= 1;

showSlides();
function plusSlides(n) {
  showSlides(slideIndex1+= n);
}

function currentSlide(n) {
  showSlides(slideIndex1= n);
}
</script>