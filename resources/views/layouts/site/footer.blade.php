<!--footer open-->


@if(!\Cookie::get('Essentials'))
<!--cookie area -->
<div class="cookie-bg-overlay">
    <div class="cookie-box p-3">
        <div class="container one show">
            <div class="row align-items-center">
                <div class="col-12 col-lg-9">
                    <div class="d-flex flex-wrap flex-sm-wrap flex-md-nowrap flex-lg-nowrap align-items-center">
                        <div class="logo mr-4 mb-3">
                            <img src="{{ asset('assets/site/img/logo.png') }}" alt="">
                        </div>
                        <div class="content d-flex flex-column">
                            <h4 class="font-22 text-grey">Privacy Settings</h4>
                            <p class="font-13 text-grey">We use cookies on our website. Some of them are essential, while others help us to improve this website and your experience.</p>
                            <div class="d-flex">
                                <div class="form-check mb-2 mr-3">
                                    <input class="form-check-input" checked type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label font-14" i for="title-2">
                                        Essential
                                    </label>
                                    
                                </div> 
                                <!-- <div class="form-check mb-2 mr-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label font-14" for="title-2">
                                        Statistics
                                    </label>
                                    <input type="hidden" value="Statistics" name="statistics">
                                </div> -->
                                <!-- <div class="form-check mb-2 mr-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label font-14" for="title-2">
                                        External media
                                    </label>
                                    <input type="hidden" value="External" name="external">

                                </div> -->
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-check mb-2 p-0">
                        <button class="btn btn-green w-100 py-2 accept-btn" onclick="acceptCookies()">Accept all</button>
                    </div>
                    <div class="form-check mb-3 p-0">
                        <button class="btn btn-light-grey w-100 py-2 save-btn" >to save</button>
                    </div>
                    <a href="" class="mb-2 font-11 d-block text-grey text-center">Accept essential cookies</a>
                    <a href="" class="mb-2 font-11 d-block text-green text-center">Individual data protection settings</a>
                    <div class="d-flex cookie-link justify-content-center">
                        <a href="" id="switch-cookie-one">Cookie details</a>
                        <a href="" class="vertical-line">Data protection</a>
                        <a href="" class="vertical-line">imprint</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container two ">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="d-flex flex-wrap flex-sm-wrap flex-md-nowrap flex-lg-nowrap align-items-center">
                        <div class="logo mr-4 mb-3">
                            <img src="{{ asset('assets/site/img/logo.png') }}" alt="">
                        </div>
                        <div class="content d-flex flex-column w-100">
                            <h4 class="font-22 text-grey">Privacy Settings</h4>
                            <p class="font-13 text-grey">Here you will find an overview of all cookies used. You can give your consent to entire categories or have further information displayed and only select certain cookies.</p>
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="left mb-2 mb-sm-2 mb-md-0 mb-lg-0">
                                    <button class="btn btn-green mr-1 mb-2 mb-sm-0 mb-md-0 mb-lg-0 accept-btn">Accept all</button>
                                    <button class="btn btn-light-grey mb-2 mb-sm-0 mb-md-0 mb-lg-0 save-btn">to save</button>
                                </div>
                                <div class="right d-flex cookie-link align-items-center ">
                                    <a class="font-12 text-grey" href="" id="switch-cookie-two">Back</a>
                                    <a class="font-12 text-grey vertical-line" href="">Accept essential cookies</a>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row cookie-details-container">
                <div class="col-md-12  mb-2 mt-3">
                    <div class="cookie-details p-2 bg-light-grey-2">
                    <h4 class="font-16 text-grey">Essentials (2)</h4>
                    <p class="font-12 text-grey">Essential cookies enable basic functions and are necessary for the website to function properly.</p>
                    <p class="text-green font-12 mb-1 text-center font-medium display-cookie">Display cookie information</p>
                    <!-- cookie details table container -->
                    <div class="cookie-table-container mb-3">
                        <table class="cookie-table">
                            <tbody>
                                <tr>
                                    <td >Surname</td>
                                    <td>LastMile cookie</td>
                                </tr>
                                <tr>
                                    <td>providers</td>
                                    <td>Owner of this website</td>
                                </tr>
                                <tr>
                                    <td>purpose</td>
                                    <td>Saves the settings of the visitors selected in the borlabs</td>
                                </tr>
                                <tr>
                                    <td>Cookie name</td>
                                    <td>LastMile-cookie</td>
                                </tr>
                                <tr>
                                    <td>Cookie runtime</td>
                                    <td>Forever</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- cookie details table container -->

                    <!-- <div class="cookie-table-container mb-3">
                        <table class="cookie-table">
                            <tbody>
                                <tr>
                                    <td >Surname</td>
                                    <td>Borlabs cookie</td>
                                </tr>
                                <tr>
                                    <td>providers</td>
                                    <td>Owner of this website</td>
                                </tr>
                                <tr>
                                    <td>purpose</td>
                                    <td>Saves the settings of the visitors selected in the borlabs</td>
                                </tr>
                                <tr>
                                    <td>Cookie name</td>
                                    <td>Borlabs-cookie</td>
                                </tr>
                                <tr>
                                    <td>Cookie runtime</td>
                                    <td>1 year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->

                    </div>
                </div>
                <!-- <div class="col-md-12 mb-2">
                    <div class="cookie-details p-2 bg-light-grey-2">
                    <div class="d-flex justify-content-between">
                        <h4 class="font-16 text-grey">Statistics</h4>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <p class="font-12 text-grey">Statistics cookies collect information anonymously. This information helps us to understand how our visitors use our website.</p>
                    <p class="text-green font-12 mb-1 text-center font-medium display-cookie">Display cookie information</p> -->
                   
                    <!-- cookie details table container -->

                    <!-- <div class="cookie-table-container mb-3">
                        <table class="cookie-table">
                            <tbody>
                                <tr>
                                    <td >Surname</td>
                                    <td>Borlabs cookie</td>
                                </tr>
                                <tr>
                                    <td>providers</td>
                                    <td>Owner of this website</td>
                                </tr>
                                <tr>
                                    <td>purpose</td>
                                    <td>Saves the settings of the visitors selected in the borlabs</td>
                                </tr>
                                <tr>
                                    <td>Cookie name</td>
                                    <td>Borlabs-cookie</td>
                                </tr>
                                <tr>
                                    <td>Cookie runtime</td>
                                    <td>1 year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div> -->
