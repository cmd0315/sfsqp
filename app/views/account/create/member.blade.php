@extends('layout.inner.master')

@section('breadcrumbs')
  {{ Breadcrumbs::render('add-member') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		{{ Form::open(['class' => 'form-horizontal', 'route' => ['members.store']]) }}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Basic</h4>
				</div><!-- .panel-heading -->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="first_name" class="col-sm-4 control-label">First Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="first_name" name="first_name"{{ (Input::old('first_name')) ? ' value ="' . Input::old('first_name') . '"' : '' }}>
									@if($errors->has('first_name'))
										<p class="bg-danger">{{ $errors->first('first_name') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="middle_name" class="col-sm-4 control-label">Middle Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="middle_name" name="middle_name"{{ (Input::old('middle_name')) ? ' value ="' . Input::old('middle_name') . '"' : '' }}>
									@if($errors->has('middle_name'))
										<p class="bg-danger">{{ $errors->first('middle_name') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="last_name" class="col-sm-4 control-label">Last Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="last_name" name="last_name"{{ (Input::old('last_name')) ? ' value ="' . Input::old('last_name') . '"' : '' }}>
									@if($errors->has('last_name'))
										<p class="bg-danger">{{ $errors->first('last_name') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group">
								<label for="birthdate" class="col-sm-3 control-label">Birthdate</label>
								<div class="col-sm-9">
									<input type="date" class="form-control" id="birthdate" name="birthdate"{{ (Input::old('birthdate')) ? ' value ="' . date('Y-m-d',strtotime(Input::old('birthdate'))) . '"' : '' }}>
									@if($errors->has('birthdate'))
										<p class="bg-danger">{{ $errors->first('birthdate') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="gender" class="col-sm-3 control-label">Gender</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="gender" id="gender1" value="M"> Male
									</label>
									<label class="radio-inline">
										<input type="radio" name="gender" id="gender2" value="F"> Female
									</label>
									@if($errors->has('gender'))
										<p class="bg-danger">{{ $errors->first('gender') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="civil_status" class="col-sm-5 control-label">Civil Status</label>
								<div class="col-sm-7">
									{{ Form::select('civil_status', $civil_status_options, Input::old('civil_status'), ['class' => 'form-control']) }}
									@if($errors->has('civil_status'))
										<p class="bg-danger">{{ $errors->first('civil_status') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="country_id" class="col-sm-4 control-label">Country</label>
								<div class="col-sm-8">
									{{ Form::select('country_id', $countries, Input::old('country_id'), ['id' => 'country_id', 'class' => 'form-control']) }}
									@if($errors->has('country_id'))
										<p class="bg-danger">{{ $errors->first('country_id') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="street_address" class="col-sm-4 control-label">Street Address</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="street_address" name="street_address"{{ (Input::old('street_address')) ? ' value ="' . Input::old('street_address') . '"' : '' }}>
									@if($errors->has('street_address'))
										<p class="bg-danger">{{ $errors->first('street_address') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label for="location_id" class="col-sm-4 control-label">City and Province</label>
								<div class="col-sm-8">
									<div id="location1-div">
										{{ Form::select('location_id', ['default' => ''] + $locations, Input::old('location_id'), ['class' => 'flexselect form-control']) }}
										@if($errors->has('location_id'))
											<p class="bg-danger">{{ $errors->first('location_id') }}</p>
										@endif
									</div><!-- #location-div -->
									<div id="location2-div" style="display:none;">
										<input type="text" class="form-control" id="other_location" name="other_location"{{ (Input::old('other_location')) ? ' value ="' . Input::old('other_location') . '"' : '' }}>
										@if($errors->has('other_location'))
											<p class="bg-danger">{{ $errors->first('other_location') }}</p>
										@endif
									</div><!-- #location2-div -->
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
				</div><!-- .panel-body -->
			</div><!-- .panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Contact Details</h4>
				</div><!-- .panel-heading -->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="email" class="col-sm-4 control-label">Email</label>
								<div class="col-sm-8">
									<input type="email" class="form-control" id="email" name="email"{{ (Input::old('email')) ? ' value ="' . Input::old('email') . '"' : '' }}>
									@if($errors->has('email'))
										<p class="bg-danger">{{ $errors->first('email') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="mobile" class="col-sm-4 control-label">Mobile Number</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mobile" name="mobile"{{ (Input::old('mobile')) ? ' value ="' . Input::old('mobile') . '"' : '' }}>
									@if($errors->has('mobile'))
										<p class="bg-danger">{{ $errors->first('mobile') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="telephone" class="col-sm-5 control-label">Telephone Number</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="telephone" name="telephone"{{ (Input::old('telephone')) ? ' value ="' . Input::old('mobile') . '"' : '' }}>
									@if($errors->has('telephone'))
										<p class="bg-danger">{{ $errors->first('telephone') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="fb" class="col-sm-4 control-label">Facebook Account</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="fb" name="fb"{{ (Input::old('fb')) ? ' value ="' . Input::old('fb') . '"' : '' }}>
									@if($errors->has('fb'))
										<p class="bg-danger">{{ $errors->first('fb') }}</p>
									@endif
								</div>
								
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
				</div><!-- .panel-body -->
			</div><!-- .panel -->
			<div class="row pull-right">
				<div class="col-lg-12">
					<button type="submit" class="btn btn-lg btn-primary" id="submit_form" name="submit_form">Submit</button>
				</div>
			</div><!-- .row -->
	    {{ Form::close() }}
	</div>
</div><!-- .row -->
@stop