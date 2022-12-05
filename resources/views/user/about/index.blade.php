@extends('user.template.layout')

@section('page-title')
    About Us - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-about.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">
        <section class="hero-heading-center wf-section">
        	<div class="container-11">
        		<h1 class="centered-heading margin-bottom-32px orange-text">About BigV</h1>
        		<div class="hero-wrapper-2">
        			<div class="hero-split-2">
        				<p class="margin-bottom-24px-2">BigV is a start-up for homebased business, focusing on promoting and selling homebased businesses of all kinds, including F&amp;B, service, product and educational events such as online enrichment programme and webinars.
        					<br>
        				</p>
        			</div>
        			<div class="hero-split-2"><img src="{{ asset('assets/633f7db809c5ff224b96427e_image%2081.webp')}}" loading="lazy" sizes="(max-width: 479px) 94vw, (max-width: 767px) 96vw, (max-width: 991px) 92vw, (max-width: 1439px) 46vw, 538.984375px" srcset="{{ asset('assets/633f7db809c5ff224b96427e_image%2081.webp')}}" alt="" class="shadow-two-2"></div>
        		</div>
        	</div>
        </section>
        <section class="testimonial-slider-small wf-section">
        	<div class="container-11">
        		<h2 class="centered-heading orange-text">3 V Approach</h2>
        		<p class="centered-subheading">BigV works on a 3 V approach. Big Vision, Big Venture, and Big Value.</p>
        		<div class="vision-mission-div">
        			<div class="testimonial-card-2">
        				<h3 class="testimonial-author">Mission</h3>
        				<p>1. Focusing on featuring Home Based Businesses.
        					<br>
        					<br>2. Creating a marketplace for organic community growth.
        					<br>
        					<br>3. Nurture and provide holistic marketing services for Home Based Businesses.
        					<br>
        					<br>4. Create a unique, sales and marketing driven, and consumer eccentric online marketplace.
        					<br>
        				</p>
        			</div>
        			<div class="testimonial-card-2">
        				<h3 class="testimonial-author">Vision</h3>
        				<p>1. To be the No.1 Home Based Business online marketplace in the region.
        					<br>
        					<br>2. Building quality and international acclaimed local brands.
        					<br>
        					<br>3. Curating unique HBB pop up events.
        					<br>
        					<br>4. Build central kitchen for mass productions.
        					<br>
        					<br>5. Curate and achieve product visibility at major supermarkets under BigV branding.</p>
        			</div>
        		</div>
        	</div>
        </section>
        <section class="team-circles wf-section">
        	<div class="container-11">
        		<h2 class="centered-heading orange-text">The Team</h2>
        		<p class="centered-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tincidunt sagittis eros. Quisque quis euismod lorem.</p>
        		<div class="team-grid-2">
        			<div id="w-node-ed1af603-cba9-a489-202b-d35cca6aac80-48a9ac08" class="team-card"><img src="{{ asset('assets/638c81fa95fb43adbf40a25a_278385831_513021147080208_3041277267152842079_n.jpg')}}" loading="lazy" alt="" class="team-member-image">
        				<div class="team-member-name">VINCENT CHONG</div>
        				<div class="team-member-position">Managing Director</div>
        				<p>Mr Vincent is a successful Events Director with over 20 years of experience in fast-paced, bringing very strong organizational skills. &nbsp;
        					<br>
        					<br>Driven and dedicated to building a brand with growth strategies that deliver results.
        					<br>
        				</p>
        			</div>
        			<div id="w-node-ed1af603-cba9-a489-202b-d35cca6aac8b-48a9ac08" class="team-card"><img src="{{ asset('assets/638c828dcb0ed00ca3a0a51e_1646013771735.jpeg')}}" loading="lazy" sizes="(max-width: 479px) 100vw, (max-width: 991px) 190px, (max-width: 1439px) 27vw, 270px" srcset="{{ asset('assets/638c828dcb0ed00ca3a0a51e_1646013771735.jpeg')}}" alt="" class="team-member-image">
        				<div class="team-member-name">MOHAMED MUZAMMIL</div>
        				<div class="team-member-position">Business Consultant</div>
        				<p>Mr Muz is a Seasoned Sales and Consultancy with more than 10 years experience. He have a wealthy amount of experience in the Banking and Consultancy industry with Robert Walters, Citibank Singapore and Malayan Bank Berhad.
        					<br>
        					<br>He has achieved several awards as Top Consultant in 2018 and Relationship Manager in 2014 to 2016.
        					<br>
        					<br>
        				</p>
        			</div>
        			<div id="w-node-e46f252b-f3f6-43ef-0411-af84f13fbb12-48a9ac08" class="team-card"><img src="{{ asset('assets/638c831f5fd2fd3e87a27eab_unnamed.jpg')}}" loading="lazy" sizes="(max-width: 479px) 100vw, (max-width: 991px) 190px, (max-width: 1439px) 27vw, 270px" srcset="{{ asset('assets/638c831f5fd2fd3e87a27eab_unnamed.jpg')}}" alt="" class="team-member-image">
        				<div class="team-member-name">VINCENT ONG</div>
        				<div class="team-member-position">Marketing &amp; Sponsorship Senior Manager</div>
        				<p>Mr Vincent Ong has 15 years of experienced in Project Management and travel retail across APAC.
        					<br>
        					<br>Mr Vincent clientele covers from world leading luxury beauty to liquor brands such as Gucci , Moet Hennessy and many more. He has strong regional network and have lead multiple teams on and off shore.
        					<br>
        				</p>
        			</div>
        		</div>
        	</div>
        </section>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-cart-checkout.js') }}" type="text/javascript"></script>
@endsection
