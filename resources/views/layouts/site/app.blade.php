<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/site/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- SWIPER SLIDER CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
   
    
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

    <title>Last Mile | Shop</title>    
  </head>
    <body class="bg-light-grey" >
    @include('layouts.site.header')
    <div class="container-fluid ">
      <div class="pt-157">
      </div>
        @yield('content')
    </div>
    @include('layouts.site.footer')
  <!--container-fluid closed-->
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/site/js/script.js') }}"></script>
    <script src="{{asset('assets/site/js/cookie.js')}}"></script>
    <script src="{{asset('assets/helppage/js/util.js')}}"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="{{asset('assets/helppage/js/main.js')}}"></script> 
    <!-- Initialize Swiper -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper('.swiper-container', {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  var swiper1 = new Swiper('.category-container', {
    slidesPerView:'auto',
    spaceBetween: 24,
    slidesPerGroup: 1,
    loop: false,
    loopFillGroupWithBlank: false,
    pagination: {
      el: '.swiper-pagination',
      type:'none',
      clickable: true,
        
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  
  var swiper2 = new Swiper('.shops-container', {
    slidesPerView:'auto',
    spaceBetween: 24,
    slidesPerGroup: 1,
    loop: false,
    loopFillGroupWithBlank: false,
    pagination: {
      el: '.swiper-pagination',
      type:'none',
      clickable: true,
        
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>
</body>