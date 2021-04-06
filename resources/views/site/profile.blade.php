@extends('layouts.site.app', [
    
    ])
    @section('content')

 <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}


</style>



    <div class="container-fuild" style="margin-top:-15px">
    <div class="row">
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
    @include('message.alert')
    <div class="container">
        <div class="row">
             <div class="col-md-4 my-4"> 
                  <!-- side bar-->
                  @include('layouts/navbars/userSidebar')
                 <!-- side bar-->
            </div>
            <div class="col-md-8 my-4">
                <div class="profile-area shadow-1 p-3">
                    <h3 class="mb-3">{{__('msg.myprofile')}}</h3>
                    <div class="profile-image-container mb-2">
                        <img src="{{$record->detail->image}}" alt="">
                    </div>
                    <div class="profile-form">
                        <form action="{{route('profileEdit', ['id'=> $record->id]) }}" method="post">
                        @method('PUT')
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="title">{{__('msg.username')}}</label>
                                    <input type="text" class="form-control" name="username" value="{{$record->name}}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">{{__('msg.emailaddress')}}</label>
                                    <input type="email" class="form-control" name="email" value="{{$record->email}}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">{{__('msg.mobilenumber')}}</label>
                                    <input type="text" class="form-control" name="phone" value="{{$record->detail->phone}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="title">Birthday{{__('msg.birthday')}}</label>
                                    <input type="date" class="form-control" name="birthday" value="{{\Carbon\Carbon::parse($record->detail->birthday)->format('Y-m-d')}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">{{__('msg.password')}}</label>
                                    <input type="password" class="form-control" name="password" placeholder="{{__('msg.password')}}">
                                </div>
                                <div class="form-group custom-onoff col-md-4">
                                    <label for="title">Notifications in English</label>  
                                    <div style="margin-right:20px;">
                                    @if($record->detail->language)
                                    <label class="switch">                               
                                        <input type="checkbox" id="lang" data-id="{{$record->id}}" checked>
                                        <span class="slider"></span>
                                    </label>
                                    @else
                                    <label class="switch">                               
                                        <input type="checkbox" id="lang" data-id="{{$record->id}}" >
                                        <span class="slider"></span>
                                    </label>
                                    @endif
                                    </div>                                   
                              </div>
                            </div>
                            <div class="form-group my-2">
                                <button class="btn btn-black font-14 ">{{__('msg.updatedetailbtn')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Initialize Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<!-- Initialize Swiper -->
    
    <script>
   $('document').ready(function()
   {
    $('#lang').change(function () {
        var id =  $('#lang').attr('data-id')
       
       route = `{{route('profileLanguage')}}`
       route = route+'/'+id;
       console.log(route)
       $.ajax({
        type: "GET",
        datatype: "json",
        url: route,
        success: function(data)
        {
            
        }
       });
 });
      
   });
    </script>
    <script>
		var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    </script>

     <script>
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;
            for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.classList.contains("show")) {
            dropdownContent.classList.remove("show");
            } else {
            dropdownContent.classList.add("show");
                }
            });
            }

    </script>