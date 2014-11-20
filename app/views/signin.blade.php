@extends('layout.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h1 class="text-center login-header">Church Registration</h1>
			<div class="row">
				<div class="col-lg-4 col-lg-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">Login as website admin</div>
						<div class="panel-body">
							{{ Form::open(['role' => 'form', 'route' => 'sessions.store']) }}
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username"{{ (Input::old('username')) ? ' value ="' . Input::old('username') . '"' : ''}}  required="required">
									@if($errors->has('username'))
										<p class="text-danger">{{ $errors->first('username') }}</p>
									@endif
								</div><!-- form-group -->
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
									@if($errors->has('password'))
										<p class="text-danger">{{ $errors->first('password') }}</p>
									@endif
								</div><!-- form-group -->
								<div class="form-group">
							      <div class="checkbox">
							        <label for="remember" class="home-label">
							          <input type="checkbox" name="remember" id="remember"> Remember me
							        </label>
							      </div>
								 </div><!-- form-group -->
								<button type="submit" class="btn btn-primary">Log in</button>
								{{ Form::token() }}
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop