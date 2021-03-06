@include('layout.partials._header')

<body class="no-trans">
	<!-- scrollToTop -->
	<!-- ================ -->
	<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

	<!-- header start -->
	<!-- ================ --> 
	<header class="header fixed clearfix navbar navbar-fixed-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">

					<!-- header-left start -->
					<!-- ================ -->
					<div class="header-left clearfix">
						<!-- name-and-slogan -->
						<div class="site-name-and-slogan smooth-scroll">
							<div class="site-name"><a href="#banner">St. Francis of Assisi and Sta. Quiteria Parish</a></div>
							<div class="site-slogan">Official Website</div>
						</div>

					</div>
					<!-- header-left end -->

				</div>
				<div class="col-md-6">

					<!-- header-right start -->
					<!-- ================ -->
					<div class="header-right clearfix">

						<!-- main-navigation start -->
						<!-- ================ -->
						<div class="main-navigation animated">

							<!-- navbar start -->
							<!-- ================ -->
							<nav class="navbar navbar-default" role="navigation">
								<div class="container-fluid">

									<!-- Toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>

									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse scrollspy smooth-scroll" id="navbar-collapse-1">
										<ul class="nav navbar-nav navbar-right">
											<li class="active"><a href="#banner">Home</a></li>
											<li><a href="#about">About</a></li>
											<li><a href="#services">Services</a></li>
											<li><a href="#contact">Contact</a></li>
											<li><a href="{{ URL::route('admin.signin')}}">Admin</a></li>
										</ul>
									</div>

								</div>
							</nav>
							<!-- navbar end -->

						</div>
						<!-- main-navigation end -->

					</div>
					<!-- header-right end -->

				</div>
			</div>
		</div>
	</header>
	<!-- header end -->

	@yield('content')

@include('layout.partials._footer')