@extends('layout.inner.master')

@section('breadcrumbs')
  {{ Breadcrumbs::render('edit-member-profile', e($member->id)) }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				{{ Form::open(['class' => 'form-horizontal', 'route' => ['members.update', e($member->id)], 'method' => 'PATCH']) }}
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
											<input type="text" class="form-control" id="first_name" name="first_name" value="{{ e($member->first_name) }}">
											@if($errors->has('first_name'))
												<p class="bg-danger">{{ $errors->first('first_name') }}</p>
											@endif
										</div>
									</div>
								</div><!-- .form-group -->
								<div class="col-lg-4">
									<div class="form-group">
										<label for="middle_name" class="col-sm-4 control-label">Middle Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ e($member->middle_name) }}">
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
											<input type="text" class="form-control" id="last_name" name="last_name" value="{{ e($member->last_name)}}">
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
											<input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ e($member->birthdate) }}">
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
												@if(e($member->gender) === 'M')
													<input type="radio" name="gender" id="gender1" value="M" checked> Male
												@else
													<input type="radio" name="gender" id="gender1" value="M"> Male
												@endif
											</label>
											<label class="radio-inline">
												@if(e($member->gender) === 'F')
													<input type="radio" name="gender" id="gender2" value="F" checked> Female
												@else
													<input type="radio" name="gender" id="gender2" value="F"> Female
												@endif
											</label>
											@if($errors->has('gender'))
												<p class="bg-danger">{{ $errors->first('gender') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="civil_status" class="col-sm-5 control-label">Civil Status</label>
										<div class="col-sm-7">
											<select class="form-control" name="civil_status" id="civil_status">
												@foreach($civil_status_options as $civil_status_option)
													@if($civil_status_option === e($member->civil_status))
														<option value="{{$civil_status_option}}" selected>{{$civil_status_option}}</option>
													@else
														<option value="{{$civil_status_option}}">{{$civil_status_option}}</option>
													@endif
												@endforeach
											</select>
											@if($errors->has('civil_status'))
												<p class="bg-danger">{{ $errors->first('civil_status') }}</p>
											@endif
										</div>
									</div>
								</div>
							</div><!-- .row -->
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="country_id" class="col-sm-4 control-label">Country</label>
										<div class="col-sm-8">
											<select class="form-control" name="country_id" id="country_id">
												@foreach($country_options as $key => $country_option)
													@if($key == e($member->country_id))
														<option value="{{$key}}" selected>{{$country_option}}</option>
													@else
														<option value="{{$key}}">{{$country_option}}</option>
													@endif
												@endforeach
											</select>
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
											<input type="text" class="form-control" id="street_address" name="street_address" value="{{ e($member->street_address) }}">
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
											<select class="form-control flexselect" name="location_id" id="location_id">
												@foreach($locations as $location)
													@if($location->id === e($member->location_id))
														<option value="{{ e($location->id) }}" selected> {{ e($location->city_province_address) }}</option>
													@else
														<option value="{{ e($location->id) }}"> {{ e($location->city_province_address) }}</option>
													@endif
												@endforeach
											</select>
											@if($errors->has('location_id'))
												<p class="bg-danger">{{ $errors->first('location_id') }}</p>
											@endif
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
											<input type="email" class="form-control" id="email" name="email" value="{{ e($member->email) }}">
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
											<input type="text" class="form-control" id="mobile" name="mobile" value="{{ e($member->mobile) }}">
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
											<input type="text" class="form-control" id="telephone" name="telephone" value="{{ e($member->telephone) }}">
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
											<input type="text" class="form-control" id="fb" name="fb" value="{{ e($member->fb) }}">
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
	</div>
</div><!-- .row -->
@stop