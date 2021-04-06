@extends('layouts.site.app', [
    
    ])
    
    @section('content')
    
    
   

<div class="container">
<div class="row">
            <div class="col-md-12">
                <div class="swiper-container promo my-3 ">
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
    <div class="row">

         <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-3 mt-2"> 
              <!-- side bar-->
              @include('layouts/navbars/userSidebar')
             <!-- side bar-->
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3 mt-2">
            <h3 class="font-medium mb-4">My Returns</h3>
           <div class="row">
               <div class="col-md-12 shadow-1 br-5 mb-3">
                <div class="my-returns py-4">
                    <div class="top d-flex flex-wrap  justify-content-between">
                        <div class="left d-flex">
                            <h5 class="font-bold">Beats Studio by Dr.Dre</h5>
                             <div class="ratings ml-3 text-right">
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="ml-1">Shop Ratings</span>
                             </div>
                         </div>
                         <div class="right">
                            <span class=" font-14">11-Dec-2020</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <span class="text-black font-12 font-medium">Reason</span>
                        <p class="font-14 m-0">You don't have good choice of music, there's should be rap and metal every time have a blend of jazz and R&B with it. Spice it up with some Hip-Hop or feel the blues.</p>
                    </div>
                    
                </div>
               </div>
               <div class="col-md-12 shadow-1 br-5 mb-3">
                <div class="my-returns py-4">
                    <div class="top d-flex flex-wrap justify-content-between">
                        <div class="left d-flex">
                            <h5 class="font-bold">Beats Studio by Dr.Dre</h5>
                             <div class="ratings ml-3 text-right">
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="ml-1">Shop Ratings</span>
                             </div>
                         </div>
                         <div class="right">
                            <span class=" font-14">11-Dec-2020</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <span class="text-black font-12 font-medium">Reason</span>
                        <p class="font-14 m-0">You don't have good choice of music, there's should be rap and metal every time have a blend of jazz and R&B with it. Spice it up with some Hip-Hop or feel the blues.</p>
                    </div>
                    
                </div>
               </div>
               <div class="col-md-12 shadow-1 br-5 mb-3">
                <div class="my-returns py-4">
                    <div class="top d-flex flex-wrap justify-content-between">
                        <div class="left d-flex">
                            <h5 class="font-bold">Beats Studio by Dr.Dre</h5>
                             <div class="ratings ml-3 text-right">
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="ml-1">Shop Ratings</span>
                             </div>
                         </div>
                         <div class="right">
                            <span class=" font-14">11-Dec-2020</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <span class="text-black font-12 font-medium">Reason</span>
                        <p class="font-14 m-0">You don't have good choice of music, there's should be rap and metal every time have a blend of jazz and R&B with it. Spice it up with some Hip-Hop or feel the blues.</p>
                    </div>
                    
                </div>
               </div>
               <div class="col-md-12 shadow-1 br-5 mb-3">
                <div class="my-returns py-4">
                    <div class="top d-flex flex-wrap justify-content-between">
                        <div class="left d-flex ">
                            <h5 class="font-bold">Beats Studio by Dr.Dre</h5>
                             <div class="ratings ml-3 text-right">
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="ml-1">Shop Ratings</span>
                             </div>
                         </div>
                         <div class="right">
                            <span class=" font-14">11-Dec-2020</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <span class="text-black font-12 font-medium">Reason</span>
                        <p class="font-14 m-0">You don't have good choice of music, there's should be rap and metal every time have a blend of jazz and R&B with it. Spice it up with some Hip-Hop or feel the blues.</p>
                    </div>
                    
                </div>
               </div>
           </div>

        </div>

    </div>
</div>
        
    @endsection
    
    @stack('js')
   
      