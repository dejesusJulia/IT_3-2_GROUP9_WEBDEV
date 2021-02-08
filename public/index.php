<?php

require_once '../app/require.php';

$core = new Core();

/*
**** DEV'S NOTE ****
*
* If you want to load a certain page with GET method, use:
* $core->get('url', 'ControllerName@function')
*
* If you want to submit a data and load the same page, use: 
* $core->post('sameGetURL', 'ControllerName@function')
*
* If you want to submit a data and redirect, use:
* $core->post('pageYouWantToRedirectTo', 'ControllerName@function');
*
*/
# PAGES
$core->get('index', 'Pages@logout');

$core->get('home', 'Pages@home');
$core->post('home', 'Posts@addPost');

// $core->get('post', 'Pages@viewPost');
// $core->post('search-results', 'Pages@searchResults');

#AUTH
$core->get('login', 'Pages@login');
$core->post('login', 'Users@login');
$core->get('register', 'Pages@register');
$core->post('register', 'Users@register');

#USERS
$core->get('user/timeline', 'Pages@defaultHome');
$core->get('user/home', 'Pages@userHome');

#ADMIN
$core->get('admin/dashboard', 'Pages@dash');
$core->get('admin/user-list', 'Pages@userList');
$core->get('admin/post-list', 'Pages@postList');
$core->get('admin/post-view', 'Pages@postView');

#SHARED PAGE
$core->get('profile', 'Users@profile');
$core->post('profile', 'Users@updateProfile');

# ACTIVATE ROUTES
$core->run();