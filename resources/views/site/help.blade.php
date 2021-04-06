@extends('layouts.site.app', [
])
@section('content')
<head>
	 <link rel="stylesheet" href="{{asset('assets/helppage/css/style.css')}}">
</head>
<section class="cd-faq js-cd-faq container max-width-md  margin-bottom-lg">
		<ul class="cd-faq__categories" style="font-size: 25px;">
			<li><a class="cd-faq__category  truncate" href="#users" style="color: #808080">{{__('msg.user')}}</a></li>
			<li><a class="cd-faq__category truncate" href="#vendors" style="color: #808080">{{__('msg.vendor')}}</a></li>
			<li><a class="cd-faq__category truncate" href="#drivers" style="color: #808080">{{__('msg.driver')}}</a></li>
		</ul> <!--cd-faq__categories -->
	<div class="cd-faq__items p-5">
		<ul id="users" class="cd-faq__group">
			<li class="cd-faq__title"><h2  style="font-size: 21px;">{{__('msg.forusers')}}</h2></li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.oneque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.oneans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.twoque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.twoans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>

			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.threeque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.threeans')}}<a href="www.thelastmile.shop">www.thelastmile.shop</a></p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>

			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.fourque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.fourans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.fiveque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.fiveans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.sixque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.sixans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.sevenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.sevenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.eightque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.eightans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.nineque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.nineans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.tenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.tenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.elevenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.fourque')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.fourque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.elevenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.fourque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.fourque')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.tweleveque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.tweleveans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.thirteenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.thirteenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.fourteenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.fourteenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.fiftheenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.fiftheenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.sixteenque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.sixteenans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
		</ul> <!-- cd-faq__group -->

		<ul id="vendors" class="cd-faq__group">
			<li class="cd-faq__title"><h2  style="font-size: 21px;">{{__('msg.forvendor')}}</h2></li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.vendoneque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.vendoneans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>

			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.vendtwoque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.vendtwoans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>

			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.vendthreeque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.vendthreeans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.step1')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.step1detail')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.step2')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.step2detail')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.step3')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.step3detail')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.step4')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.step4details')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.media')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.mediadetail')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>
		</ul> <!-- cd-faq__group -->

		<ul id="drivers" class="cd-faq__group">
			<li class="cd-faq__title"><h2  style="font-size: 21px;">{{__('msg.fordriver')}}</h2></li>
			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.driveroneque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.driveroneans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>

			<li class="cd-faq__item">
				<a class="cd-faq__trigger" href="#0"><span>{{__('msg.drivertwoque')}}</span></a>
				<div class="cd-faq__content">
          <div class="text-component">
            <p>{{__('msg.drivertwoans')}}</p>
          </div>
				</div> <!-- cd-faq__content -->
			</li>


		
		</ul> <!-- cd-faq__group -->

		 <!-- cd-faq__group -->
	</div> <!-- cd-faq__items -->

	<a href="#0" class="cd-faq__close-panel text-replace">Close</a>
  
  <div class="cd-faq__overlay" aria-hidden="true"></div>
</section>
@endsection
@stack('js')