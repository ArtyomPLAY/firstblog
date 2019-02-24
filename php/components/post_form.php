<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

if(isset($_SESSION['logged_user'])/* && isset($_POST['post_submit'])*/):
    $data = $_POST;
    $user = R::findOne('users','id = ?', array($_SESSION['logged_user']->id));
    $post = R::dispense('posts');
    $post->title = $data['title'];
    $post->content = $data['content'];
    $post->authors_id = $_SESSION['logged_user']->id;
    $post->pub_date = date('F j, H:i');
    if(isset($data['tags']) && !empty($data['tags']))
        $post->tags = mb_strtolower($data['tags']);
    else
        $post->tags;
    $post->likes;
    $post->reposts;
    $post->comments;
    R::store($post);
    $user->posts_counter++;
    R::store($user);
    echo draw::post($post);
endif ?>