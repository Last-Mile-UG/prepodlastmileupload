<div class="sidebar" data-color="green">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-mini">
      {{ __('LM') }}
    </a>
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('The Last Mile Admin') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="fab fa-laravel"></i>
          <p>
            Category
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExamples">
          <ul class="nav">
            <li class="@if ($activePage == 'add_vendor') active @endif">
              <a href="{{route('category-create')}}">
                <i class="now-ui-icons users_single-02"></i>
                <p>Add Category </p>
              </a>
            </li>
            <li class="@if ($activePage == 'show_vendor') active @endif">
              <a href="{{route('category-index')}}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> Category List </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("Vendor") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{Request::is('admin/vendors*') ? 'show' : ''}}" id="laravelExamples">
          <ul class="nav">
            <li class="@if ($activePage == 'add_vendor') active @endif">
              <a href="{{ route('vendors.create') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("Add Vendor") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'show_vendor') active @endif">
              <a href="{{ route('vendors.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Vendor List") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#customer">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("Customer") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{Request::is('admin/customers*') ? 'show' : ''}}" id="customer">
          <ul class="nav">
            <li class="@if ($activePage == 'add_customer') active @endif">
              <a href="{{route('customers.create')}}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("Add Customer") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'show_customer') active @endif">
              <a href="{{ route('customers.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Customer List") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>

       <li>
        <a data-toggle="collapse" href="#Delivery_Options">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("Delivery Options") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{Request::is('admin/delivery*') ? 'show' : ''}}" id="Delivery_Options">
          <ul class="nav">
            <li class="@if ($activePage == 'Delivery Create') active @endif">
              <a href="{{ route('delivery.create') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("Add Delivery Options") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Delivery List') active @endif">
              <a href="{{ route('delivery.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Delivery Options List") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="{{Request::is('admin/orders*') ? 'active' : ''}}">
        <a href="{{ route('orders.index') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('All Orders') }}</p>
        </a>
      </li>

      <li class="{{Request::is('admin/service-fees*') ? 'active' : ''}}">
        <a href="{{ route('service-fees.index') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Service Fees') }}</p>
        </a>
      </li>

      <li>
        <a data-toggle="collapse" href="#reviews">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("Reviews") }}
            <b class="caret"></b>
          </p>
        </a>        
        <div class="collapse {{Request::is(['admin/product-reviews']) || Request::is('admin/product-var-reviews') || Request::is('admin/vendor-reviews') ? 'show' : ''}}" id="reviews">
          <ul class="nav">
            <li class="@if ($activePage == 'Product Reviews') active @endif">
              <a href="{{ route('product-reviews.index') }}">
                <i class="now-ui-icons design_app"></i>
                <p>{{ __('Product Reviews') }}</p>
              </a>
            </li>
          </ul>
          <ul class="nav">
            <li class="@if ($activePage == 'Product Var Reviews') active @endif">
              <a href="{{ route('product-var-reviews.index') }}">
                <i class="now-ui-icons design_app"></i>
                <p>{{ __('Product Varient Reviews') }}</p>
              </a>
            </li>
          </ul>
          <ul class="nav">
            <li class="@if ($activePage == 'Vendor Reviews') active @endif">
              <a href="{{ route('vendor-reviews.index') }}">
                <i class="now-ui-icons design_app"></i>
                <p>{{ __('Vendor Reviews') }}</p>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="@if ($activePage == 'service request list') active @endif">
        <a href="{{ route('service-requests.index') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Customer Service Request') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'showCustomer') active @endif">
        <a href="{{route('banner')}}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>Add Banner Image</p>
        </a>
      </li>

    </ul>
  </div>
</div>