<!-- 
                <div class="col-md-12 mb-2">
                    <div class="cookie-details p-2 bg-light-grey-2">
                    <div class="d-flex justify-content-between">
                    <h4 class="font-16 text-grey">External Media (1)</h4>
                    <label class="switch">
                    <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                    </div>
                    <p class="font-12 text-grey">Content from video platforms and social media platforms is blocked by default. If cookies from external media are accepted, access to this content no longer requires manual consent.</p>
                    <p class="text-green font-12 mb-1 text-center font-medium display-cookie">Display cookie information</p> -->
                    
                    <!-- cookie details table container -->
<!-- 
                    <div class="cookie-table-container mb-3">
                        <table class="cookie-table">
                            <tbody>
                                <tr>
                                    <td >Surname</td>
                                    <td>Borlabs cookie</td>
                                </tr>
                                <tr>
                                    <td>providers</td>
                                    <td>Owner of this website</td>
                                </tr>
                                <tr>
                                    <td>purpose</td>
                                    <td>Saves the settings of the visitors selected in the borlabs</td>
                                </tr>
                                <tr>
                                    <td>Cookie name</td>
                                    <td>Borlabs-cookie</td>
                                </tr>
                                <tr>
                                    <td>Cookie runtime</td>
                                    <td>1 year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!--cookie area -->
@endif



 <footer class="footer py-1 py-sm-2 py-md-3 ">
    <div class="d-flex justify-content-center justify-content-sm-center justify-content-sm-between justify-content-lg-between flex-wrap">
        <div class="left ml-2 ml-sm-5 ml-md-5 ml-lg-5 mr-2 mb-2 mb-sm-0 mb-md-0 mb-lg-0">
           <span class="mr-4"> ©&nbsp;{{date('Y')}} LastMile</span>
           <!-- <a href="{{route('privacypolicy')}}" class="mr-4">{{__('msg.privacy')}}</a> -->
           <a href="{{route('terms')}}">{{__('msg.term')}}</a>

           <a href="{{route('Impressum')}}" class="pl-3 mr-4">{{__('Impressum')}}</a>
           <a href="{{route('datenschutz')}}" >{{__('msg.privacy')}}</a>
        </div>
        <div class="right d-flex  ml-2">
            <a href="https://www.facebook.com/lastmileug/" class="mr-4">
                <img src="{{ asset('assets/site/img/icons/fb.png') }}" alt="">
            </a>
            <a href="https://twitter.com/lastmileug" class="mr-4">
                <img src="{{ asset('assets/site/img/icons/twitter.png') }}" alt="">
            </a>
            <a href="https://www.instagram.com/thelastmile.shop/" class="mr-4">
                <img src="{{ asset('assets/site/img/icons/instagram.png') }}" alt="">
            </a>
            <!-- <a href="" class="mr-4">
                <img src="{{ asset('assets/site/img/icons/youtube.png') }}" alt="">
            </a> -->
        </div>
    </div>
</footer>
<!--footer closed-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->    

<script>

    function acceptCookies()
{
    let route = `{{route('add-cookie')}}`
        $.ajax({
            url : route,
            type : "GET",
            datatype : "json",
            
            success:function(result){
                // $('#final-qty-'+id).html(result.count);
                
    
            }
        });
}

</script>
