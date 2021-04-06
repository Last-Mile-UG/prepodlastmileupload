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
    </div>
</div>
<div class="container">
    <div class="row">

         <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-4 mt-2"> 
              <!-- side bar-->
              @include('layouts/navbars/userSidebar')
             <!-- side bar-->
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3 mt-2">
        <!--order search and filter -->   
           <div class="order-search-filter d-flex flex-wrap justify-content-between mb-3">
               <div class="order-search">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="{{__('msg.orderid')}}#" aria-label="Recipient's username" aria-describedby="basic-addon2">
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


            <div class="current-month bg-green br-green d-flex justify-content-between p-2 mb-2">
                <span class="font-16 text-white ">{{__('msg.currentmonth')}}</span>
                <span class="font-16 text-white ">500</span>
            </div>
            <div class="current-month bg-white br-black d-flex justify-content-between p-2 mb-4">
                <span class="font-16 text-black">{{__('msg.duethismonth')}}</span>
                <span class="font-16 text-black  ">1500</span>
            </div>

            <div class="current-month bg-green d-flex p-2">
                <span class="font-16 text-white font-medium">{{__('msg.transactions')}}</span>
            </div>
           <div class="balance-history table-responsive">
           
               <table class="table">
                   <thead>
                    <tr>
                        <th>{{__('msg.order')}}#</th>
                        <th>{{__('msg.date')}}</th>
                        <th>{{__('msg.shopname')}}</th>
                        <th>{{__('msg.invoice')}}</th>
                        <th>{{__('msg.paymentpurchase')}}</th>
                        <th>{{__('msg.total')}}</th>
                    </tr>
                   </thead> 
                   <tbody>
                       <tr>
                           <td>
                               <a href="">122321</a>
                           </td>
                           <td>Dec 02, 2020</td>
                           <td>Basket Bakers</td>
                           <td><a href="">View</a></td>
                           <td>Pay Purchase</td>
                           <td>-50</td>
                       </tr>
                       <tr>
                        <td>
                            <a href="">122321</a>
                        </td>
                        <td>Dec 02, 2020</td>
                        <td>Basket Bakers</td>
                        <td><a href="">View</a></td>
                        <td>Pay Purchase</td>
                        <td>-50</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="">122321</a>
                        </td>
                        <td>Dec 02, 2020</td>
                        <td>Basket Bakers</td>
                        <td><a href="">View</a></td>
                        <td>Pay Purchase</td>
                        <td>-50</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="">122321</a>
                        </td>
                        <td>Dec 02, 2020</td>
                        <td>Basket Bakers</td>
                        <td><a href="">View</a></td>
                        <td>Pay Purchase</td>
                        <td>-50</td>
                    </tr>
                   </tbody>
               </table>
           </div>   

           <div class="current-month bg-black d-flex justify-content-between p-1 mb-4">
            <span class="font-16 text-white ">{{__('msg.outstanding')}}</span>
            <span class="font-16 text-white ">1500€</span>
            </div>

        </div>

    </div>
</div>
    @endsection
    
    @stack('js')
      </body>
      </html>
      