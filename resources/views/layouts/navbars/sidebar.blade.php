<div class="sidebar" data-color="green">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-mini">
      {{ __('msg.lm') }}
    </a>
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('msg.thelastmilevendor') }}
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
        <a data-toggle="collapse" href="#user">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __('msg.customers') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{Request::is('user') ? 'show' : ''}}" id="user">
          <ul class="nav">

            <li class="@if ($activePage == 'show_customer') active @endif">
              <a href="{{ route('vendor_customers.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __('msg.customerlist') }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li>
        <a data-toggle="collapse" href="#service">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __('msg.categoryvend') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{Request::is('vendor/service*') ? 'show' : ''}}" id="service">
          <ul class="nav">
            <li class="@if ($activePage == 'Create Service') active @endif">
              <a href="{{ route('services.create') }}">
                <i class="now-ui-icons education_atom"></i>
                <p>{{ __('msg.addcategory') }}</p>
              </a>
            </li>
            <li class="@if ($activePage == 'Categories List') active @endif">
              <a href="{{ route('services.index') }}">
                <i class="now-ui-icons education_atom"></i>
                <p>{{ __('msg.categorylist') }}</p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#products">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __('msg.productsC') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{(Request::is('vendor/product-variants') || Request::is('vendor/products*')) && !Request::is('vendor/products/subs*')  ? 'show' : ''}}" id="products">
            <ul class="nav">
                <li class="@if ($activePage == 'Create Product') active @endif">
                    <a href="{{ route('products.create') }}">
                    <i class="now-ui-icons users_single-02"></i>
                    <p> {{ __('msg.addproducts') }} </p>
                    </a>
                </li>
                <li class="@if ($activePage == 'Products List') active @endif">
                    <a href="{{ route('products.index') }}">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p> {{ __('msg.productslist') }} </p>
                    </a>
                </li>
                <li class="@if ($activePage == 'Products Varients') active @endif">
                    <a href="{{ route('product-variants.index') }}">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p> {{ __('msg.productvarients') }} </p>
                    </a>
                </li>
                <li class="@if ($activePage == 'Create Upload') active @endif">
                    <a href="{{ route('product.upload.view') }}">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p> {{ __('msg.bulkupload') }} </p>
                    </a>
                </li>
            </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#orders">
            <i class="fab fa-laravel"></i>
          <p>
          {{ __('msg.orders') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{Request::is('vendor/orders*') || Request::is('vendor/products/subs') ? 'show' : ''}}" id="orders">
          <ul class="nav">
            <li class="@if ($activePage == 'Order list') active @endif">
              <a href="{{ route('vendor_orders.index') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __('msg.orderlist') }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Subscription Requests') active @endif">
                <a href="{{ route('products.request') }}">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p> {{ __('msg.subscriptionrequest') }} </p>
                </a>
            </li>
            
          </ul>
        </div>
      </li>


    </ul>
  </div>
</div>
