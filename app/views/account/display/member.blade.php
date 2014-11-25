@extends('layout.inner.master')

@section('breadcrumbs')
  {{ Breadcrumbs::render('member-profile', e($member->id)) }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Basic</h4>
					</div><!-- .panel-heading -->
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label">Name:</label>
										<div class="col-sm-9">
											{{ e($member->full_name) }}
										</div>
									</div><!-- .form-group -->
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label">Address:</label>
										<div class="col-sm-9">
											{{ e($member->address) }}
										</div>
									</div><!-- .form-group -->
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label">Birthdate:</label>
										<div class="col-sm-9">
											{{ date('M-d-Y', strtotime(e($member->birthdate))) }}
										</div>
									</div><!-- .form-group -->
								</div>
							</div>
							<div class="col-lg-4">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-4 control-label">Status:</label>
										<div class="col-sm-8">
											{{ e($member->status) }}
										</div>
									</div><!-- .form-group -->
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-4 control-label">Gender:</label>
										<div class="col-sm-8">
											{{ e($member->gender_formatted) }}
										</div>
									</div><!-- .form-group -->
								</div>
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
							<div class="col-lg-6">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-4 control-label">Email:</label>
										<div class="col-sm-8">
											{{ e($member->email) }}
										</div>
									</div><!-- .form-group -->
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-4 control-label">Mobile:</label>
										<div class="col-sm-8">
											{{ e($member->mobile) }}
										</div>
									</div><!-- .form-group -->
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-4 control-label">Telephone:</label>
										<div class="col-sm-8">
											{{ e($member->telephone) }}
										</div>
									</div><!-- .form-group -->
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-sm-4 control-label">Facebook Account:</label>
										<div class="col-sm-8">
											<a href="{{ e($member->fb) }}">{{ e($member->fb) }}</a>
										</div>
									</div><!-- .form-group -->
								</div>
							</div>
						</div><!-- .row -->
					</div><!-- .panel-body -->
				</div><!-- .panel -->
			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="pull-right">
					@if($member->isDeleted())
						<a href="{{ URL::route('members.restore', e($member->id)) }}" class="btn btn-default">
							<i class="fa fa-archive"></i> Restore
						</a>
					@else		
						<button type="button" class="btn btn-default btn-delete" id="{{ e($member->full_name) }}" value="{{ URL::route('members.destroy', e($member->id)) }}">
							<i class="fa fa-trash"></i> Remove
						</button>
					@endif
					<a href="{{ URL::route('members.edit', e($member->id)) }}" class="btn btn-lg btn-primary">Edit</a>
				</div>
			</div>
		</div>
	</div>
</div><!-- .row -->
@stop

@section('modal-content')
<div class="modal-content">
	{{ Form::open(['id' => 'modal-form', 'route' => ['members.destroy'], 'method' => 'DELETE']) }}
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Remove Member</h4>
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