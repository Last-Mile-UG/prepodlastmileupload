<div class="account-opts side-bar shadow-1">
    <ul class="nav flex-column">
        <li class="nav-item">

          <label href="#" class="nav-link py-4  dropdown-btn" id="pills-all" data-toggle="pill" href="#pills-show-all" role="tab" aria-controls="pills-show-all" aria-selected="true">
          {{ __('msg.myorders')}}
            <i class="fa fa-angle-right float-right"></i>
            </label>
            <div class="dropdown-container">
                <ul class="nav" style="display:block">
                <li class="nav-item" ><a class="nav-link py-4"  href="{{route('allorders')}}">{{__('msg.allorders')}}</a></li>
                <li class="nav-item" ><a class="nav-link py-4" id="pills-product" data-toggle="pill" href="#pills-product-only" role="tab" aria-controls="pills-product-only" aria-selected="false">{{__('msg.products')}}</a></li>
                <li class="nav-item"><a class="nav-link py-4" id="#pills-only" data-toggle="pill" role="tab" aria-controls="subscription-only" data-toggle="pill" href="#pills-subscription-only" aria-selected="false">{{__('msg.subscriptions')}}</a></li>
                <li class="nav-item"><a href="{{route('return')}}" class="nav-link py-4">{{__('msg.myreturn')}}</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <label class="nav-link py-4 dropdown-btn">
            {{__('msg.manageaccount')}}
            <i class="fa fa-angle-right float-right"></i>
            </label>
            <div class="dropdown-container">
            <a href="{{route('profile')}}" class="nav-link py-4">{{__('msg.myprofile')}}</a>
            <a href="{{route('address')}}" class="nav-link py-4">{{__('msg.myaddress')}}</a>
            <!-- <a href="" class="nav-link py-4">Notifications</a> -->
            </div>
        </li>
        <li class="nav-item">
            <lable class="nav-link py-4 dropdown-btn">
            {{__('msg.orderhistory')}}
                <i class="fa fa-angle-right float-right"></i>
            </lable>
            <div class="dropdown-container " >
                <a href="{{route('orderhistory')}}" class="nav-link py-4 ">{{__('msg.viewhistory')}}</a>
            </div>
        </li>
        <li class="nav-item">
            <lable class="nav-link py-4 dropdown-btn">
                {{__('msg.paymenthistory')}}
                <i class="fa fa-angle-right float-right"></i>
            </lable>
            <div class="dropdown-container " >
                <a href="{{route('accountbalance')}}" class="nav-link py-4 ">{{__('msg.accountbalance')}}</a>
            </div>
        </li>
        <li class="nav-item">
            <lable class="nav-link py-4 dropdown-btn">
            {{__('msg.messagecenter')}} 
            <i class="fa fa-angle-right float-right"></i>
            </lable>
            <div class="dropdown-container">
            <a href="{{route('site.vendor')}}" class="nav-link py-4">{{__('msg.vendor')}}</a>
            <a href="{{route('site.support')}}" class="nav-link py-4">{{__('msg.support')}}</a>
            </div>
        </li>
       </ul>
</div>
