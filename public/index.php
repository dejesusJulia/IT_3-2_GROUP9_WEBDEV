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
$core->get('user/timeline', 'Pages@userTimeline');
$core->get('user/home', 'Pages@userHome');

$core->post('user/home', 'Posts@addPost');
$core->get('user/edit-post', 'Pages@editPost');
$core->post('user/edit-post', 'Posts@updatePost');
$core->post('user/post-delete', 'Posts@postDestroy');

#ADMIN
$core->get('admin/dashboard', 'Pages@dash');
$core->get('admin/home', 'Pages@adminHome');

$core->get('admin/user-list', 'Pages@userList');
$core->get('admin/user-edit', 'Pages@editUserType');
$core->post('admin/user-edit', 'Users@updateUserTypes');
$core->post('admin/user-delete', 'Users@userDestroy');

$core->get('admin/post-list', 'Pages@postList');
$core->get('admin/post-view', 'Pages@postView');

#SHARED PAGES
$core->get('user/comment', 'Pages@userComment');
$core->post('user/comment', 'Comments@addUserComment');
$core->get('user/comment-edit', 'Pages@userCommentEdit');
$core->post('user/comment-edit', 'Comments@updateUserComment');
$core->post('user/comment-delete', 'Comments@destroyUserComment');

$core->get('admin/comment', 'Pages@adminComment');
// $core->get('admin/comment-edit', 'Pages@adminCommentEdit');
// $core->post('admin/comment-edit', 'Comments@updateAdminComment');
$core->post('admin/comment-delete', 'Comments@destroyAdminComment');
$core->get('profile', 'Pages@profile');
$core->post('profile', 'Users@updateProfile');

# ACTIVATE ROUTES
$core->run();