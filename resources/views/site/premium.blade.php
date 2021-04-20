@extends('layouts.site.app', [
])
@section('content')
<div class="container-fuild">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 mt-3">
                <div class="card-head ml-5"><h3>Roles for Customer</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="card float:right" style="height:auto;">
                                        <div class="card-header text-center" style="background-color:transparent"><strong>Basic User</strong></div>
                                        <div class="card-body">
                                            <p style="text-align:left">{{__('msg.freepara')}}</p>
                                        </div>
                                        <div class="p-3 d-flex justify-content-center">
                                            <a href="{{route('premiumstatus')}}" class="btn btn-success">Subscribe
                                            </a>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="card" style="height:auto;">
                                        <div class="card-header text-center" style="background-color:transparent"><strong>Premium User</strong></div>
                                        <div class="card-body">
                                        <p style="text-align:left;">{{__('msg.permiumpara')}}</p>
                                        </div>
                                        <div class="p-3 d-flex justify-content-center">
                                            {{__('msg.comingSoon')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="existing-payment-container" style="margin-top:-55px">
                                    <div class="checkout-method" id="d-c-card">
                                        <h4 for="title" class="my-3 ml-3 mb-2">{{__('msg.CardDetails')}}</h4>
                                        <form method="post" id="card-form" action="{{route('premiumuser')}}">
                                            @csrf
                                            <div class="form-row mb-3">
                                                <div class="form-col col-md-6">
                                                <label class="m-0"><input type="radio" id="creadit-card" class="mr-3 checkout-radio cardType" name="cardType"  value="Credit Card">{{__('msg.creditcard')}}</label>
                                                <i class="fa fa-credit-card float-right"></i>
                                                </div>
                                            </div>
                                            <div class="bg-white  br-5 p-3">
                                                <div class="form-col mb-3">
                                                    <input type="text" class="form-control custom c" id="card_number" value="" name="cardnumber" placeholder="{{__('msg.cardnoplaceholder')}}">
                                                </div>
                                                <div class="form-col mb-3">
                                                    <input type="text" class="form-control custom c" id="cardHolderName" name="cardholder" value="" placeholder="{{__('msg.cardholdernameplaceholder')}}">
                                                </div>
                                                <div class="form-row mb-3">
                                                    <div class="form-col col-md-6">
                                                        <input type="text" class="form-control custom c" id="card_expiration_year" value="" name="expiryyear" placeholder="{{__('msg.expiryyearplaceholder')}}">
                                                    </div>
                                                    <div class="form-col col-md-6">
                                                        <input type="text" class="form-control custom c" id="cvv" value="" name="cvc" placeholder="CVC">
                                                    </div>
                                                </div>
                                                <div class="form-col mb-3">
                                                <input type="text" class="form-control custom c" id="card_expiration_month" value="" name="expirymonth" placeholder="{{__('msg.expirymonthplaceholder')}}">
                                                </div>
                                                <button type="button" onclick="token()" class="btn btn-black" style="border-radius:30px">
                                                Payment
                                                </button>
                                            </div>
                                        <p class="payment-errors"></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>
@endsection
@stack('js')
<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script>
$(document).ready(function()
{
    $("#existing-payment-container").hide(); 
});
//  $("#add-new-card").on('click',function(){
//         // $("#existing-payment-container").hide();
//         $("#existing-payment-container").show();
//     });

function addnewcard()
{
        $("#existing-payment-container").show();

}
</script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
   publishKey='{{env('STRIPE_PUBLISH_KEY')}}';
   Stripe.setPublishableKey(publishKey);

    function stripeResponseHandler(status, response) {

            // Grab the form:
            var $form = $('#card-form');

            if (response.error) { // Problem!

                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                console.log(response.error.message)
                $form.find('button').prop('disabled', false); // Re-enable submission

            } else { // Token was created!

                // Get the token ID:
                var token = response.id;

                // Insert the token into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));

                // Submit the form: 
                $form.get(0).submit();
            }
    }
    function token(){
        Stripe.createToken({
            number : $('#card_number').val(),
            exp_month : $('#card_expiration_month').val(),
            exp_year : $('#card_expiration_year').val(),
            cvc : $('#cvv').val(),
        }, stripeResponseHandler);
    }

</script>