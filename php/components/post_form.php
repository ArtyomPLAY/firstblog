<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

if(isset($_SESSION['logged_user'])):
    $data = $_POST;
    $tags_to_db = NULL;
    if(isset($data['tags']))
        $tags_to_db=mb_strtolower($data['tags']);
    if(isset($data['post_submit']))
    {
    $post = R::dispense('posts');
    $post->title = $data['title'];
    $post->content = $data['content'];
    $post->authors_id = $_SESSION['logged_user']->id;
    $post->pub_date = date('F j, H:i');
    $post->tags = $tags_to_db;
    $post->likes;
    $post->reposts;
    $post->comments;
    R::store($post);
    header('Location: /');
    }


    ?>
    <link rel="stylesheet" href="/css/main.css">
    <div id="post-form" style="display:none">
        <div class="post-wrap"></div>
        <form action="php/components/post_form.php" method="post">
        <div class="top">    
            <input type="text" name="title" placeholder="Title" required>
            <button class="post-popup-close" tabindex="7">x</button>
        </div>
            <textarea name="content" cols="30" rows="20" placeholder="Say something:)" required></textarea>
            <div class="down">
                <input type="text" placeholder="Tags: #news, #games etc." name="tags">
                <input type="submit" value="Post" name="post_submit" class="button">
            </div>
        </form>
    </div>
<? endif ?>