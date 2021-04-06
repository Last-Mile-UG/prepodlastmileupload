

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@include('admin.layouts.navbars.sidebar')
<div class="main-panel">
    @include('admin.layouts.navbars.navs.auth')
    @yield('content')
    @include('admin.layouts.footer')
</div>