@extends('layouts.site.app', [
    
    ])
    @section('content')
        <div class="pt-150"></div>
        
<div class="row no-gutters">
    <div class="col-md-12">
            <div class="swiper-container feature-banner-container">
            <div class="swiper-wrapper">
            <div class="swiper-slide">
            <img  src="{{ asset('assets/site/img/featured-banners/1.jpg') }}" alt="First Banner">
            </div>
            <div class="swiper-slide">
            <img  src="{{ asset('assets/site/img/featured-banners/2.jpg') }}" alt="Second Banner">
            </div>
            <div class="swiper-slide">
            <img  src="{{ asset('assets/site/img/featured-banners/3.jpg') }}" alt="Third Banner">
            </div>
            <div class="swiper-slide">
            <img  src="{{ asset('assets/site/img/featured-banners/4.jpg') }}" alt="Fourth Banner">
            </div>
            <div class="swiper-slide">
            <img src="{{ asset('assets/site/img/featured-banners/5.jpg') }}" alt="Fifth Banner">
            </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

        <div class="row ">
        <div class="col-md-12 bg-white" style="z-index:2;">
            <div class="section get-it-now ">
                <div class="get-it-now text-center py-3">
                    <h3 class="font-bold">{{__('msg.getheading')}}</h3>
                    <p class="mb-3">{{__('msg.getpara')}}
                    <br>{{__('msg.getpara2')}}
                    </p>
                    <button id="shopNowBtn" class="btn btn-green" onclick="setLocationFocus()">{{__('msg.shopnow')}}</button>
                </div>
                <div class="row">
            <div class="col-md-12">
                <div class="section easy-steps d-flex flex-column align-items-center justify-content-center">
                    <div class="steps d-flex flex-wrap justify-content-center align-items-center mb-4 mt-4">
                        <div class="step one d-flex flex-column justify-content-center align-items-center mr-0 mr-md-3 mb-2">
                            <img src="{{ asset('assets/site/img/icons/landing_page/map-marker.svg') }}" alt="">
                            <span>INPUT ADDRESS</span>
                        </div>
                        <div class="step two d-flex flex-column justify-content-center align-items-center mr-0 mr-md-3 mb-2">
                            <img src="{{ asset('assets/site/img/icons/landing_page/store.svg') }}" alt="">
                            <span>GO TO STORE</span>
                        </div>
                        <div class="step three d-flex flex-column justify-content-center align-items-center mr-0 mr-md-3 mb-2">
                            <img src="{{ asset('assets/site/img/icons/landing_page/cart.svg') }}" alt="">
                            <span>ADD TO CART</span>
                        </div>
                        <div class="step four d-flex flex-column justify-content-center align-items-center mr-0 mr-md-3 mb-2">
                            <img src="{{ asset('assets/site/img/icons/landing_page/checkout.svg') }}" alt="">
                            <span>CHECKOUT</span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6 bg-black p-0 order-2 order-md-1" style="position:relative">
            <div class="section buy-subscribe bg-grey d-flex flex-column justify-content-center" style="position:relative">
                <img src="{{ asset('assets/site/img/triangle.png') }}" alt="" class="triangle">
                <div class="buy-subscribe px-5">
                    <h3 class="font-bold">{{__('msg.buyheading')}}</h3>
                    <p class="mb-3">
                    {{__('msg.buypara')}}
                    </p>
                    <button class="btn btn-dark-grey-2" onclick="signUpModal()">{{__('msg.registerbtn')}}</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-0 order-1 order-md-2">
            <div class="bg-buy-subscribe">
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12 p-0">
            <div class="bg-sell-community d-flex justify-content-end">
                <div class="section sell-community d-flex flex-column justify-content-center">
                    <div class="sell-community d-flex ml-3">
                        <div class="left">
                            <img src="{{ asset('assets/site/img/mobile-mockup.png') }}" alt="" class="mobile-mockup" >
                        </div>
                        <div class="right align-self-center mr-3">
                            <h3>{{__('msg.sellheading')}}</h3> 
                            <p class="mb-3" style="width: 70%;">{{__('msg.sellpara')}}</p>
                            <button class="btn btn-green" onclick="location.href='#vendor-register-form';">{{__('msg.joinbtn')}}</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6 bg-white p-0" >
            <div class="section deliver-in-community d-flex flex-column justify-content-center">
                <div class="deliver-in-community px-5">
                    <h3 class="font-bold">{{__('msg.deliveryheading')}}</h3>
                    <p>
                    {{__('msg.deliverypara')}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-0">
            <div class="bg-deliver-in-community">
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12 p-0 bg-dark-grey">
            <div class="section get-it-on-store text-center py-3">
                <div class="get-it-on-store ">
                    <h3 class="font-black">{{__('msg.getphoneheading')}}</h3>
                    <p class="mb-3">
                    {{__('msg.getphonepara')}}
                    </p>
                    <div class="app-links">
                        <a href="#" class="mr-2">
                            <img src="{{ asset('assets/site/img/app_store.png') }}" alt="Apple Store Link" >
                        </a>
                        <a href="#">
                            <img src="{{ asset('assets/site/img/google_store.png') }}" alt="Google Play Store Link">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row" id="vendor-register-form">
        <div class="col-md-12 bg-white">
            <div class="section get-in-touch d-flex flex-column justify-content-center align-items-center">
                <div class="get-in-touch content text-center py-3">
                    <h3 class="font-bold">{{__('msg.getintouchheading')}}</h3>
                    <p class="mb-3">{{__('msg.getintouchpara')}}</p>
                </div>
                <div class="get-in-touch form w-100">
                    <form method="post" action="{{route('emailrequest')}}">
                        @csrf
                        <div class="form-col col-12 mb-3" >
                            <select name="role" id="" class="form-control p-2">
                                <option value="vendor">{{__('msg.vendor')}}</option>
                                <option value="rider">Rider</option>
                            </select>
                        </div>
                        <div class="form-col col-12 mb-3">
                            <input type="text"  name="name" class="form-control" placeholder="{{__('msg.name')}}" required>
                        </div>
                        <div class="form-col col-12 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="{{__('msg.email')}}" required>
                        </div>
                        <div class="form-col col-12 mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="{{__('msg.subject')}}" required>
                        </div>
                        <div class="form-col col-12 mb-3">
                            <textarea class="form-control" name="description" rows="3" placeholder="{{__('msg.typemessage')}}" required></textarea>
                        </div>
                        <div class="form-col col-12">
                            <button type="submit" class="btn btn-green w-100">{{__('msg.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
@endsection



    <!-- google map-->


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
				zoom: 13,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			// initialize marker
			var marker = new google.maps.Marker({
				position: map.getCenter(),
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
			if (navigator.geolocation) {
				google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {

					navigator.geolocation.getCurrentPosition(function(position) {
                        map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
					
                        // get current address
                        var google_map_pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        var google_maps_geocoder = new google.maps.Geocoder();

                        google_maps_geocoder.geocode(
                            { 'latLng': google_map_pos },
                            function( results, status ) {
                                if ( status == google.maps.GeocoderStatus.OK && results[0] ) {
                                    currentlocation = results[0].formatted_address;
                                    document.getElementById("search-txt").value = results[0].formatted_address;
                                }
                            }
                        );

                    }, function() {
						alert("Sorry, geolocation API failed to detect your location.");
					});
				});
				document.getElementById("detect-btn").disabled = false;
			}
		}
       
</script> 
<!--Map Js Start-->

<!--Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
src="https://code.jquery.com/jquery-3.5.1.js"
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous"></script>
    <!-- Swiper JS -->


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
<!-- Optional JavaScript -->

    <script src="{{ asset('assets/site/js/checkout.js') }}"></script>
    <script>
// $( document ).ready(function() {
// document.getElementById("continue").style.visibility = "hidden";
// });

function cont()
{
    document.getElementById("continue").style.visibility = "visible";   
}
function cont1()
{
    document.getElementById("continue").style.visibility = "visible";   
}
</script>

<script>
  function setLocationFocus() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });

    $("#locationInput").focus();
  }
</script>