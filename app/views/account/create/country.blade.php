@extends('layout.inner.master')

@section('breadcrumbs')
  {{ Breadcrumbs::render('manage-countries') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="row table-toolbar">
			<div class="col-lg-2">
				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group btn-group-sm">
						<a href="{{ URL::route('countries.export') }}" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export List</a>
					</div><!-- .btn-group -->
				</div><!-- .btn-toolbar -->
			</div>
			<div class="col-lg-4">
				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group btn-group-sm">
						<a href="{{ sort_countries_asc('country_name') }}" class="btn btn-default"><i class="fa fa-sort-alpha-asc"></i></a>
						<a href="{{ sort_countries_desc('country_name') }}" class="btn btn-default"><i class="fa fa-sort-alpha-desc"></i></a>
					</div><!-- .btn-group -->
				</div><!-- .btn-toolbar -->
			</div>
			<div class="col-lg-5 col-lg-offset-1">
				{{ Form::open(['method' => 'GET', 'route' => 'countries.index']) }}
			      <div class="input-group input-group-sm">
			         {{ Form::input('search', 'q', null, ['class' => 'form-control', 'placeholder' => 'Search']) }}
			          <span class="input-group-btn">
			            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Search</button>
			          </span>
			      </div><!-- /input-group -->
			    {{ Form::close() }}
			</div>
		</div><!-- .table-toolbar -->
		<div class="row">
			<div class="col-lg-2">
				<h5>Total Countries: <small>{{ $total_countries }}</small></h5>
			</div>
			<div class="col-lg-10">
				@if(isset($search))
					<h5>Search:  <mark>{{ $search }}</mark> <a href="{{ URL::route('countries.index') }}"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></a></h5>
				@endif
			</div>
		</div><!-- .row -->
		<br>
		<div class="row">
			<div class="col-lg-12">
				<ul>
					@foreach($countries as $country)
						<li><a href="{{ URL::route('countries.show', e($country->id)) }}">{{ e($country->country_name) }}</a> <a href="{{ URL::route('countries.destroy', e($country->id)) }}" class="pull-right"><i class="fa fa-close"></i></a></li>
					@endforeach
				</ul>
				{{ $countries->appends(Request::except('page'))->links(); }}
			</div>
		</div><!-- .row -->
	</div>
</div><!-- .row -->
<hr>
<div class="row">
	<div class="col-lg-12">
		<button class="btn btn-default btn-xs" href="#" id="add-country-btn"><i class="fa fa-plus"></i> Add a Country</button>
	</div>
</div><!-- .row -->
<br>
<div class="row" id="add-country-div">
	<div class="col-lg-8 col-lg-offset-2">
		{{ Form::open(['class' => 'form-horizontal', 'route' => ['countries.store']]) }}
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
									<input type="text" class="form-control" id="country_name" name="country_name"{{ (Input::old('country_name')) ? ' value ="' . Input::old('country_name') . '"' : '' }}>
									@if($errors->has('country_name'))
										<p class="bg-danger">{{ $errors->first('country_name') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
					<div class="row">
						<div class="col-lg-9 col-lg-offset-1">
							<div class="form-group">
								<label for="date_added" class="col-sm-3 control-label">Date Added</label>
								<div class="col-sm-9">
									<input type="date" class="form-control" id="date_added" name="date_added" value="{{ date('Y-m-d') }}" readonly>
									@if($errors->has('date_added'))
										<p class="bg-danger">{{ $errors->first('date_added') }}</p>
									@endif
								</div>
							</div><!-- .form-group -->
						</div>
					</div><!-- .row -->
				</div><!-- .panel-body -->
			</div><!-- .panel -->
			<div class="row pull-right">
				<div class="col-lg-12">
					<button type="button" class="btn btn-lg btn-default" id="cancel-add-btn" name="cancel-add-btn">Cancel</button>
					<button type="submit" class="btn btn-lg btn-primary" id="submit_form" name="submit_form">Submit</button>
				</div>
			</div><!-- .row -->
	    {{ Form::close() }}
	</div>
</div><!-- .row -->
@stop