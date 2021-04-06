<!-- Login modal-->
<!-- Modal -->
<div class="modal "  id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content  login-signup-modal login">
        <div class="modal-body p-0">
            <div class="row ">
                <div class="col-md-6 p-0 m-0 ">
                    <div class="img-container">
                        <img src="{{asset('assets/site/img/login-signup-bg.png')}}" alt="" class="bg img-fluid">
                        <img src="{{asset('assets/site/img/logo.png')}}" alt="" class="logo">
                    </div>
                </div>
                <div class="col-md-6 ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-signup-form login-form pt-5 px-4">
                            <div class="header mb-4">
                                <h4 class="font-bold mb-2 text-black">{{__('msg.welcomeback')}}</h4>
                                <p class="font-14 text-grey">{{__('msg.pleaselogin')}}</p>
                            </div>
                            <div class="body">
                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.emailaddress')}}</label>
                                    <input type="email" name="email" class="form-control" placeholder="{{__('msg.enteremail')}}" required>
                                </div>
                                <!-- <div class="form-check">
                                    <a href="" class="float-right forgot-link">Forgot Password?</a>
                                </div> -->

                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.password')}}</label>
                                    <input type="password" name="password" class="form-control" placeholder="{{__('msg.enterpassword')}}" required>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label " for="title-2">
                                    {{__('msg.rememberme')}}
                                    </label>
                                </div>
                                <div class="form-col mb-4">
                                    <button type="submit" class="btn btn-green w-100 p-2">{{__('msg.login')}}</button>
                                </div>
                                <div class="form-check text-center">
                                    <label for="title" class="d-block m-0">{{__('msg.newhere')}}</label>
                                    <a href="" data-dismiss="modal" onClick="signUpModal()" class="switch-link">{{__('msg.createaccount')}}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

@include('layouts.site.signup')
<!-- signup modal closed-->
<script>
    function signUpModal(){
        login = `{{auth()->check()}}`
        if(!login)
            $("#signup").modal('show');
    }
</script>