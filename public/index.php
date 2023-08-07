<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/app/JsonPlaceholderApi.php';
require_once HELPERS . '/functions.php';

$api = new JsonPlaceholderApi();

$users = $api->getUsers();
debug($users);

$userPosts = $api->getUserPosts(1);
debug($userPosts);

$userTodos = $api->getUserTodos(1);
debug($userTodos);

$post = $api->getPost(1);
debug($post);

$newPostData = [
    'userId' => 1,
    'title' => 'New Post Title',
    'body' => 'New Post Body'
];
$newPost = $api->createPost($newPostData);
debug($newPost);

$updatedPostData = [
    'title' => 'Updated Post Title',
    'body' => 'Updated Post Body'
];
$updatedPost = $api->updatePost(1, $updatedPostData);
debug($updatedPost);

$api->deletePost(1);
echo 'Post deleted successfully.';