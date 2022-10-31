<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('page-title')</title>
	<meta content="Protected page" property="og:title" />
	<meta content="Protected page" property="twitter:title" />
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	@yield('head-extra')
	<script type="text/javascript">
	! function(o, c) {
		var n = c.documentElement,
			t = " w-mod-";
		n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
	}(window, document);
	</script>
	<link href="{{asset('assets/favicon.png')}}" rel="shortcut icon" type="image/x-icon" />
	<link href="{{asset('assets/favicon.png')}}" rel="apple-touch-icon" />
	<style>
	* {
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/feather-icons"></script>
</head>

<body style="background: #f7f7f7; overflow-x:hidden;">
	<div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar-3 sticky w-nav">
		<div class="w-container">
			<a href="#" class="w-nav-brand"><img src="{{asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png')}}" loading="lazy" width="80" alt="" /></a>
			<div class="menu-button w-nav-button">
				<div data-w-id="a94f6aff-cf03-9ce6-7aab-1fe8609b45f0" class="d-117-menu-trigger-wrapper">
					<div data-w-id="a94f6aff-cf03-9ce6-7aab-1fe8609b45f1" class="d-117-line-wrapper">
						<div data-w-id="a94f6aff-cf03-9ce6-7aab-1fe8609b45f2" class="d-117-first-line"></div>
					</div>
					<div data-w-id="a94f6aff-cf03-9ce6-7aab-1fe8609b45f3" class="d-117-line-wrapper">
						<div data-w-id="a94f6aff-cf03-9ce6-7aab-1fe8609b45f4" class="d-117-second-line"></div>
					</div>
				</div>
			</div>
			<nav role="navigation" class="dropdown-nav padding-small w-nav-menu">
				<div class="form-block w-form">
					<form id="email-form" name="email-form" data-name="Email Form" method="get" autocomplete="off" class="form">
						<div class="input">
							<div class="input__reset"></div>
							<div class="input__field-wrapper">
								<input type="text" class="input__field-copy w-input" maxlength="256" name="Search-2" data-name="Search 2" placeholder="Search" id="Search-2" />
								<div class="input__suggestions">
									<div class="input__suggestions-wrapper">
										<div class="suggestion">&quot;woodworking&quot;</div>
										<div class="suggestion">&quot;houseplants&quot;</div>
										<div class="suggestion">&quot;skateboarding&quot;</div>
										<div class="suggestion">&quot;fashion&quot;</div>
										<div class="suggestion">&quot;woodworking&quot;</div>
									</div>
								</div>
								<div class="input__icon w-embed">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.677 19.607L12.962 13.891C10.4196 15.6985 6.91642 15.2564 4.90285 12.8739C2.88929 10.4915 3.03714 6.96361 5.24298 4.75802C7.44824 2.55147 10.9765 2.40298 13.3594 4.41644C15.7422 6.42989 16.1846 9.93347 14.377 12.476L20.092 18.192L18.678 19.606L18.677 19.607ZM9.48498 5.00001C7.58868 4.99958 5.95267 6.3307 5.56745 8.18745C5.18224 10.0442 6.15369 11.9163 7.89366 12.6703C9.63362 13.4242 11.6639 12.8529 12.7552 11.3021C13.8466 9.75129 13.699 7.64734 12.402 6.26402L13.007 6.86402L12.325 6.18402L12.313 6.17202C11.5648 5.4192 10.5464 4.99715 9.48498 5.00001Z" fill="currentColor"></path>
									</svg>
								</div>
							</div>
						</div>
					</form>
					<div class="w-form-done"></div>
					<div class="w-form-fail"></div>
				</div><a href="#" class="text-color-grey w-nav-link">Home</a>
				<div class="div-line-orange"></div><a href="{{ route('home') }}" class="text-color-grey w-nav-link">Products</a>
				<div class="div-line-orange"></div><a href="#" class="text-color-grey w-nav-link">Shop</a>
				<div class="div-line-orange"></div><a href="#" class="text-color-grey w-nav-link">About</a>
				@auth
					<div class="div-line-orange"></div>
					<a class="text-color-grey w-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i></a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				@endauth
				<div class="div-block-22">
					<a href="{{ route('user.cart.index') }}" class="btn d-flex justify-content-center align-items-center flex-shrink-0 p-0 mr-2" style="background: transparent; padding: 10px 10px 10px 0;">
						<img src="{{asset('assets/6303b31a096350fad278d3bb_cart.svg')}}" loading="lazy" alt="" />
					</a>
					<img src="{{asset('assets/630193c64ebe686851463727_profile-002.jpg')}}" loading="lazy" width="40" alt="" class="image-13" />
				</div>
			</nav>
		</div>
	</div>
	
    @yield('content')
	
    <div class="footer overflow-hidden relative ea-up"><img src="{{asset('assets/6303a4ccee19b64624bf8501_HDB Building.svg')}}" loading="lazy" alt="" class="image-12" />
		<div class="footer-top text-color-white relative ea-right">
			<div class="ea-left"><img src="{{asset('assets/62fc7f3f35498aa012756c07_Big%20V-BW%20(Reverse)%201.png')}}" loading="lazy" alt="" /></div>
			<div class="align-vertical">
				<h3 class="heading-5">Enjoy <span class="text-color-dark-grey">200+</span> foods from<br/>‍<span class="text-color-dark-grey">30+</span> Vendors</h3></div>
			<div class="flex align-vertical">
				<div class="flex flex-vertical left-align margin-small">
					<h4>Contact Us</h4>
					<a href="#" class="text-color-white text-style-link">Instagram</a>
					<a href="#" class="text-color-white text-style-link">Facebook</a>
					<a href="#" class="text-color-white text-style-link">Tiktok</a>
					<a href="#" class="text-color-white text-style-link">Whatsapp</a>
				</div>
				<div class="flex flex-vertical left-align margin-small">
					<h4>Company</h4><a href="#" class="text-color-white text-style-link">Become a Vendor</a><a href="#" class="text-color-white text-style-link">About Us</a><a href="#" class="text-color-white text-style-link">Terms &amp; Conditions</a><a href="#" class="text-color-white text-style-link">Privacy Policy</a></div>
			</div>
		</div>
		<div class="footer-mid padding-small relative">
			<a href="#" class="text-color-white text-style-link"><img src="{{asset('assets/62fc7f3f35498a656c756c0c_Vector-4.svg')}}" loading="lazy" alt="" /></a>
			<a href="#" class="text-color-white text-style-link"><img src="{{asset('assets/62fc7f3f35498ad2a7756c0a_Vector-1.svg')}}" loading="lazy" alt="" /></a>
			<a href="#" class="text-color-white text-style-link"><img src="{{asset('assets/62fc7f3f35498a35b1756c0d_Vector.svg')}}" loading="lazy" alt="" /></a>
			<a href="#" class="text-color-white text-style-link"><img src="{{asset('assets/62fc7f3f35498a83cc756c0b_Vector-3.svg')}}" loading="lazy" alt="" /></a>
			<a href="#" class="text-color-white text-style-link"><img src="{{asset('assets/62fc7f3f35498ab948756c09_Vector-2.svg')}}" loading="lazy" alt="" /></a>
		</div>
		<div class="footer-bottom background-color-grey text-align-center text-color-white padding-xsmall relative">
			<div>©2022 <span class="text-color-orange">Big V</span> | All Rights Reserved</div>
		</div>
	</div>
	<script>
		feather.replace();

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var hostname = "{{ request()->getHost() }}";
		var url = "{{ config('app.url') }}";
		if (hostname.includes('www')) {
			url = "https://" + hostname
		} else if (hostname.includes('localhost')) {
			url += ":8000";
		}
		// console.log(url);
	</script>
	@yield('javascript-extra')
</body>
</html>