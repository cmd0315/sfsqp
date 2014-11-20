<?php

Breadcrumbs::register('dashboard', function($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
});


Breadcrumbs::register('add-member', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add Member', route('members.create'));
});

Breadcrumbs::register('manage-members', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('List of Members', route('members.index'));
});

Breadcrumbs::register('member-profile', function($breadcrumbs, $id) {
    $breadcrumbs->parent('manage-members');
    $breadcrumbs->push('Member Profile', route('members.show', $id));
});

Breadcrumbs::register('edit-member-profile', function($breadcrumbs, $id) {
    $breadcrumbs->parent('member-profile', $id);
    $breadcrumbs->push('Edit Member Profile', route('members.edit', $id));
});
