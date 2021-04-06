
<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
      {{ __('CT') }}
    </a>
    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      {{ __('Creative aaa Tim') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('msg.dashboard') }}</p>
        </a>
      </li>
      
      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("msg.vendor") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExamples">
          <ul class="nav">
            <li class="@if ($activePage == 'add_vendor') active @endif">
              <a href="{{ route('vendor.create') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("msg.addvendor") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'show_vendor') active @endif">
              <a href="{{ route('vendor.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("msg.vendorlist") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#customer">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("msg.customers") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="customer">
          <ul class="nav">
            <li class="@if ($activePage == 'customer') active @endif">
              <a href="#">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("msg.addcustomer") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'showCustomer') active @endif">
              <a href="{{ route('customer.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("msg.customerlist") }} </p>
              </a>
            </li>
            
          </ul>
        </div>
      </li>
      
    </ul>
  </div>
</div>