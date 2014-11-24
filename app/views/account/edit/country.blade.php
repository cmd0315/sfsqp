@extends('layout.inner.master')

@section('breadcrumbs')
  {{ Breadcrumbs::render('country-profile', e($country->id)) }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label for="country_name" class="col-sm-3 control-label">Country Name:</label>
					<div class="col-sm-9">
						{{ e($country->country_name) }}
					</div>
				</div><!-- .form-group -->
			</div><!-- .row -->
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label for="country_name" class="col-sm-3 control-label">Date Created:</label>
					<div class="col-sm-9">
						{{ date('Y-m-d', strtotime(e($country->created_at))) }}
					</div>
				</div><!-- .form-group -->
			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label for="country_name" class="col-sm-3 control-label">Last Updated At:</label>
					<div class="col-sm-9">
						{{ e($country->updated_at_formatted) }}
					</div>
				</div><!-- .form-group -->
			</div>
		</div><!-- .row -->
	</div>
	<div class="col-lg-4">
		<button type="button" class="btn btn-default pull-right btn-delete" id="{{ e($country->country_name) }}" value="{{ URL::route('countries.destroy', e($country->id)) }}"><i class="fa fa-trash"></i> Remove</button>
	</div>
</div><!-- .row -->
<hr>
<div class="row">
	<div class="col-lg-12">
		<button class="btn btn-default btn-xs" href="#" id="edit-country-btn"><i class="fa fa-edit"></i> Edit Country</button>
	</div>
</div><!-- .row -->
<br>
<div class="row" id="edit-country-div">
	<div class="col-lg-8 col-lg-offset-2">
		{{ Form::open(['class' => 'form-horizontal', 'route' => ['countries.update', e($country->id)], 'method' => 'PATCH']) }}
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Basic</h4>
				</div><!-- .panel-heading -->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-9 col-lg-offset-1">
							<div class="form-group">
								<label for="country_name" class="col-sm-4 control-label">Country Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="country_name" name="country_name" value="{{ e($country->country_name) }}">
									@if($errors->has('country_name'))
										<p class="bg-danger">{{ $errors->first('country_name') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
				</div><!-- .panel-body -->
			</div><!-- .panel -->
			<div class="row pull-right">
				<div class="col-lg-12">
					<button type="button" class="btn btn-lg btn-default" id="cancel-edit-btn" name="cancel-add-btn">Cancel</button>
					<button type="submit" class="btn btn-lg btn-primary" id="submit_form" name="submit_form">Submit</button>
				</div>
			</div><!-- .row -->
	    {{ Form::close() }}
	</div>
</div><!-- .row -->
@stop

@section('modal-content')
<div class="modal-content">
	{{ Form::open(['id' => 'modal-form', 'route' => ['countries.destroy'], 'method' => 'DELETE']) }}
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Remove Country</h4>
		</div>
		<div class="modal-body">
			Are you sure you want to remove <span id="subject-name"></span> to the list of countries?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			{{ Form::submit('OK', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
</div><!-- .modal-content -->
@stop