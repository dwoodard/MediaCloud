<?php
// DASHBOARD

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin'));
});


// DASHBOARD > ASSETS

Breadcrumbs::register('assets', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Assets', route('assets'));
});

// DASHBOARD > ASSETS > CREATE ASSET

Breadcrumbs::register('createAsset', function($breadcrumbs) {
    $breadcrumbs->parent('assets');
    $breadcrumbs->push(' Create Asset', route('assets'));
});

// DASHBOARD > ASSETS > EDIT ASSET

Breadcrumbs::register('editAsset', function($breadcrumbs) {
    $breadcrumbs->parent('assets');
    $breadcrumbs->push(' Edit Asset', route('assets'));
});



// DASHBOARD > USERS

Breadcrumbs::register('users', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Users', route('users'));
});

// DASHBOARD > USERS > CREATE USER

Breadcrumbs::register('createUsers', function($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create User', route('users'));
});


// DASHBOARD > USERS > UPDATE USER

Breadcrumbs::register('editUsers', function($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Update User', route('users'));
});


// DASHBOARD > GROUP 

Breadcrumbs::register('groups', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Group Management', route('groups'));
});

// DASHBOARD > GROUP > CREATE

Breadcrumbs::register('createGroups', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Create Group', route('groups'));
});

// DASHBOARD > GROUP > UPDATE

Breadcrumbs::register('updateGroups', function($breadcrumbs) {
    $breadcrumbs->parent('groups');
    $breadcrumbs->push('Group Update', route('groups'));
});


// DASHBOARD > SETTINGS

Breadcrumbs::register('settings', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Settings', route('settings'));
});

// DASHBOARD > COLLECTIONS

Breadcrumbs::register('collections', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Collections', route('collections'));
});

// DASHBOARD > COLLECTIONS > EDIT

Breadcrumbs::register('editCollections', function($breadcrumbs) {
    $breadcrumbs->parent('collections');
    $breadcrumbs->push('Edit Collections', route('collections'));
});



// DASHBOARD > PLAYLISTS

Breadcrumbs::register('playlists', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Playlists', route('playlists'));
});


// DASHBOARD > QUEUES

Breadcrumbs::register('queue', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Queue', route('queue'));
});

// DASHBOARD > HISTORY

Breadcrumbs::register('history', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('History', route('history'));
});


// DASHBOARD > CAPTURE

Breadcrumbs::register('capture', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Capture', route('capture'));
});


// DASHBOARD > REPORTS

Breadcrumbs::register('reports', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Reports', route('reports'));
});




Breadcrumbs::register('category', function($breadcrumbs, $category) {
    $breadcrumbs->parent('blog');

    foreach ($category->ancestors as $ancestor) {
        $breadcrumbs->push($ancestor->title, route('category', $ancestor->id));
    }

    $breadcrumbs->push($category->title, route('category', $category->id));
});

Breadcrumbs::register('page', function($breadcrumbs, $page) {
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});