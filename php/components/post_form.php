<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

if(isset($_SESSION['logged_user']) & isset($_POST['title']) && isset($_POST['content'])):
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
endif;

if(isset($_SESSION['logged_user']) && isset($_POST['post_id'])):
    $post_id = $_POST['post_id'];
    $post = R::findOne('posts','id = ?', array($_POST['post_id']));
    $user = R::findOne('users','id = ?', array($_SESSION['logged_user']->id));
    if($post->authors_id === $_SESSION['logged_user']->id){
        R::exec("DELETE FROM posts WHERE id = '$post_id'");
        R::exec("DELETE FROM actions WHERE post_id ='$post_id'");
        $user->posts_counter--;
        R::store($user);
        echo 1;
    }
    else
        echo 'Sosatb hacker!';
endif;
?>