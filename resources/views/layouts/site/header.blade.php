<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<header class="fixed-top bg-white pr-0">
<!--mobile collapse icon-->
<a id="collapse-sidebar">
<i class="fa fa-bars"></i>
</a>
<!--mobile collapse icon-->
    <div class="top-header pt-0 pb-2 py-sm-3 py-md-3 py-lg-3">
         <div class="row  justify-content-between align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-4"  style="display: flex";>
                <div class="logo-area ml-0 ml-sm-5 ml-md-5 ml-lg-5 mb-3 mb-sm-4 mb-md-4 mb-lg-0 text-center text-sm-center text-md-center text-lg-left" style="margin-left:0px;">
                    <a class="text-muted " href="{{route('site')}}">
                        <img src="{{asset('assets/site/img/Last_Mile_Only.png')}}" alt="" height="55px">
                    </a>
                    
                </div>
                <div>
                     <style>
        .vertical {
            border-left: 3px solid #019386;
            height: 42px;
            position:absolute;
            left: 61.4%;
        }
    </style>
    <div class = "vertical"></div>
                </div>
                 
              <div style="padding-top:8px; color:#019386; padding-left:30px; font-size:11px; font-family:roboto;">Lieferung auf Abruf aus deinen Lieblingsläden von Ort</div>
              

            </div>
           
            <div class="col-sm-12 col-md-12 col-lg-8 top-header-sub-part">
                <div class="d-flex  flex-wrap flex-column flex-sm-column flex-md-row flex-lg-row justify-content-end align-items-center top-header-options">
                    <!-- <div class="search-goods input-field flex-fill">
                        <img src="{{ asset('assets/site/img/icons/search.png') }}" alt="" class="search-icon">
                        <input type="text" id="products_search_box" class="form-control" placeholder="{{__('msg.searchHeader')}}">
                        <div id="productsList">
                        </div>
                    </div> -->
                    <div class="search-address-field-container d-flex flex-fill">
                    <div class="search-wrapper">
                        <input type="text" id="locationInput" class="form-control" placeholder="{{__('msg.locationInputPlaceholder')}}">
                        <button id="clear-btn" onClick="clearSearch()"><i class="fa fa-times-circle"></i></button>
                    </div>
                    <form method="post" id="form-submit" action="{{route('site.explore.shop')}}">
                        @csrf
                        <input type="hidden" name="getLatitude" id="getLatitude">
                        <input type="hidden" name="getLongitude" id="getLongitude">
                        <button class="btn"  id="search-btn" type="submit">
                            <i class="fa fa-search" style="padding:8px"></i>
                        </button>
                    </form>
                    </div>

                    <div class="top-links d-flex justify-content-center flex-wrap ml-0 ml-sm-0 ml-md-3 ml-lg-3 mr-0 mr-sm-0 mr-md-5 mr-lg-5">
                        
                        <a href="{{route('cart.index')}}" class="cart-items link-item">
                        <img src="{{ asset('assets/site/img/icons/cart.png') }}" alt="">
                        <span id="cart-count">{{isset($cartCount) && $cartCount ? $cartCount : 0}}</span> {{__('msg.items')}}
                        </a>

                        <a href="{{route('wish')}}" class="wish-list link-item ml-2">
                        <img src="{{ asset('assets/site/img/icons/favorite_unactive.png') }}" alt="">
                        {{__('msg.favorites')}}
                        </a>
                    @if(auth()->check())
                        <a href="{{route('allorders')}}" class="wish-list link-item ml-3">
                            <img src="{{ asset('assets/site/img/icons/order.png') }}" alt="">
                            {{__('msg.allorders')}}
                        </a>
                    @endif     
                    @if(!auth()->check())
                        
                        <a href="{{route('help')}}" class="link-item ml-4">{{__('msg.help')}}</a>
                        <div class="dropdown ml-4">
                            <span class="link-item ">{{__('msg.language')}} <img class="dark" src="{{ asset('assets/site/img/icons/down_arrow.png') }}" alt=""> </span>
                            <div class="dropdown-content">
                            <a class="dropdown-item" href="/local/en">{{__('msg.langEng')}}</a>
                            <a class="dropdown-item" href="/local/ge">{{__('msg.langDe')}}</a>
                            </div>
                        </div>
                        <a class="user-account link-item ml-2" onClick="loginModal()" style="color:gray; cursor: pointer;">
                        <img src="{{ asset('assets/site/img/icons/account.png') }}" alt="">
                        @if(auth()->check())
                        auth()->user()->name
                        @else
                        {{__('msg.login')}}
                        @endif
                            <!-- {{auth()->check() ? auth()->user()->name : 'Login/Signup'}} -->
                        </a>
                    @else
                    
                    <div class="dropdown ml-3" style="margin-top: -4px;">  
                       <img src="{{ asset('assets/site/img/icons/account.png') }}" alt="">
                        <a href="#" class="user-account link-item ml-1 mt-3" style="color:gray; cursor: pointer;">{{auth()->user()->name }}</a>
                        <!-- <img class="dark" src="{{ asset('assets/site/img/icons/down_arrow.png') }}" alt=""> -->
                        <div class="dropdown-content">
                            {{-- <a href="{{route('home')}}" class="dropdown-item" style="cursor: pointer;">{{__('msg.dashboard')}}</a> --}}
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button class="dropdown-item" style="cursor: pointer;">{{__('msg.logout')}}</button>                        
                            </form>
                        </div>
                    </div>
                    @endif
                    </div>
                </div> <!--flex closed-->
            </div> <!-- column closed -->
        </div> <!-- row closed -->
    </div> <!-- top header closed -->
    <!-- <div class="nav-scroller ">
        <nav class="nav d-flex flex-column flex-sm-column flex-md-row flex-lg-row justify-content-between">
            <div class="left d-flex flex-column flex-sm-column flex-md-row flex-lg-row">
                <a href="" class="list-item dark border-right ">
                    <img  src="" alt="" class="mr-3 ml-3 ml-sm-4 ml-md-5 ml-lg-5">
                    {{__('msg.allcategories')}}
                </a>
                <a href="{{route('site.explore.shops')}}" class="list-item active py-3 px-4">
                {{__('msg.allshop')}}
                </a>
                <a href="{{route('feature')}}" class="list-item active py-3 px-4">
                {{__('msg.featurebrands')}}
                </a>
                <a href="" class="list-item py-3 px-4">
                {{__('msg.bestselling')}}
                </a>
                <a href="" class="list-item py-3 px-4">
                {{__('msg.nearest')}}
                </a>
            </div>
            <div class="right d-flex flex-column flex-sm-column flex-md-row flex-lg-row mr-5">
                <a href="{{route('help')}}" class="dark list-item py-3 px-4 border-left " >
                {{__('msg.help')}}
                </a>
                <div class="dropdown mt-3 ml-3">
                <span class="list-item active py-3 px-4">{{__('msg.language')}}</span>
                <img class="dark" src="{{ asset('assets/site/img/icons/down_arrow.png') }}" alt="">
                <div class="dropdown-content">
                <a class="dropdown-item" href="/local/en">English</a>
                <a class="dropdown-item" href="/local/ge">Deutsch</a>
                </div>
                </div>
            </div>                     
        </nav>
    </div> -->
  @include('message.alert')
