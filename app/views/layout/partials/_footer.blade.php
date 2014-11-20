	<!-- footer start -->
		<!-- ================ -->
		<footer id="footer">

			@yield('footer-extra')
			<!-- .subfooter start -->
			<!-- ================ -->
			<div class="subfooter">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="text-center">Copyright © 2014 Worthy by <a target="_blank" href="http://htmlcoder.me">HtmlCoder</a>.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- .subfooter end -->

		</footer>
		<!-- footer end -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
   data-keyboard="false">
  <div class="modal-dialog">
  	@yield('modal-content')
  </div>
</div><!-- .modal -->
	
	{{ HTML::script('https://code.jquery.com/jquery-1.10.2.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/liquidmetal.js') }}
	{{ HTML::script('js/jquery.flexselect.js') }}


	{{ HTML::script('js/plugins/modernizr.js') }} <!-- Modernizr javascript -->
	{{ HTML::script('js/plugins/isotope/isotope.pkgd.min.js') }} <!-- Isotope javascript -->
	{{ HTML::script('js/plugins/jquery.backstretch.min.js') }} <!-- Backstretch javascript -->
	{{ HTML::script('js/plugins/jquery.appear.js') }} <!-- Appear javascript -->
	{{ HTML::script('js/template.js') }} <!-- Initialization of Plugins -->

	{{ HTML::script('js/custom.js') }}
</body>
</html>