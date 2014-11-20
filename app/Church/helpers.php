<?php

function sort_members_by($column, $body) {
	$direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
	$search = Request::get('q');
	return link_to_route('members.index', $body, ['q' => $search, 'sortBy' => $column, 'direction' => $direction]);
}