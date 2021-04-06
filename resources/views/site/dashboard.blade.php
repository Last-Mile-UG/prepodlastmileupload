@extends('layouts.site.app', [
    
    ])
    
    @section('content')
    
    <div class="container-fuild">
        <div class="row">
           <div class="swiper-container promo mb-3 ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide ">
                        <span>ELECTRO BEATS</span>
                        <img src="{{ asset('assets/site/img/banners/promo-banner.png') }}" alt=""> 
                    </div>
                    <div class="swiper-slide ">
                        <span>SPECIAL BEATS</span>
                        <img src="{{ asset('assets/site/img/banners/promo-banner.png') }}" alt=""> 
                    </div>
                    <div class="swiper-slide ">
                        <span>CLASSICAL BEATS</span>
                        <img src="{{ asset('assets/site/img/banners/promo-banner.png') }}" alt=""> 
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>  
        </div> <!-- row closed-->

    </div>

        <div class="container">
           <div class="row">
                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-4 mt-3"> 
                      <!-- side bar-->
                      @include('layouts/navbars/userSidebar')
                     <!-- side bar-->
                    <div class="promo-area mb-2 mt-4 text-center">
                        <a href="">
                            <img src="{{ asset('assets/site/img/promo-card.png') }}" alt="">
                        </a>
                    </div>
                </div> <!--col closed-->
    
    
                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-8 mb-2 mt-3">
                    <div class="track-order shadow-1 mb-4">
                      <div class="row">
                        <div class="col-md-6 left pb-4">
                            <h4 class="my-4 text-grey-1">{{__('msg.trackyourorders')}}</h4>
                            <div class="orders d-flex flex-column">
                                @foreach($vendoraccept as $order)
                                @foreach($order->details as $details)
                                    <div class="order px-3 mb-2 py-1">
                                        <div class="order-t d-flex justify-content-between mt-2 mb-1">
                                            <span class="text-black font-700 font-18">{{$details->users->name}}</span>
                                            <span class="track-label">{{__('msg.track')}}</span>
                                        </div>
                                        <div class="order-b d-flex justify-content-between mt-1 mb-2">
                                            <span class="text-black">
                                                <img src="assets/img/icons/location.png" alt="">
                                                Downtown, Khi</span>
                                            <span class="text-black">
                                                <img src="assets/img/icons/calendar.png" alt="">
                                                {{$order->created_at}}</span>
                                        </div>
                                    </div>
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 right py-4">
                            <!-- <div class="map" id="map" style="height: 270px; position:relative; overflow:block">
                            </div> -->
                            <div id="map-canvas"  style="height: 270px; position:relative; overflow:block">
                            </div>
                            <div id="map-output">
                            </div>
                        </div>
                      </div>
                    </div>
                     <!--tab bar-->                      
                    <div class="tab-bar d-flex justify-content-between shadow-1 mb-4">
                        <ul class="nav nav-pills custom-tab d-flex flex-column flex-sm-row flex-md-row flex-lg-row" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active py-3 text-left ml-0 ml-sm-0 ml-md-3 ml-lg-3" id="pills-all" data-toggle="pill" href="#pills-show-all" role="tab" aria-controls="pills-show-all" aria-selected="true"> {{__('msg.All')}}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link py-3 text-left" id="pills-product" data-toggle="pill" href="#pills-product-only" role="tab" aria-controls="pills-product-only" aria-selected="false">{{__('msg.productsonly')}}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link py-3 " id="#pills-only" data-toggle="pill" href="#pills-subscription-only" role="tab" aria-controls="subscription-only" data-toggle="pill" href="#pills-subscription-only" aria-selected="false">{{__('msg.subscriptiononly')}}</a>
                            </li>
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
                    <!-- tab bar closed-->
    
                     <!--tab bar content-->  
                    <div class="tab-content my-4" id="pills-tabContent">
                    <!-- for show all-->
                    <div class="tab-pane fade show active" id="pills-show-all" role="tabpanel" aria-labelledby="pills-show-all">
                        <div class="row shadow-1 pb-3">
                            <div class="col-md-12">
                                <h4 class="my-4 text-grey-1">{{__('msg.recentorder')}}</h4>
                            </div> 
                            @foreach($orders as $order)
                            @foreach($order->details as $details)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                                    <div class="order-item shadow-2 p-2 ">
                                        <div class="order-item-header d-flex justify-content-between">
                                            <span class="order-item-category px-2">
                                            <p style="display:none"> {{$b = __('msg.productsC')}}</p>

                                            <p style="display:none">{{$a =__('msg.subcription')}}</p>
                                            {{ $details->variant->product->subscription ? $a : $b}}
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
                                                    <span class="text-black font-black mr-3">€{{$order->price}}</span>
                                                    <img src="{{asset('assets/site/img/icons/cart_2.png')}}" alt="">
                                                </div> 
                                                <div class="order-item-details d-flex">
                                                    <div class="order-item-desc-review align-self-end d-flex flex-column">
                                                        <span class="text-black order-item-tagline">{{ $order->details->first()->variant->product->name ?? '--' }}</span>
                                                        <span class="text-grey order-item-description">{{ $order->details->first()->variant->description ?? '--' }}</span>
                                                        <div class="ratings">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </div>
                                                    <div class="order-item-img">
                                                        <img src="{{ $details->variant->image}}" alt="">
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
                            <div class="row shadow-1 pb-3">
                                <div class="col-md-12">
                                <h4 class="my-4 text-grey-1">{{__('msg.productsonly')}}</h4>
                                </div>  
                                @foreach($unsubscribeOrders as $order)
                                @foreach($order->details as $productdetail)
                                    <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                                        <div class="order-item shadow-2 p-2 h-100">
                                            <div class="order-item-header d-flex justify-content-between">
                                                <span class="order-item-category px-2">
                                                    {{__('msg.productsC')}}
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
                                                        <span class="text-black font-black mr-3 font-14">€{{$productdetail->price}}</span>
                                                        <img src="assets/img/icons/cart_2.png" alt="">
                                                    </div> 
                                                    <div class="order-item-details d-flex justify-content-between">
                                                        <div class="order-item-desc-review align-self-end d-flex flex-column">
                                                            <span class="text-black order-item-tagline font-13 font-medium">{{$productdetail->variant->product->name ?? '--' }}</span>
                                                            <span class="text-grey order-item-description font-13 ">{{$productdetail->variant->description ?? '--' }}</span>
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
                        <div class="row shadow-1 pb-3">
                            <div class="col-md-12">
                            <h4 class="my-4 text-grey-1">{{__('msg.subscriptiononly')}}</h4>
                            </div> 
                            @foreach($subscriptionOrders as $order)
                            @foreach($order->details as $detail)
                                <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                                    <div class="order-item shadow-2 p-2 h-100">
                                        <div class="order-item-header d-flex justify-content-between">
                                            <span class="order-item-category px-2">
                                                SUBSCRIPTION
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
                                                    <span class="text-black font-black mr-3 font-14">€{{$detail->price}}</span>
                                                    <img src="assets/img/icons/cart_2.png" alt="">
                                                </div> 
                                                <div class="order-item-details d-flex justify-content-between">
                                                    <div class="order-item-desc-review align-self-end d-flex flex-column">
                                                        <span class="text-black order-item-tagline font-13 font-medium">{{$detail->variant->product->name ?? '--' }}</span>
                                                        <span class="text-grey order-item-description font-13 ">{{$detail->variant->description ?? '--' }}</span>
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
                    
    
                </div> <!--col closed-->
    
            </div> <!-- row closed -->
    
    
            
        </div>
        <!--container closed-->
        
    @endsection
    
    @stack('js')
       <!--Map Js Start-->
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true&amp;key=AIzaSyCF8vXfHR8LRRMvD9N4zPIdawHbI6tJQjM&amp;callback=loadmap&amp;libraries=places" defer></script>
<script type="text/javascript">
		/*
		 * Google Maps: Latitude-Longitude Finder Tool
		 * https://salman-w.blogspot.com/2009/03/latitude-longitude-finder-tool.html
		 */
		function loadmap() {
           
            var input = document.getElementById('search-txt');
            var autocomplete = new google.maps.places.Autocomplete(input);
			// initialize map
			var map = new google.maps.Map(document.getElementById("map-canvas"), {
				center: new google.maps.LatLng(50.11004891373826, 8.682209875807558),
				// center: new google.maps.LatLng(`{{$lat}}`, `{{$lng}}`),
				zoom: 13,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			// initialize marker
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(50.11004891373826, 8.682209875807558),
				// position: new google.maps.LatLng(`{{$lat}}`, `{{$lng}}`),
				draggable: true,
				map: map
			});
           
			// intercept map and marker movements
			google.maps.event.addListener(map, "idle", function() {
				marker.setPosition(map.getCenter());
                //For Nearest Vendor
                var lati =  marker.getPosition().lat()
                var longi =   marker.getPosition().lng()
               var a = document.getElementById("getlat").value = lati;
               var b = document.getElementById("getlong").value = longi;
               //For Nearest Vendor
                
               var longitude = document.getElementById("lat").value = map.getCenter().lat().toFixed(6);
                var latitude = document.getElementById("long").value = map.getCenter().lng().toFixed(6);
                
            });
			google.maps.event.addListener(marker, "dragend", function(mapEvent) {
				map.panTo(mapEvent.latLng);
			});
			// initialize geocoder
			var geocoder = new google.maps.Geocoder();
			google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function() {
				geocoder.geocode({ address: document.getElementById("search-txt").value }, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var result = results[0];                        
						document.getElementById("search-txt").value = result.formatted_address;
						if (result.geometry.viewport) {
						map.fitBounds(result.geometry.viewport);
                        
						} else {
							map.setCenter(result.geometry.location);
						}
					} else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
						alert("Sorry, geocoder API failed to locate the address.");
					} else {
						alert("Sorry, geocoder API failed with an error.");
					}
				});
			});
			google.maps.event.addDomListener(document.getElementById("search-txt"), "keydown", function(domEvent) {
				if (domEvent.which === 13 || domEvent.keyCode === 13) {
					google.maps.event.trigger(document.getElementById("search-btn"), "click");
				}
			});
			// initialize geolocation
            // console.log(navigator.geolocation)
			if (navigator.geolocation) {
				google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {

					navigator.geolocation.getCurrentPosition(function(position) {
                        // console.log(result);
                        var result = position.formatted_address;
                        document.getElementById("search-txt").value = position.formatted_address;
                        map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
					

                    }, function() {
						alert("Sorry, geolocation API failed to detect your location.");
					});
				});
				document.getElementById("detect-btn").disabled = false;
			}
		}
       
</script>
<!--Map Js Start-->
    
      