@extends('layout.inner.master')

@section('breadcrumbs')
  {{ Breadcrumbs::render('manage-members') }}
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="row table-toolbar">
					<div class="col-lg-7">
						<div class="btn-toolbar" role="toolbar">
							<div class="btn-group btn-group-sm">
								<a href="{{ URL::route('members.create') }}" class="btn btn-default">Add Member</a>
								<a href="{{ URL::route('members.export') }}" class="btn btn-default">Export List</a>
		  						<a class="btn btn-default" id="remove-btn" name="remove-btn">Remove Member</a>
		  						<a class="btn btn-default cancel-btn" id="cancel-btn1" name="cancel-btn1">Cancel Remove</a>
							</div><!-- .btn-group -->
						</div><!-- .btn-toolbar -->
					</div>
					<div class="col-lg-5">
						{{ Form::open(['method' => 'GET', 'route' => 'members.index']) }}
					      <div class="input-group input-group-sm">
					         {{ Form::input('search', 'q', null, ['class' => 'form-control', 'placeholder' => 'Search']) }}
					          <span class="input-group-btn">
					            <button class="btn btn-default" type="submit">Search</button>
					          </span>
					      </div><!-- /input-group -->
					    {{ Form::close() }}
					</div>
				</div><!-- .table-toolbar -->
				<div class="row">
					<div class="col-lg-2">
						<h4>Total Members: <small>{{ $total_members }}</small></h4>
					</div>
					<div class="col-lg-10">
						@if(isset($search))
							<h4>Search: <mark>{{ $search }}</mark></h4>
						@endif
					</div>
				</div><!-- .row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-big">
								<thead>
									<tr>
										<th>#</th>
										<th>{{ sort_members_by('last_name', 'Name') }}</th>
										<th>{{ sort_members_by('birthdate', 'Birthdate') }}</th>
										<th>{{ sort_members_by('gender', 'Gender') }}</th>
										<th>{{ sort_members_by('civil_status', 'Civil Status') }}</th>
										<th>{{ sort_members_by('country_id', 'Country') }}</th>
										<th>{{ sort_members_by('street_address', 'Street Address') }}</th>
										<th>{{ sort_members_by('city' , 'City/Province') }}</th>
										<th>{{ sort_members_by('email' , 'Email') }}</th>
										<th>Mobile</th>
										<th>Telephone</th>
										<th>Facebook</th>
										<th>{{ sort_members_by('created_at' , 'Created At') }}</th>
										<th>{{ sort_members_by('updated_at' , 'Last Updated At') }}</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if($members->count() > 0)
										<?php $counter = 0; ?>
										@foreach($members as $member)
											<tr>
												<td>{{ ++$counter }}</td>
												<td><a href="{{ URL::route('members.show', e($member->id)) }}">{{ e($member->full_name) }}</a></td>
												<td>{{ e($member->birthdate) }}</td>
												<td>{{ e($member->gender) }}</td>
												<td>{{ e($member->civil_status) }}</td>
												<td>{{ e($member->country_name) }}</td>
												<td>{{ e($member->street_address) }}</td>
												<td>{{ e($member->location->city_province_address) }}</td>
												<td>{{ e($member->email) }}</td>
												<td>{{ e($member->mobile) }}</td>
												<td>{{ e($member->telephone) }}</td>
												<td>{{ e($member->fb_account) }}</td>
												<td>{{ e($member->created_at) }}</td>
												<td>{{ e($member->updated_at_readable) }}</td>
												@if(e($member->deleted_at) == NULL)
													<td><button class="btn btn-delete" id="{{ e($member->full_name) }}" value="{{ URL::route('members.destroy', e($member->id)) }}" style="display:none;">X</button></td>
												@endif
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div><!-- .table-responisve -->
						{{ $members->appends(Request::except('page'))->links(); }}
					</div>
				</div>
			</div>
		</div><!-- .row -->
	</div>
</div><!-- .row -->
@stop

@section('modal-content')
<div class="modal-content">
	{{ Form::open(['id' => 'modal-form', 'route' => ['members.destroy'], 'method' => 'DELETE']) }}
		<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Remove Member Account?</h4>
		</div>
		<div class="modal-body">
			Are you sure you want to delete <span id="subject-name">member</span> from the list?
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default cancel-btn" id="cancel-btn2" data-dismiss="modal">Cancel</button>
			{{ Form::submit('OK', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
</div><!-- .modal-content -->
@stop