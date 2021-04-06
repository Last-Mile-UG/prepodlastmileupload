@extends('layouts.site.app', [
    
    ])
@section('content')
<div class="container-fuild">
    <div class="row">
        <div class="swiper-container promo mb-4">
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
    </div>
</div>
<div class="container">
        <div class="row">
             <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-3 mt-2"> 
                  <!-- side bar-->
                  @include('layouts/navbars/userSidebar')
                 <!-- side bar-->
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3 mt-2">
                <div class="profile-area shadow-1 p-3">
                    <h3 class="mb-3">{{__('msg.myaddress')}}</h3>
                    <div class="profile-form">
                        @foreach($user as $us)
                        <div class="form-row"> 
                            <div class="form-group col-md-4">
                                <label for="title">{{__('msg.addressname')}}</label>
                                <input type="text" class="form-control" value="{{$us->title}}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="title">{{__('msg.location')}}</label>
                                <input type="text" class="form-control" value="{{$us->address}}" readonly >
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="form-group custom-onoff col-md-4">
                            <label for="title">Make Default</label>
                            <label class="switch d-block">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div> -->
                        <div class="form-group my-2">
                        <button type="button" class="btn btn-black font-14" data-toggle="modal" data-target="#myMapModal" style="margin-top:30px">{{__('msg.addlocationbtn')}}</button>
                        </div>
                    </div>
                </div>
            <div class="pt-2">{{$user->links()}}</div>
            </div>
        </div>
    </div>

<style>
#map .centerMarker{
  position:absolute;
  /*url of the marker*/
  background:url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
  /*center the marker*/
  top:50%;left:50%;
  z-index:1;
  /*fix offset when needed*/
  margin-left:-10px;
  margin-top:-34px;
  /*size of the image*/
  height:34px;
  width:20px;
  cursor:pointer;
}
</style>


    <!-- Map modal-->
<!-- Modal -->
<div class="modal "  id="myMapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content  login-signup-modal login">
        <div class="modal-body p-0">
            <div class="row ">
                <div class="col-md-12 col-lg-4 p-0 m-0  ">
                    <div class="img-container text-center">
                        <img src="{{asset('assets/site/img/login-signup-bg.png')}}" alt="" class="bg img-fluid">
                        <img src="{{asset('assets/site/img/logo.png')}}" alt="" class="logo">
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 ">
                
                    <!-- <div id="map-search">
                            		<input id="search-txt" type="text" value="Disneyland, 1313 S Harbor Blvd, Anaheim, CA 92802, USA" maxlength="100">
                            		
                            	</div> -->
                <div id="map-search" >
                    <div class="map">
                        <div class="form-row">
                            <div class="form-group col-md-12 mt-3 mb-2">
                                <label for="title">search</label>
                                <input id="search-txt" class="controls form-control" type="text" placeholder="Enter a location">
                                <!-- <input type="text" class="form-control" name="title" id="searchTextField" onclick="mapInit()" > -->
                            </div>
                        </div>
                            <form action="{{route('addressstore')}}" method="post">
                            @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="title">Address Name</label>
                                        <input type="text" class="form-control" name="title" >
                                    </div>
                                    
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="title">Location</label>
                                        <input type="text" class="form-control" name="address" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 mb-3">
                                        <input id="search-btn" class="btn btn-black w-100 font-14 font-medium" type="button" value="Locate Address">
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <input id="detect-btn" class="btn btn-black  w-100 font-14 font-medium" type="button" value="Detect Location" disabled>
                                    </div>
                                    <div class="form-group  col-md-4 mb-3">   
                                        <button type="submit" class="btn btn-black w-100  font-14 font-medium">Save</button>
                                    </div>
                                </div>
                                
                                <div id="map-canvas"  style="height: 35vh;  position: relative; "></div>
                                <div id="map-output"></div>
                                <input type="hidden" id="lat" name="latitude">
                                <input type="hidden" id="long" name="longitude">
                            </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- Map modal closed-->
@endsection

<!-- <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF8vXfHR8LRRMvD9N4zPIdawHbI6tJQjM&callback=Mapinit&libraries=&v=weekly&"
    defer
></script> -->
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true&amp;key=AIzaSyCF8vXfHR8LRRMvD9N4zPIdawHbI6tJQjM&amp;callback=loadmap" defer></script>

<script type="text/javascript">
		/*
		 * Google Maps: Latitude-Longitude Finder Tool
		 * https://salman-w.blogspot.com/2009/03/latitude-longitude-finder-tool.html
		 */
		function loadmap() {
			// initialize map
			var map = new google.maps.Map(document.getElementById("map-canvas"), {
				center: new google.maps.LatLng(33.808678, -117.918921),
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
					}, function() {
						alert("Sorry, geolocation API failed to detect your location.");
					});
				});
				document.getElementById("detect-btn").disabled = false;
			}
		}
</script>
