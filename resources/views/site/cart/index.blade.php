@extends('layouts.site.app', [
    
    ])

@section('content')
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

</style>
    <div class="container">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3">
            <h3 class="mt-3 mb-3 font-medium">{{__('msg.cart')}}</h3>               
            @foreach($items->unique('options.vendorId') as $uniqueVendor)
                <div class="row shadow-1 pb-3">                        
                    <div class="col-md-12">
                        <div class="cart-header d-flex justify-content-between my-3">
                            <h4 class="font-medium">{{$uniqueVendor->options->vendorName }}</h4>     
                        </div>
                    </div>
                    @foreach($items->where('options.vendorId', $uniqueVendor->options->vendorId)->take(3) as $item)
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                            <div class="cart-item mr-2 shadow-2 p-3" >
                                <div class="card-item-header d-flex justify-content-between">
                                   <a href="{{route('site.explore.vendor.products', ['id'=>$item->options->vendorId])}}"> <span class="cart-item-category px-2" >
                                    {{$item->options->category}}
                                    </span></a>
                                    <div class="cart-items-options d-flex">
                                        <button class="btn btn-transparent">
                                            <img src="{{ asset('assets/site/img/icons/filter.png') }}" alt="">
                                        </button>
                                        <button class="btn btn-transparent">
                                            <img src="{{ asset('assets/site/img/icons/favorite_unactive.png') }}" alt="">
                                        </button>
                                        <form method="POST" action="{{route('cartremove')}}">
                                            @csrf
                                            <input type="hidden" name="rowId" value="{{$item->rowId}}">
                                            <button type="submit" class="close" style="border: none;outline: none;" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </form>
                                    </div>  
                                </div>
                                <div class="cart-item-content">
                                    <div class="d-flex flex-column justify-content-between">
                                        <div class="cart-item-price d-flex my-2">
                                            <span class="text-black font-black mr-4 font-14">€{{number_format($item->subtotal, 2, ',', '.')}}</span>
                                            
                                        </div> 
                                        <div class="cart-item-details d-flex justify-content-between">
                                            <div class="cart-item-desc-review align-self-end d-flex flex-column">
                                                <span class="text-black cart-item-tagline font-13 ">{{Str::limit($item->name, 10, '..')}}
                                                </span>
                                                <span class="text-grey cart-item-description font-13 ">{{Str::limit($item->options->description, 10, '..')}}
                                                </span>
                                                <div class="ratings">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                                            </div>
                                           <!-- buttonstyle style="background-color:#6C6C6C; color:white; font-size: 10px; font-weight:10px; border-bottom-left-radius:8px;border-top-left-radius:8px;"-->
                                            <div class="cart-item-img" style="margin-top: -30px; margin-right:-10px">
                                                <div class="cart-qty" style="margin-top: -12px;">
                                                    <div class="nice-number">
                                                        <div class="input-group d-flex mt-2 pr-2" >
                                                            <span class="input-group-btn">
                                                                <button id="minus-button-{{$item->id}}" 
                                                                    onclick="changeQuantityMinus({{$item->id}})" 
                                                                    type="button" class="btn mt-1 btn-sm btn-link text-black"   
                                                                    data-type="minus" data-field="quant">
                                                                    <span class="fa fa-minus"></span>
                                                                </button>
                                                            </span>
                                                                <input id="final-qty-{{$item->id}}" type="number" 
                                                                name="quant" class="input-number mt-1" size="1" 
                                                                style="height: 20px; width: 25px;text-align: center; border:none;" 
                                                                data-rowid="{{$item->rowId}}" value="{{$item->qty}}" 
                                                                min="1" max="100">
                                                                <span class="input-group-btn ">
                                                                <button 
                                                                    id="plus-button-{{$item->id}}" onclick="changeQuantityPlus({{$item->id}})" 
                                                                    type="button" class="btn mt-1 btn-sm btn-link text-black"  
                                                                    data-type="plus" data-field="quant">
                                                                    <span class="fa fa-plus" style="position: absolute;top: 8px;left: 63px;"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="{{ $item->options->image }}" alt="" class="pr-3 pt-2" style="float:right">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="col-12  col-md-12 col-lg-4">
            <h3 class="mt-3 mb-3">{{__('msg.total')}}</h3>
            <div class="cart-total d-flex flex-column justify-content-between p-3 shadow-1 ">
                <div class="top d-flex flex-column">
                    @foreach($items->unique('options.vendorId') as $item)
                        <div class="item justify-content-between mb-2 py-3 px-3">
                            <span class="text-black font-13 font-medium ">{{ $item->options->vendorName }}</span>                            
                            @php
                                $sum = 0;
                                foreach($items->where('options.vendorId', $item->options->vendorId) as $vendorItem){
                                    $sum += $vendorItem->subtotal;
                                }                                
                            @endphp
                            <span class="text-black font-13 font-medium" style="float: right;">€{{ number_format($sum, 2, ',', '.') }}</span>                            
                            <br>
                            @foreach($items->where('options.vendorId', $item->options->vendorId) as $item)
                                <span class="text-black font-13 font-medium">- {{$item->name}}</span><span class="text-black font-13 font-medium" style="float: right;"> ({{$item->qty}} x {{number_format($item->price, 2, ',', '.')}})</span><br>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="bottom mt-5 pt-5">
                    <div class="d-flex justify-content-between">
                        <span class="text-black font-13 font-medium">{{__('msg.total')}}:</span>
                        <span class="text-dark-grey font-13 font-medium">€{{ number_format(str_replace( ',', '', $cartTotal ), 2, ',', '.') }}</span>  
                    </div>
                </div>
                <div class="bottom mt-2 mb-2 text-center">
                @if(auth::check())
                <a href="{{route('site.checkout')}}" class="btn btn-black next-button w-100">{{__('msg.checkoutbtn')}}</a>
                @elseif(!auth::check())
                <button class="btn btn-black next-button w-100"  data-toggle="modal" data-target="#nologin" onclick="addToCart()">Checkout</button>
                <!-- <a href="#" class="btn btn-black next-button"  >Checkout</a> -->
                @endif                
                </div>
            </div>
        </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal productModal" id="nologin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content product-modal">
        <div class="modal-body ">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4 class="font-bold">{{__('msg.login')}}</h4>
                    <p class="text-grey font-14">{{__('msg.orcheck')}}</p>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12 mb-3">
                <button class="btn btn-green font-16 py-2 font-bold w-100"  data-dismiss="modal" onclick="loginModal()">{{__('msg.login')}}</button>
            </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12 mb-4">
                    <label for="" class="font-14 text-light-grey mb-0">{{__('msg.newhere')}}</label>
                    <a href="" class="link text-green font-bold d-block" data-dismiss="modal" onclick="signUpModal()">{{__('msg.createaccount')}}</a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('site.checkout')}}" class="btn btn-green text-white font-16 py-2 font-bold w-100">{{__('msg.checkout')}}</a>
                </div>
            </div>       
        </div>
      </div>
    </div>
