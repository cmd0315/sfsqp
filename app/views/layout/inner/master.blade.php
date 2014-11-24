@include('layout.partials._header')
	<body>
		<div id="wrapper">
			@include('layout.inner._navigation')
			<div id="page-wrapper">
				<div class="container-fluid">
				    @include('flash::message')
				    <div class="row">
				    	<div class="col-lg-2">
				    		 <!-- Page Heading -->
						    <div class="row">
						        <div class="col-lg-12">
						            <h3 class="page-header">
						                Menu
						            </h3>
						        </div>
						    </div> <!-- /.row -->
				            <div class="panel-group" id="accordion">
				                <div class="panel panel-primary">
				                    <div class="panel-heading">
				                        <h4 class="panel-title">
				                            Account
				                        </h4>
				                    </div>
				                    <div class="panel-body">
				                        <ul class="list-group">
				                            <li class="list-group-item"><a href="{{ URL::route('accounts.edit', $currentUser->id) }}">Change Password</a></li>
				                        </ul>
				                    </div>
				                </div> <!-- .panel -->
				                <div class="panel panel-primary">
				                    <div class="panel-heading">
				                        <h4 class="panel-title">
				                            Members
				                        </h4>
				                    </div>
				                    <div class="panel-body">
				                        <ul class="list-group">
				                            <li class="list-group-item"><a href="{{ URL::route('members.create') }}">Add Member</a></li>
				                            <li class="list-group-item"> <a href="{{ URL::route('members.index') }}">Manage Member List</a></li>
				                        </ul>
				                    </div>
				                </div> <!-- .panel -->
				                <div class="panel panel-primary">
				                    <div class="panel-heading">
				                        <h4 class="panel-title">
				                            Locations
				                        </h4>
				                    </div>
				                    <div class="panel-body">
				                        <ul class="list-group">
				                            <li class="list-group-item"><a href="{{ URL::route('countries.index') }}">List of Countries</a></li>
				                            <li class="list-group-item"><a href="{{ URL::route('locations.index') }}">List of Cities/Provinces</a></li>
				                        </ul>
				                    </div>
				                </div> <!-- .panel -->
				            </div><!-- .panel-group -->
				        </div>
				        <div class="col-lg-10">
						    <!-- Page Heading -->
						    <div class="row">
						        <div class="col-lg-12">
						            <h1 class="page-header">
						                {{ isset($pageTitle) ? $pageTitle : ''}}
						            </h1>
						        </div>
						    </div> <!-- /.row -->
						    @yield('breadcrumbs')
							@yield('content')
				        </div>
				    </div><!-- .row -->
				</div> <!-- /.container-fluid -->
			</div> <!-- #page-wrapper -->
		</div><!-- #wrapper -->
@include('layout.partials._footer')
