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
				                            <a href="{{ URL::route('accounts.edit', $currentUser->id) }}"><li class="list-group-item">Change Password</li></a>
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
				                            <a href="{{ URL::route('members.create') }}"><li class="list-group-item">Add Member</li></a>
				                            <a href="{{ URL::route('members.index') }}"><li class="list-group-item">Manage Member List</li></a>
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
				                            <li class="list-group-item">Add Country</li>
				                            <li class="list-group-item">Manage Country List</li>
				                            <li class="list-group-item">Add City/Province</li>
				                            <li class="list-group-item">Manage City/Province List</li>
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
