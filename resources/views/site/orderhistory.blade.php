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
            <!--order search and filter -->   
               <div class="order-search-filter d-flex flex-wrap justify-content-between mb-3">
                   <div class="order-search">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="{{__('msg.orderhistoryplaceholder')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-green" type="button">{{__('msg.searchbtn')}}</button>
                    </div>
                    </div>
                   </div>
                <div class="order-filter">
                    <button class="btn">{{__('msg.from')}}</button>   
                    <button class="btn ml-2">{{__('msg.to')}}</button>   
                </div>
               </div>
                <!--order search adn filter closed-->  

                <!--tab bar-->                      
                <div class="tab-bar d-flex justify-content-between shadow-1 mb-3">
                    <ul class="nav nav-pills custom-tab d-flex flex-column flex-sm-row flex-md-row flex-lg-row" id="pills-tab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active py-3 text-left py-3 ml-0 ml-sm-0 ml-md-3 ml-lg-3 " id="pills-all" data-toggle="pill" href="#pills-show-all" role="tab" aria-controls="pills-show-all" aria-selected="true"> {{__('msg.All')}}</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link py-3 text-left" id="pills-product" data-toggle="pill" href="#pills-installement" role="tab" aria-controls="pills-installment" aria-selected="false">Installment</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link py-3 text-left" id="#pills-only" data-toggle="pill" href="#pills-pay-purchase" role="tab" aria-controls="pay-purchase" data-toggle="pill" aria-selected="false">Pay Purchase</a>
                        </li> -->
                    </ul>
                    <ul class="nav d-flex">
                        <li class="nav-item d-flex">
                            <a class="nav-link active py-3  border-left border-right">
                                <img src="{{asset('assets/site/img/icons/view.png')}}" alt="">
                            </a>
                            <a class="nav-link active py-3 ">
                                <img src="{{asset('assets/site/img/icons/menu.png')}}" alt="">
                        </a>
                        </li>
                    </ul>
                </div>
                <!-- tab bar closed-->
                <!--tab bar content-->  
                <div class="tab-content my-4" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-show-all" role="tabpanel" aria-labelledby="pills-show-all">

                        <div class="row">
                        @foreach($records as $record)
                        <div class="col-md-12 shadow-1 br-5 mb-3">
                                <div class="order-history d-flex flex-wrap justify-content-between flex-wrap py-3">
                                    <div class="left d-flex flex-wrap">
                                        <div class="img-container">
                                        <img src="{{$record->details->first()->users->detail->image}}" alt="">
                                        </div>
                                        <div class="d-flex flex-wrap flex-column justify-content-between ml-0 ml-sm-2 ml-md-2 ml-lg-2">
                                            <div class="h">
                                                <h4 class="mb-0">  {{$record->details->first()->users->name}}</h4>
                                                <!-- <span class="text-green font-14">Installment</span> -->
                                            </div>
                                            <div class="b d-flex flex-wrap">
                                                <span class="text-black font-14 font-regular">
                                                <img src="assets/img/icons/order.png" alt="">
                                                {{__('msg.orderid')}}#{{$record->order_id}}</span>
                                                <!-- <a class="ml-0 ml-sm-4 ml-md-4 ml-lg-4 text-black font-14 font-medium" href="#">
                                                <img src="assets/img/icons/order.png" alt="">
                                                View Invoice</a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="d-flex flex-column h-100 justify-content-between">
                                            <span class="font-16">{{$record->created_at}}</span>
                                            <div class="align-self-end">
                                                <span class="text-green font-bold font-28">{{$record->price}},00</span>
                                                <span class="text-black font-bold font-24">€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach    
                      
                        {{$records->links()}}   
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="pills-installement" role="tabpanel" aria-labelledby="pills-installement">
                    2
                    </div>
                    <div class="tab-pane fade" id="pills-pay-purchase" role="tabpanel" aria-labelledby="pills-pay-purchase">
                        3
                    </div> -->
                </div>
                 <!--tab bar content closed-->  
            </div>
        </div>
    </div>
@endsection
@stack('js')
   
      