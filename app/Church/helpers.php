<?php

function sort_members_by($column, $body) {
	$direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
	$search = Request::get('q');
	return link_to_route('members.index', $body, ['q' => $search, 'sortBy' => $column, 'direction' => $direction]);
}

function sort_countries_asc($column) {
	$direction = 'asc';
	$search = Request::get('q');
	return URL::route('countries.index', ['q' => $search, 'sortBy' => $column, 'direction' => $direction]);
}

function sort_countries_desc($column) {
	$direction = 'desc';
	$search = Request::get('q');
	return URL::route('countries.index', ['q' => $search, 'sortBy' => $column, 'direction' => $direction]);
}
