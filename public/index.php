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
$core->get('user', 'Pages@userAuth');
$core->get('home', 'Pages@home');
$core->get('posts/topics', 'Categories@selectAllByTag');

### AUTH ###
$core->get('login', 'Pages@login');
$core->post('login', 'Users@login');
$core->get('register', 'Pages@register');
$core->post('register', 'Users@register');

### USERS ###
$core->get('user/timeline', 'Pages@userTimeline');
$core->get('user/home', 'Pages@userHome');
$core->get('user/posts', 'Categories@selectAllByTagUser');
$core->get('user/timeline/posts', 'Categories@selectByTagUser');

$core->post('user/home', 'Posts@addPost');
$core->get('user/edit-post', 'Pages@editPost');
$core->post('user/edit-post', 'Posts@updatePost');
$core->post('user/post-delete', 'Posts@destroyPost');

### ADMIN ###
$core->get('admin/dashboard', 'Pages@dash');
$core->get('admin/home', 'Pages@adminHome');
$core->get('admin/posts', 'Categories@selectAllByTagAdmin');
$core->get('admin/timeline/posts', 'Categories@selectByTagAdmin');

$core->get('admin/timeline', 'Pages@adminTimeline');
$core->get('admin/edit-post', 'Pages@adminEditPost');
$core->post('admin/edit-post', 'Posts@adminUpdatePost');
$core->post('admin/post-delete', 'Posts@adminDestroyPost');

$core->get('admin/user-list', 'Pages@userList');
$core->get('admin/user-edit', 'Pages@updateUserTypes');
$core->post('admin/user-edit', 'Users@updateUserTypes');
$core->post('admin/user-delete', 'Users@destroyUser');

$core->get('admin/tag-list', 'Pages@tagList');
$core->post('admin/tag-list', 'Tags@addTag');
$core->get('admin/tag-edit', 'Pages@updateTag');
$core->post('admin/tag-edit', 'Tags@updateTag');
$core->post('admin/tag-delete', 'Tags@destroyTag');

### SHARED PAGES ###
## ADD POST ##
$core->post('home', 'Posts@addPost');

## PROFILE ##
$core->get('profile', 'Pages@profile');
$core->post('profile', 'Users@updateProfile');

## COMMENTS ## 
$core->get('user/comment', 'Pages@userComment');
$core->post('user/comment', 'Comments@addUserComment');
$core->get('user/comment-edit', 'Pages@userCommentEdit');
$core->post('user/comment-edit', 'Comments@updateUserComment');
$core->post('user/comment-delete', 'Comments@destroyUserComment');

$core->get('admin/comment', 'Pages@adminComment');
$core->post('admin/comment', 'Comments@addAdminComment');
$core->get('admin/comment-edit', 'Pages@adminCommentEdit');
$core->post('admin/comment-edit', 'Comments@updateAdminComment');
$core->post('admin/comment-delete', 'Comments@destroyAdminComment');

### ACTIVATE ROUTES ###
$core->run();