</header>

@include('layouts.site.login')
<script>
    function loginModal(){
        login = `{{auth()->check()}}`
        if(!login)
            $("#loginModal").modal('show');
    }

    function clearSearch() {
        document.getElementById('locationInput').value = "";
        localStorage.clear();
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

$('#products_search_box').keyup(function(){ 
    var query = $(this).val();
    console.log(query)
       if(query != '')
       {
        var html = '';
        var _token = $('input[name="_token"]').val();
        $.ajax({
         url:"{{ route('products.autocomplete.fetch') }}",
         method:"POST",
         data:{query:query, _token:_token},
            success:function(data){
                html += '<ul class="dropdown-menu" style="display:block; width: -webkit-fill-available;">';
                route = `{{route('site')}}`
                $.each(data , function(index, val) {
                    url = route+'/explore-shops/'+val.vendor_id;
                    html += `<a href="${url}" >
                    <div class="row" onmouseover="overStyle(this)" onmouseout="outStyle(this)" style="font-family: Roboto">
                        <div class="col-md-2">
                            <div >
                                <img src="${val.image}" height="50px" width="50px" alt="image">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <p style="color:black;font-size:16px"><strong>${val.name}</strong>
                            <br>
                             €${ Number(val.price).toLocaleString("es-ES", {minimumFractionDigits: 2})}
                            </p>
                        </div>
                    </div>
                   </a>`;              
                });
                console.log(html)
                html += '</ul>';
                console.log(html)
                $('#productsList').fadeIn();  
                $('#productsList').html(html);
            }
        });
       }
   });

   $(document).on('click', 'productsList li', function(){  
       $('#products_search_box').val($(this).text());  
       $('#productsList').fadeOut();  
   });  

});
</script>
<script>
    /** Change the style **/
    function overStyle(object){
        object.style.background = '#f5f5f0';
        // Change some other properties ...
    }

    /** Restores the style **/
    function outStyle(object){
        object.style.background = 'white';
        // Restore the rest ...
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true&amp;key=AIzaSyBR7rrSUi4o118-vGLhDI_f6buJOnZr900&amp;callback=initialize&amp;libraries=places" defer></script>

<script type="text/javascript">
    $(document).ready(function() {
    document.getElementById('locationInput').value = localStorage.getItem('address');
    document.getElementById('getLatitude').value = localStorage.getItem('lat')
    document.getElementById('getLongitude').value = localStorage.getItem('lon')
    })

    function initialize() {
        var input = document.getElementById('locationInput');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            document.getElementById('locationInput').value = place.formatted_address;
            document.getElementById('getLatitude').value = place.geometry.location.lat();
            document.getElementById('getLongitude').value = place.geometry.location.lng(); 

            localStorage.setItem('address', place.formatted_address);
            localStorage.setItem('lat', place.geometry.location.lat());
            localStorage.setItem('lon', place.geometry.location.lng());
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize).style.color = "blue"; 
</script>

