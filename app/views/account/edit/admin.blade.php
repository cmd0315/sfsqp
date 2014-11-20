@extends('layout.inner.master')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				{{ Form::open(['class' => 'form-horizontal', 'route' => ['accounts.update', e($admin->id)], 'method' => 'PATCH']) }}
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Account Information</h4>
						</div><!-- .panel-title -->
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="old_password" class="col-sm-3 control-label">Old Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" id="old_password" name="old_password">
											@if($errors->has('old_password'))
												<p class="bg-danger">{{ $errors->first('old_password') }}</p>
											@endif
										</div>
									</div><!-- .form-group -->
								<div class="form-group">
									<label for="new_password" class="col-sm-3 control-label">New Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" id="new_password" name="new_password">
										@if($errors->has('new_password'))
											<p class="bg-danger">{{ $errors->first('new_password') }}</p>
										@endif
									</div>
								</div><!-- .form-group -->
								<div class="form-group">
								<label for="retype_new_password" class="col-sm-3 control-label">Retype New Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" id="retype_new_password" name="retype_new_password">
										@if($errors->has('retype_new_password'))
											<p class="bg-danger">{{ $errors->first('retype_new_password') }}</p>
										@endif
									</div>
								</div><!-- .form-group -->
							</div>
						</div><!-- .row -->
						</div><!-- .panel-body -->
					</div><!-- .panel -->
					<div class="pull-right">
						<button type="submit" class="btn btn-lg btn-primary">Submit</button>
					</div>
				{{ Form::close() }}
			</div>
		</div><!-- .row -->
	</div>
</div><!-- .row -->
@stop