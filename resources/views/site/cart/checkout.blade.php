@extends('layouts.site.app', [
    
    ])


@section('content')
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
    <div class="container" style="height:100vh">
        <div class="row">
                <div class="col-12">
                <div class="checkout-container mt-4 d-flex justify-content-between">
                    <div class="left d-flex">
                        <div class="multi-layer bg-dark">
                            <ul id="progressbar" class="text-center">
                                <li class="step0  active"></li>
                                <li class="step0 "></li>
                                <li class="step0  "></li>
                                <li class="step0  "></li>
                            </ul>
                        </div>
                        <div class="multi-layer-form ">
                            <div class="card-1 first-screen show">
                                <h5>1/4 {{__('msg.easytpes')}}</h5>
                                <div class="checkout-method getpaymenttype">
                                    <label for="title" class="my-3 mb-2">{{__('msg.checkoutmethod')}}</label>
                                    @foreach($recordDelivery as $delivery)
                                    <div class="radio  mb-3">
                                        <label class="m-0"><input type="radio" onchange="validateDelivery();" data-id="{{$delivery->id}}" value="{{$delivery->title}}" class="mr-3 checkout-radio payment_method" name="checkout-radio">{{$delivery->title}}</label>
                                        <span class="float-right" id="delivery-{{$delivery->id}}">€{{$delivery->price}}</span>
                                    </div>
                                    @endforeach
                                    <p style="color:red;display:none" id="p1">Empty Field</p>
                                    <!-- <div class="radio">
                                        <label class="m-0"><input type="radio" class="mr-3 checkout-radio payment_method" name="checkout-radio" value="e">Express</label>
                                        <span class="float-right ">$50.00</span>
                                    </div> -->
                                </div>
                                <div class="preffered-delivery-time mt-4" id="preffered-delivery-time">
                                    <label for="title" class="my-3">Preffered Delivery Time</label>
                                    <div class="radio  mb-3">  
                                        <label class="m-0"><input type="radio" class="mr-3 pref-radio" name="pref-radio">As soon as Possible</label>
                                    </div>
                                    <div class="radio">
                                        <label class="m-0"><input type="radio" class="mr-3 pref-radio" name="pref-radio">Custom Time</label>
                                    </div>    
                                </div>
                                <div class="row mt-4">
                                    <button class="btn btn-black next-button" disabled onClick="paymenttype()" id="nextmethod">{{__('msg.next')}}</button>
                                </div>
                            </div>
                            <div class="card-1 ml-2">
                                <h5>2/4 {{__('msg.easytpes')}}</h5>
                                <!--for existing  user (available delivery addresses)-->
                                <div class="existing-address" id="existing-address-container">
                                    <div class="checkout-method getaddressspan mb-4">
                                        <label for="title" class="my-2">{{__('msg.deliveryaddress')}}</label>
                                        @if(Auth::check())
                                        @foreach($recordlocation as $location)
                                            <div class="radio mb-3">
                                                <label class="m-0" for="address" >
                                                    <input id="address-{{$location->id}}" onchange="validateDeliveryAddress();" data-id="{{$location->id}}" type="radio" class="mr-3 delivery-radio" name="delivery-radio"  value="{{$location->title}}">{{$location->title}}
                                                </label>
                                                <span class="float-right" id="location-address-{{$location->id}}">{{$location->address}}</span>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <!-- <div class="radio mb-3 row justify-content-end"> -->
                                    <!-- <button  type="button"  data-target="#myMapModal1" data-toggle="modal"  > -->
                                        <!-- <span class="add-new address" type="button"  id="add-new-delivery-address"  style="margin-right:154px; cursor:pointer;">
                                            Add New Address
                                        </span> -->
                                    <!-- </button> -->
                                    <!-- </div> -->
                                    <div class="radio text-center">
                                        <span class="add-new address" type="button"  id="add-new-delivery-address"  style="cursor:pointer;">
                                        <i class="fa fa-plus mr-2"></i>{{__('msg.addnewaddress')}}
                                        </span>
                                    </div>
                                </div>
                                 <!--for guest/new user (add new delivery address)-->
                                    <div class="new-data address-form"  id="new-address-container">
                                        <div class="checkout-method">
                                            <label for="title" class="my-2">{{__('msg.deliveryaddress')}}</label>
                                            
                                                <div class="bg-white br-5 shadow-2 p-3">
                                                    <div class="form-row mb-3">
                                                    <div class="form-col col-md-6 mb-3">
                                                        <input type="text" value="{{ Auth::check() ? $record->detail->fname : ''}}" id="addNewFname" class="form-control  custom" {{Auth::check() ? 'readonly'  : ''}}  placeholder="First Name"> 
                                                    </div>
                                                    <div class="form-col col-md-6">
                                                        <input type="text" value="{{ Auth::check() ? $record->detail->lname : '' }}" id="addNewLname" class="form-control custom" {{Auth::check() ? 'readonly'  : ''}} placeholder="Last Name">
                                                    </div>
                                                    </div>
                                                    <div class="form-col mb-3">
                                                        <input type="email" value="{{Auth::check() ? $record->email : ''}}" id="addNewEmail" class="form-control  custom" {{Auth::check() ? 'readonly'  : ''}} placeholder="Email">
                                                    </div>
                                                    <div class="form-col mb-3">
                                                        <input type="text" value="{{Auth::check() ? $record->detail->phone : '' }}" id="addNewPhone" class="form-control  custom" {{Auth::check() ? 'readonly'  : ''}} placeholder="Phone#">
                                                    </div>
                                                    <!-- <div class="form-row mb-3">
                                                        <input type="text" class="form-control custom" id="addNewAddress" name="address" value="" placeholder="Address">
                                                    </div>
                                                    <div class="form-col mb-3">
                                                        <input type="text" class="form-control custom" id="addNewCompany" name="name" value="" placeholder="Address Title">
                                                    </div> -->
                                                    <div class="form-col mb-3">
                                                        <button type="button" class="btn btn-black w-100" data-toggle="modal"  data-target="#myMapModal1">{{__('msg.addnewlocations')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!--for guest/new user (add new delivery address)-->
                                        <!-- Map modal-->
                                        <!-- Modal -->
                                        <div class="modal "  id="myMapModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content  login-signup-modal login">
                                                <div class="modal-body p-0">
                                                    <div class="row ">
                                                        <div class="col-md-12 col-lg-4 p-0 m-0 ">
                                                            <div class="img-container text-center">
                                                                <img src="{{asset('assets/site/img/login-signup-bg.png')}}" alt="" class="bg img-fluid">
                                                                <img src="{{asset('assets/site/img/logo.png')}}" alt="" class="logo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-8">
                                                        
                                                            <!-- <div id="map-search">
                                                                            <input id="search-txt" type="text" value="Disneyland, 1313 S Harbor Blvd, Anaheim, CA 92802, USA" maxlength="100">
                                                                            
                                                                        </div> -->
                                                        <div id="map-search" >
                                                            <div class="map">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12 mt-3 mb-2">
                                                                        <label for="title">{{__('msg.search')}}</label>
                                                                        <input id="search-txt" class="controls form-control" type="text" placeholder="Enter a location">
                                                                        <!-- <input type="text" class="form-control" name="title" id="searchTextField" onclick="mapInit()" > -->
                                                                    </div>
                                                                </div>    
                                                                    
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6 mb-3">
                                                                        <label for="title">{{__('msg.addressname')}}</label>
                                                                        <input type="text" class="form-control" id="addNewCompany" name="name" >
                                                                    </div>
                                                                    <div class="form-group col-md-6 mb-3">
                                                                        <label for="title">{{__('msg.location')}}</label>
                                                                        <input id="location-address" type="text" class="form-control"  name="address" >
                                                                    </div>
                                                                    <input type="hidden" id="lat" name="latitude">
                                                                    <input type="hidden" id="long" name="longitude">
                                                                </div>
                                                                <div class="form-row">    
                                                                        <div class="form-group col-md-4 mb-3">
                                                                            <input id="search-btn" class="btn btn-black w-100 font-14 font-medium" type="button" value="{{__('msg.locateaddress')}}">
                                                                        </div>
                                                                        <div class="form-group col-md-4 mb-3">
                                                                            <input id="detect-btn" class="btn btn-black w-100 font-14 font-medium" type="button" value="{{__('msg.detectlocation')}}" disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mb-3">
                                                                            <button type="submit" class="btn btn-black w-100 font-14 font-medium" onClick="getlatlong()"  data-dismiss="modal">{{__('msg.save')}}</button>
                                                                        </div>
                                                                </div>
                                                                <div id="map-canvas"  style="height: 35vh;  position: relative;"></div>
                                                                <div id="map-output"></div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Map modal closed-->
                                <!--for existing  user (available delivery addresses)-->
                                <div class="row mt-4">
                                    <button class="btn btn-transparent btn-prev mb-2">{{__('msg.back')}}</button>
                                    <button class="btn btn-black next-button" disabled id="nextmethod_delivery" onClick="address1()" >{{__('msg.next')}}</button>
                                </div>
                            </div>
                            <div class="card-1 ml-2">
                                <h5>3/4 {{__('msg.easytpes')}}</h5>
                                <!--for existing user (available payment methods)-->
                                    <div class="existing-payment" id="existing-payment-container">
                                        <div class="checkout-method getcarddetail mb-4">
                                                <label for="title" class="my-2">{{__('msg.paymentmethod')}}</label>
                                            @if(Auth::check())    
                                            @foreach($recordcard as $records)
                                                <div class="radio  mb-3">
                                                    <label class="m-0">
                                                        <input id="card-{{$records->id}}" type="radio" data-id="{{$records->id}}" data-year="{{$records->exp_year}}" data-month="{{$records->exp_month}}" data-cvc="{{$records->cvc}}" class="mr-3 payment-radio" name="payment-radio"  value="{{$records->card_name}}">{{$records->card_name}}
                                                    </label>
                                                    <span class="float-right" id="card-number-{{$records->id}}">{{$records->number}}</span>                                        
                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="radio mb-3 row text-center">
                                            <span class="add-new d-c-card" id="add-new-card" style="cursor:poiner;">
                                            <i class="fa fa-plus mr-2"></i>{{__('msg.addnewcard')}}
                                            </span>
                                        </div>
                                    </div>
                                <!--for existing  user (available payment methods)-->
                                <!--for new/guest  user (add new payment method)-->
                                    <div class="new-data payment-form"  id="new-payment-container">
                                            <div class="checkout-method">
                                               <label for="title" class="my-3 mb-2">{{__('msg.alltransactionsecure')}}</label>
                                                <div class="d-flex flex-wrap">
                                                    <div class="radio  w-100 mr-2 mb-2">
                                                        <label class="m-0"><input type="radio" checked id="creadit-card" class="mr-3 checkout-radio cardType" name="cardType"  value="Credit Card">Credit Card{{__('msg.creditcard')}}</label>
                                                        <i class="fa fa-credit-card float-right"></i>
                                                    </div>
                                                    <!--<div class="radio w-100 mr-2">-->
                                                        <!--<label class="m-0"><input type="radio" id="paypal" class="mr-3 checkout-radio cardType" name="cardType"  value="Paypal">Paypal</label>-->
                                                        <!--<i class="fa fa-cc-paypal float-right" aria-hidden="true"></i>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                        <div class="checkout-method mt-3" id="d-c-card">
                                            <label for="title" class="my-3 mb-2">{{__('msg.CardDetails')}}</label>
                                            <div class="bg-white shadow-2 br-5 p-3">
                                                    <div class="form-col mb-3">
                                                        <input type="text" oninput="validateCardFields();" class="form-control custom c" id="cardNo" value="" placeholder="{{__('msg.cardnoplaceholder')}}">
                                                    </div>
                                                    <div class="form-col mb-3">
                                                        <input type="text" oninput="validateCardFields();" class="form-control custom c" id="cardHolderName" value="" placeholder="{{__('msg.cardholdernameplaceholder')}}">
                                                    </div>
                                                    <div class="form-row mb-3">
                                                        <div class="form-col col-md-6">
                                                            <input type="text" oninput="validateCardFields();" class="form-control custom c" id="expiry" value="" placeholder="{{__('msg.expiryyearplaceholder')}}">
                                                        </div>
                                                        <div class="form-col col-md-6">
                                                            <input type="text" oninput="validateCardFields();" class="form-control custom c" id="cvcget" value="" placeholder="CVC">
                                                        </div>
                                                     </div>
                                                <div class="form-col mb-3">
                                                <input type="text" oninput="validateCardFields();" class="form-control custom c" id="expiry_month" value="" placeholder="{{__('msg.expirymonthplaceholder')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!--for new/guest  user (add new payment method)-->
                                <div class="row mt-4">
                                    <button class="btn btn-transparent btn-prev mb-2">{{__('msg.back')}}</button>
                                    <button class="btn btn-black next-button " disabled id="nextmethod_payment" onClick="paymentCard()">{{__('msg.next')}}</button>
                                </div>
                            </div>
                            <div class="card-1 ml-2">
                                <h5>4/4 {{__('msg.easytpes')}}</h5>
                                <form method="post" action="{{route('checkout.payment')}}">
                                    @csrf 
                                    <div class="top d-flex flex-column">
                                        <div class="details  mb-3 mt-3">
                                            <label for="title-d" class="m-0">{{__('msg.checkoutmethod')}}</label>
                                            <div class="des-pri d-flex justify-content-between">
                                                <span class="w-50 text-dark-grey payment-type" id="payment-type"></span><input type="hidden" id="checkout-method" name="checkout-method"> 
                                                <span class="w-50 text-right payment-type-span text-dark-grey" id="payment-type-span"></span><input type="hidden" id="checkout-method-type" name="get-checkout-method">
                                            </div>
                                        </div>
                                        <div class="details mb-3">
                                            <label for="title-d" class="m-0">{{__('msg.deliveryaddress')}}</label>
                                            <div class="des-pri d-flex justify-content-between">
                                                <span class="w-100 text-dark-grey address_name" id="address_name"></span>
                                                <input type="hidden" id="get_address_name" name="address">
                                                <span class="w-100 text-right text-dark-grey address-description-span" id="address_description_span"></span>
                                                <input type="hidden" id="get_address_description" name="address_description">
                                                <input type="hidden" id="selected-address-id"  name="address_id" value="">
                                                <input type="hidden" id="select-lat" name="latitude">
                                                <input type="hidden" id="select-long" name="longitude">
                                            </div>
                                        </div>
                                        <div class="details mb-3">
                                            <label for="title-d" class="m-0">{{__('msg.deliveryaddress')}}</label>
                                            <div class="des-pri d-flex justify-content-between">
                                                <span class="w-50 text-dark-grey">{{__('msg.name')}}</span>
                                                <span class="w-100 text-right guestname text-dark-grey"  id="guestname">{{Auth::check() ? $record->name :''}}</span>
                                            </div>
                                            <div class="des-pri d-flex justify-content-between">
                                                <span class="w-50 text-dark-grey">{{__('msg.email')}}</span>
                                                <span class="w-100 text-right guestemail text-dark-grey" id="guestemail">{{Auth::check() ? $record->email : ''}}</span>
                                                @if(!Auth::check())
                                                <input type="hidden" value="" id="addlname" name="lname">
                                                <input type="hidden" value="" id="addphone" name="phone">
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="details mb-3">
                                            <label for="title-d" class="m-0">{{__('msg.paymentmethod')}}</label>
                                            <div class="des-pri d-flex justify-content-between">
                                                <span class="w-50 text-dark-grey payment_card_type" id="payment_card_type"></span><input type="hidden" id="get_payment_card_type" name="card_name">
                                                <span class="w-100 text-right  text-dark-grey card-number-span" id="card-number-span"></span><input type="hidden" id="get_payment_card_number" name="card_number">
                                                <input type="hidden" value="" id="exp_month" name="exp_month" >
                                                <input type="hidden" value="" id="exp_year" name="exp_year" >
                                                <input type="hidden" value="" id="cvc" name="cvc">
                                                <input type="hidden" value="" id="selected-payment-method-id" name="payment_method_id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <button class="btn btn-transparent btn-prev mb-2" type="button">{{__('msg.back')}}</button>
                                        <button class="btn btn-black btn-confirm-checkout" type="submit" onClick="getallvalue()">{{__('msg.confirmcheckout')}}</button>
                                        <!-- <a class="btn btn-black btn-confirm-checkout"  href="{{route('checkout.payment')}}" >Confirm Checkout</a> -->
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    <div class="right">
                        <div class="checkout-details d-flex flex-column justify-content-between shadow-1 p-3" style="width:100px">
                            <div class="top d-flex flex-column">
                                <div class="details 1 mb-2" id="checkout-details">
                                    <label for="title-d" class="m-0">{{__('msg.checkoutmethod')}}</label>
                                    <div class="des-pri d-flex justify-content-between">
                                        <span class="w-50 font-13 font-medium text-grey  payment-type" id="payment-type">--</span>
                                        <span class="w-50 font-13 font-medium text-grey  text-right payment-type-span" >--</span>
                                    </div>
                                </div>
                                    <div class="details 2 mb-2">
                                        <label for="title-d" class="m-0">{{__('msg.deliveryaddress')}}</label>
                                        <div class="des-pri d-flex justify-content-between">
                                            <span class="w-50 address_name font-13 font-medium text-grey " id="address_name">--</span>
                                            <span class="w-50 text-right address-description-span font-13 font-medium text-grey " id="address-description">--</span>
                                        </div>
                                    </div>
                                    <div class="details 3 mb-2" id="delivery-a-details">
                                        <label for="title-d" class="m-0">{{__('msg.deliverydetails')}}</label>
                                        <div class="des-pri d-flex justify-content-between">
                                            <span class="w-50 font-13 font-medium text-grey ">{{__('msg.name')}}</span>
                                            <span class="w-100 font-13 font-medium text-grey  guestname text-right" id="guestname">{{ Auth::check() ? $record->name : ''}}</span>
                                        </div>
                                        <div class="des-pri d-flex justify-content-between">
                                            <span class="w-50 font-13 font-medium text-grey ">{{__('msg.email')}}</span>
                                            <span class="w-100 guestemail text-right font-13 font-medium text-grey " id="guestemail">{{ Auth::check() ? $record->email : ''}}</span>
                                        </div>
                                    </div>
                                    <div class="details 4 mb-2" id="payment-details">
                                        <label for="title-d" class="m-0">{{__('msg.paymentmethod')}}</label>
                                        <div class="des-pri d-flex justify-content-between">
                                            <span class="w-50 font-13 font-medium text-grey payment_card_type" id="payment_card_type">--</span>
                                            <span class="w-100 font-13 font-medium text-grey  card-number-span text-right">--</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="bottom d-flex flex-column">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="cart-qty">{{$cartCount}} {{__('msg.itemsincart')}}</span>
                                    <a class="cart-qty-link" >{{__('msg.viewitem')}}</a>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="qty-total">{{__('msg.total')}}</span>
                                    <a class="price-total">€{{number_format(str_replace( ',', '', $cartTotal ), 2, ',', '.')}}</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>   
    <!-- order successful modal-->
    <div class="modal"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content order-success-modal">
            <div class="modal-body p-0  p-2">
                <div class="row ">
                    <div class="col-md-12 ">
                        <div class="d-flex flex-column align-items-center p-3">
                            <div class="">
                                <h3 class="text-center">Order Successfull</h3>
                                <p class="text-center">Your Order ID: #232112112 </p>
                            </div>
                            <div class="">
                                <img src="{{ asset('assets/site/img/order_success.png') }}" alt="">
                            </div>
                            <div class="mt-4 mb-3">
                                <button class="btn btn-dark-grey font-14 mr-2">Order Details</button>
                                <button class="btn btn-green font-14 ">Shop More</button>
                            </div>
                            <div class="">
                                <button class="btn text-black font-14 btn-transparent" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
@endsection

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->

    <script src="{{ asset('assets/site/js/checkout.js') }}"></script>
    <script>
    function validateCardFields()
    {
        var allFieldsHaveValues = $('#cardNo:text').val() && $('#cardHolderName').val() && $('#expiry_month').val() && $('#cvcget').val() && $('#expiry').val();
        if (allFieldsHaveValues) {
            $("#nextmethod_payment").prop('disabled', false);
        }
    }
    function validateDelivery()
    {
        $("#nextmethod").prop('disabled', false);
    }
    function validateDeliveryAddress()
    {
        $("#nextmethod_delivery").prop('disabled', false);
    }
    //Payment Type
    function paymenttype()
    {
        var data =$("input[name=checkout-radio]");
       if(data.filter(":checked").val())
        {
       
        var value = data.filter(":checked").val()
        var value6 = data.filter(":checked");
        id = value6.attr('data-id');
        $('.payment-type').html(value);
        paymenttext = $('#delivery-'+id).text(); 
        $('.payment-type-span').html(paymenttext);
      
        }
        else
        {
          
        $('#p1').css({
            "display": "block"
        });
        }
       
    }
    // Address
    function address1()
    {
        var data1 = $("input[name=delivery-radio]");
        if(data1.filter(":checked").val())
        {
            var value1 = data1.filter(":checked").val();
            $('.address_name').html(value1);       
            var value5 = data1.filter(":checked");
            id = value5.attr('data-id');
            $('#selected-address-id').val(id);
            // id = val.split("-")
            address = $('#location-address-'+id).text();
            $('.address-description-span').html(address);
        }
        else
        {
            
            console.log('else');
            addnewfname = $('#addNewFname:text').val();
            console.log(addnewfname,"AddnewFname");
            

            addnewlasname  =  $('#addNewLname:text').val();
            console.log(addnewlasname,"addnewLastname");
            $('#addNewEmail:text').val();
            // addnewaddress = $('#addNewAddress:text').val();
            // addnewcompany =  $('#addNewCompany:text').val();
            addnewemail = $('#addNewEmail').val();
            console.log(addnewemail,"addEmail");
            // console.log(addnewemail);
            addnewphone = $('#addNewPhone:text').val();
            console.log(addnewphone,"phone");
            $('.guestname').html(addnewfname);
            console.log($('.guestname').html(addnewfname),"fname")
            $('.guestemail').html(addnewemail);
            console.log($('.guestemail').html(addnewemail),"guestemail")
            // $('.address_name').html(addnewcompany);
            // $('.address-description-span').html(addnewaddress);
            $('#selected-address-id').val();
            console.log($('#selected-address-id').val(),"address_id")
            $('#addlname').val(addnewlasname);
            console.log($('#addlname').val(addnewlasname),"Lastname")
            $('#addphone').val(addnewphone);
            console.log($('#addphone').val(addnewphone), "phone")

        }  
    }
    //Payment Method
    function paymentCard()
    {
        var data2 =$("input[name=payment-radio]");
        if(data2.filter(":checked").val())
        {
            
            var value2 = data2.filter(":checked").val();
            var carddescription = $('.getcarddetail span').text()
            $('.payment_card_type').html(value2);
            var value6 = data2.filter(":checked");
            cardexpiry = $('#exp_year').val(value6.attr('data-year'));
            cardmonth = $('#exp_month').val(value6.attr('data-month'));
            cvc = $('#cvc').val(value6.attr('data-cvc'));
            id = value6.attr('data-id');
            cardnumber = $('#card-number-'+id).text();
            $('.card-number-span').html(cardnumber);
            var value5 = data2.filter(":checked");
            id = value5.attr('data-id');
            $('#selected-payment-method-id').val(id);
        }
        else
        {
            var data3 = $("input[name=cardType]");
            var value3 = data3.filter(":checked").val();
            creditcard = $('#creadit-card').val();
            paypal = $('#paypal').val();
            cardnumber = $('#cardNo:text').val();
            cardHoldername = $('#cardHolderName').val();
            expiry = $('#expiry').val();
            expiryMonth = $('#expiry_month').val();
            // console.log(expiryMonth);
            cvc = $('#cvcget').val();
            $('.payment_card_type').html(value3);
            $('.card-number-span').html(cardnumber);
            $('#cvc').val(cvc);
            $('#exp_year').val(expiry);
            $('#exp_month').val(expiryMonth);
        }
    } 
    //Get All Value 
    function getallvalue()
    {
        $("#checkout-method").val($("#payment-type").text());
        $('#checkout-method-type').val($('#payment-type-span').text());
        $('#get_address_name').val($('#address_name').text());
        $('#get_address_description').val($('#address_description_span').text());
        $('#get_payment_card_type').val($('#payment_card_type').text());
        $('#get_payment_card_number').val($('#card-number-span').text());

      
    }
    </script>
    <script>
        
        $(document).ready(function(){
            $("#new-address-container").hide();
            $("#add-new-delivery-address").on('click',function(){
        $("#existing-address-container").hide();
        $("#new-address-container").show();
    });
    $("#add-new-card").on('click',function(){
        $("#existing-payment-container").hide();
        $("#new-payment-container").show();
    });
        });
    </script>
<!--Map Js Start-->
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
                        document.getElementById("location-address").value = result.formatted_address;
						if (result.geometry.viewport) {
							map.fitBounds(result.geometry.viewport);
						} else {
							map.setCenter(result.geometry.location);
						}
					} else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
						alert("Sorry, geocoder API failed to locate the address.");
					} else {
						alert("Sorry, geocoder API failed with an error. Check that Search field isn't empty. ");
						console.error('results', results)
						console.error('status', status)
					}
				});
			});
			google.maps.event.addDomListener(document.getElementById("search-txt"), "keydown", function(domEvent) {
				if (domEvent.which === 13 || domEvent.keyCode === 13) {
				var b=google.maps.event.trigger(document.getElementById("search-btn"), "click");
                console.log(b)
				}
			});
			// initialize geolocation
			if (navigator.geolocation) {
				google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {
					navigator.geolocation.getCurrentPosition(function(position) {
				    map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                    
                    //get current address
                    var google_map_pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var google_maps_geocoder = new google.maps.Geocoder();

                    google_maps_geocoder.geocode(
                            { 'latLng': google_map_pos },
                            function( results, status ) {
                                if ( status == google.maps.GeocoderStatus.OK && results[0] ) {
                                    currentlocation = results[0].formatted_address;
                                    document.getElementById("location-address").value = results[0].formatted_address;
                                }
                            }
                        );


					}
                    , function() {
                        alert("Sorry, geolocation API failed to detect your location.");
					});
                    
				});
				document.getElementById("detect-btn").disabled = false;
			}
		}
</script>
<!--Map Js Start-->
<script>
function getlatlong()
{ 
    addnewaddress = $('#location-address:text').val();
    console.log(addnewaddress)
    addnewcompany =  $('#addNewCompany:text').val();
    console.log(addnewcompany)
    $('.address_name').html(addnewcompany);
    $('.address-description-span').html(addnewaddress);
    address = $('#lat').val();
    
    addresslocation = $('#long').val();
    lat = $('#lat').val();
    long = $('#long').val();
    $('#select-lat').val(lat);
    $('#select-long').val(long);

    validateDeliveryAddress();
}
</script>