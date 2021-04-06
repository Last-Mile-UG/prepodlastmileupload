<!-- Signup modal-->
<!-- Modal -->

<div class="modal "  id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content  login-signup-modal signup">
        <div class="modal-body p-0">
            <div class="row ">
                <div class="col-sm-12 col-md-12 col-lg-6 p-0 m-0 ">
                    <div class="img-container">
                        <img src="{{asset('assets/site/img/login-signup-bg.png')}}" alt="" class="bg img-fluid">
                        <img src="{{asset('assets/site/img/logo.png')}}" alt="" class="logo">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="login-signup-form signup-form  my-4  mx-4">
                        <div class="header mb-4">
                            <h4 class="font-bold mb-2 text-black">{{__('msg.startfromscartch')}}</h4>
                            <p class="font-14 text-grey">{{__('msg.createaccount')}}</p>
                        </div>
                        <form method="POST" action="{{route('register')}}">
                            @csrf
                            <input type="hidden" name="role" value="customer">
                            <div class="body">
                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.fullname')}}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{__('msg.enterfullname')}}" required>

                                </div>
                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.enteremail')}}</label>
                                    <input type="email" name="email" class="form-control" placeholder="{{__('msg.enteremailaddress')}}" required>
                                </div>
                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.password')}}</label>
                                    <input type="password" name="password" class="form-control" placeholder="{{__('msg.enterpassword')}}" required>
                                </div>
                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.phonenumber')}}</label>
                                    <input type="number" name="phone" class="form-control" placeholder="{{__('msg.enterphonenumber')}}" required>
                                </div>
                                <div class="form-col mb-3">
                                    <label for="title" class="mb-1">{{__('msg.address')}}</label>
                                    <input type="text" name="address" class="form-control" placeholder="{{__('msg.enteraddress')}}" required>
                                </div>
                                <!-- <div>
                                    <label>Register as premium</label>
                                    <input type="checkbox" id="premium" name="premiumCustomer" value="premium">
                                </div> -->
                                <div class="form-col mb-4">
                                    <button type="submit" class="btn btn-green w-100 p-2">{{__('msg.signup')}}</button>
                                </div>
                                <div class="form-check p-0 text-center">
                                    <label for="title" class="d-block m-0">{{__('msg.alreadyaccount')}}</label>
                                    <a href="" data-dismiss="modal" onClick="loginModal()"  class="switch-link">{{__('msg.loginhere')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<!-- Signup modal closed-->