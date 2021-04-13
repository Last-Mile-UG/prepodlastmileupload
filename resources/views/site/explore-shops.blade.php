@extends('layouts.site.app', [
    
    ])
    
@section('content')
<div class="container">

<!-- <div class="row">
    <div class="col-md-12 mt-4 mb-3">
    <h3 class="font-medium">Categories</h3>
    </div>
    <div class="col-md-12 mb-3 ">
        <div class="swiper-container category-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/perfume.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Perfumes</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/watches.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Watches</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/cloth.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Cloth</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/makeup.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Makeup</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/watches.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Watches</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/perfume.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Perfumes</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/cloth.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Clothing</p>
                </a>
                </div>
                <div class="swiper-slide category">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/makeup.jpg') }}" alt="Category" class="category-img">
                 <p class="category-title">Makeup</p>
                </a>
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-4 mb-3">
    <h3 class="font-medium">Shops</h3>
    </div>
    <div class="col-md-12 mb-5 ">
        <div class="swiper-container shops-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/perfume.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/watches.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/cloth.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/makeup.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/watches.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/perfume.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/cloth.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
                <div class="swiper-slide shop">
                <a href="" class="d-flex flex-column">
                 <img src="{{ asset('assets/site/img/categories/makeup.jpg') }}" alt="Category" class="shop-img">
                 <p class="shop-title">Shop Name</p>
                </a>
                </div>
            </div>
            Add Arrows
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div> -->

    <div class="row">
        <div class="col-md-12 mb-3 mt-4">
            <div class="d-flex d-flex justify-content-between">
                <h3 class="font-medium">{{__('msg.shopnearheading')}}</h3>
                <!-- <div class="shops-search-container d-flex">
                    <input type="text" class="shop-search-input form-control mr-2" id="shop-search-input" placeholder="{{__('msg.searchshop')}}">
                    <button class="btn search-btn" >
                        <img src="{{ asset('assets/site/img/icons/search_icon.png') }}" alt="">
                    </button>
                </div> -->
            </div>            
        </div>
    </div>

    <div class="row">
        @foreach($shops as $shop)
        <div class="col-md-3 mb-4">
            <div class="card s-shop shadow-2">
                <div class="card-header px-2 pt-3 d-flex justify-content-between">
                    <span class="shop-category-tag px-2" style="background: none;"></span>
                    <div class="shop-options d-flex">
                        <button class="btn btn-transparent">
                            <img src="{{ asset('assets/site/img/icons/favorite_unactive.png') }}" alt="">
                        </button>
                        <button class="btn btn-transparent" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="{{ asset('assets/site/img/icons/filter.png') }}" alt="">
                        </button>
                    </div>
                </div>
                <div class="card-body-s text-center d-flex flex-column align-items-center mt-2">
                    <img src="{{ $shop->detail->image }}" alt="" class="shop-img px-3 mb-3">
                    <span>{{ $shop->name }}</span>                    
                </div>
                <div class="card-footer">
                    <div class="ratings-and-reviews d-flex justify-content-center">
                        <div class="ratings ">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="reviews ml-2">{{$shop->reviews_count}}</span>
                    </div>
                    @if($shop->detail->opening_time)
                    <div class="row flex justify-content-center">
                        <div>
                        <i class="fa fa-clock-o" aria-hidden="true"></i>{{$shop->detail->opening_time}} - {{$shop->detail->closing_time}}
                        </div>
                       
                    </div>
                    @else
                    <div style="height: 40px">
                    
                    </div>
                    @endif
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <a href="{{route('site.explore.vendor.products', ['id'=>$shop->id])}}" class="shop-link">{{__('msg.viewshop')}}</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>

    $(document).ready(function(){
    
    searchInputFocusIn();
    searchInputFocusOut();

    function searchInputFocusIn(){
            $( "#shop-search-input" ).focusin(function() {
            h3 = $(this).parent().parent().find('h3');
            h3.hide();
            $(this).parent().addClass('w-100');
             });
    }

    function searchInputFocusOut(){
            $( "#shop-search-input" ).focusout(function() {
            h3 = $(this).parent().parent().find('h3');
            h3.show();
            $(this).parent().removeClass('w-100');
            });
    }
    
    });
</script>