@extends('layouts.site.app', [
    
    ])
    
    @section('content')
    <div class="container-fuild">
    <div class="row">
            <div class="swiper-container support mb-4 ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide ">
                        <span>Welcome Ahsan</span>
                        <img src="{{asset('assets/site/img/banners/banner_support.png')}}" alt=""> 
                    </div>
                    <div class="swiper-slide ">
                        <span>SPECIAL BEATS</span>
                        <img src="{{asset('assets/site/img/banners/banner_support.png')}}" alt=""> 
                    </div>
                    <div class="swiper-slide ">
                        <span>CLASSICAL BEATS</span>
                        <img src="{{asset('assets/site/img/banners/banner_support.png')}}" alt=""> 
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
          <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-3">
            <nav class="support_vendor_tab mb-3">
                <div class="nav nav-tabs d-flex justify-content-center py-2" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Vendor</a>
                  <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Support</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!--vendor area-->
                <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                </div>
                <!--vendor area-->
                <!--support area-->
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="support-area shadow-1 ">
                        <div class="support-chats d-flex flex-column p-1">
                            <div class="support-chat d-flex flex-fill px-2 py-3 ">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-fill pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
        
                            </div>
                            <div class="support-chat d-flex flex-fill px-2 py-3 ">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-fill pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
        
                            </div>
                            <div class="support-chat d-flex flex-fill px-2 py-3">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column  pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
        
                            </div>
                            <div class="support-chat d-flex flex-fill px-2 py-3">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-fill pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
        
                            </div>
                            <div class="support-chat d-flex flex-fill px-2 py-3">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-fill pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
                            </div>
                            <div class="support-chat d-flex flex-fill px-2 py-3">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-fill pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
                            </div>
                            <div class="support-chat d-flex flex-fill px-2 py-3">
                                <div class="img-container">
                                    <img src="{{ asset('assets/site/img/avatar_pic.png')}}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-fill pl-1">
                                    <span class="font-14 font-regular text-black">Andrew Moore</span>
                                    <span class="font-12 font-regular">You don't have... </span> <!-- dont add more than 14 characters-->
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <span class="font-10 mb-1 align-self-end">2 hrs ago</span>
                                    <span class="online-status active align-self-end"></span>   
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--support area-->
            </div>
          </div>





          <div class="col-12 col-sm-12 col-md-6 col-lg-5 mb-3">
              <div class="chat-header d-flex justify-content-between shadow-1 py-2 mb-3">
                  <div class="left">
                    <button class="btn btn-back px-1 ml-1">
                        <img src="{{asset('assets/site/img/icons/back_icon.png')}}" alt="">
                    </button>
                  </div>
                  <div class="center ">
                    <span class="chat-title">Diane Tucker</span>
                  </div>
                  <div class="right">
                    <button class="btn btn-more px-1 mr-1">
                        <img src="{{asset('assets/site/img/icons/more.png')}}" alt="">
                    </button>
                  </div>
              </div>

              <!-- chat area-->
              <div class="chat-area shadow-1">
              <!-- chat msgs-->
              <div class="chat-history px-4 pt-4 pb-5 ">
                    <div class="receiver-msg">
                        <div class="msg p-2">
                            You don't have good choice of music, there's should be rap and metal every time have a blend of jazz and R&B with it. Spice it up with some Hip-Hop or feel the blues.
                        </div>
                        <span class="time mt-1">Nov 15, 10:25</span>
                    </div>
                    <div class="receiver-msg">
                        <div class="msg p-2">
                            Kindly refund my money
                        </div>
                        <span class="time mt-1">Nov 15, 10:25</span>
                    </div>
                    <div class="sender-msg">
                        <div class="msg p-2">
                            Sir can you tell me time and order id please
                        </div>
                        <span class="time mt-1">Nov 15, 10:25</span>
                    </div>
                    <div class="sender-msg">
                        <div class="msg p-2">
                            As we are unable to trace your order
                        </div>
                        <span class="time mt-1">Nov 15, 10:25</span>
                    </div>
                    <div class="sender-msg">
                        <div class="msg p-2">
                            Please let us know your order id and email id so we can trace the actual problem. Right now we are unable to findout the reason.
                        </div>
                        <span class="time mt-1">Nov 15, 10:25</span>
                    </div>

                   
              </div>
              <!-- chat msgs-->

              <!-- msg send-->
                <div class="write-msg-area">
                <button class="btn send-msg">
                <img src="{{asset('assets/site/img/icons/send.png')}}" alt="">
                </button>
                <textarea name="" id=""  class="form-control py-2" placeholder="Write your message..."></textarea>
                </div>
              <!-- msg send-->

              </div>
          </div>
        </div>



        
    </div>
    @endsection
    
    @stack('js')
      
      