</div>
<!--  Modal closed-->


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->    


<script>

function changeQuantityPlus(id)
{
// console.log($('#final-qty-'+id).attr('data-rowId'))
var x =$('#final-qty-'+id).val();
$('#final-qty-'+id).val();
var rowId = $('#final-qty-'+id).attr('data-rowId');
    $('#final-qty-'+id).val(++x);
 var quant= $('#final-qty-'+id).val();
 updateQuantity(rowId,quant)
}

function updateQuantity(rowId, quant)
{
    let route = `{{route('update-quantity')}}`
        $.ajax({
            url : route,
            type : "GET",
            datatype : "json",
            data : {
                rowId : rowId,
                quant : quant
            },
            success:function(result){
                // $('#final-qty-'+id).html(result.count);
                location.reload();

            }
        });
    
}


function changeQuantityMinus(id)
{
// console.log($('#final-qty-'+id).attr('data-rowId'))
var x =$('#final-qty-'+id).val();

$('#final-qty-'+id).val();
var rowId=$('#final-qty-'+id).attr('data-rowId');
var quantity = $('#final-qty-'+id).val();
if(quantity < 2)
{
    alert('Value must be greater then zero');
}
else{
    $('#final-qty-'+id).val(--x)
   var quant= $('#final-qty-'+id).val()
    updateQuantity(rowId,quant)
}


}

</script>
